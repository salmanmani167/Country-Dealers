<?php

namespace Modules\Accounts\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use App\Settings\InvoiceSettings;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\Tax;
use Modules\Accounts\Entities\Invoice;
use Modules\Projects\Entities\Project;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\Support\Renderable;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $title = 'invoices';
        if($request->ajax()){
            $invoices = Invoice::get();
            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('inv_id', function($row){
                    return '<a href="'.route("invoices.show",$row->id).'">'.$row->inv_id.'</a>';
                })
                ->addColumn('amount', function($row){
                    return app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.$row->total;
                })
                ->addColumn('client', function($row){
                    if(!empty($row->client)){
                        return $row->client->company;
                    }
                })
                ->addColumn('invoice_date', function($row){
                    return format_date($row->invoice_date,'d M, Y');
                })
                ->addColumn('due_date', function($row){
                    return format_date($row->due_date,'d M, Y');;
                })
                ->addColumn('status', function($row){
                    $color = ($row->status == 'paid') ? 'success': 'danger';
                    return '<span class="badge bg-inverse-'.$color.'">'.ucfirst($row->status).'</span>';
                })
                ->addColumn('action',function ($row){
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="'.route('invoices.edit',$row->id).'"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <a class="dropdown-item" href="'.route('invoices.show',$row->id).'"><i class="fa fa-eye m-r-5"></i> View</a>
                                <a onclick="Livewire.emit(`openModal`,'.json_parse(['model' => $row->id, 'delete' => true]).')" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action','inv_id','status'])
                ->make();
        }
        return view('accounts::invoices.index',compact(
            'title'
        ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $title = 'create invoice';
        $clients = Client::get();
        $projects = Project::get();
        $taxes = Tax::get();
        return view('accounts::invoices.create',compact(
            'title','clients','projects','taxes'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'client' => 'required',
            'project' => 'required',
            'email' => 'required',
            'tax' => 'required',
            'client_address' => 'required',
            'billing_address' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'items' => 'required',
            'note' => 'nullable',
        ]);
        $settings = new InvoiceSettings();
        $prefix = $settings->prefix;
        $amount = 0;
        foreach($request->items as $item){
            $amount += intval($item['amount']);
        }
        $inv_id = IdGenerator::generate(['table' => 'invoices', 'length' =>9,'field'=>'inv_id', 'prefix' => $prefix]);
        Invoice::create([
            'inv_id' => $inv_id,
            'client_id' => $request->client,
            'project_id' => $request->project,
            'tax_id' => $request->tax,
            'email' => $request->email,
            'client_address' => $request->client_address,
            'billing_address' => $request->billing_address,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'items' => $request->items,
            'discount' => $request->discount,
            'total' => $amount,
            'note' =>$request->note,
            'status' => $request->status,
        ]);
        $notification = notify('invoice has been created');
        return redirect()->route('invoices.index')->with($notification);
    }

    /**
     * Show the specified resource.
     * @param Invoice $invoice
     * @return Renderable
     */
    public function show(Invoice $invoice)
    {
        $title = 'view invoice';
        return view('accounts::invoices.show',compact(
            'invoice','title'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Invoice $invoice
     * @return Renderable
     */
    public function edit(Invoice $invoice)
    {
        $title = 'edit invoice';
        $clients = Client::get();
        $projects = Project::get();
        $taxes = Tax::get();
        return view('accounts::invoices.edit',compact(
            'title','clients','projects','taxes','invoice'
        ));
    }

    public function pdf(Invoice $invoice){
        $title = 'download invoice';
        $pdf = Pdf::loadView('accounts::invoices.pdf', compact(
            'invoice','title'
        ));
        return $pdf->download("{$invoice->inv_id}.pdf");
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Invoice $invoice
     * @return Renderable
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            'client' => 'required',
            'project' => 'required',
            'email' => 'required',
            'tax' => 'required',
            'client_address' => 'required',
            'billing_address' => 'required',
            'invoice_date' => 'required',
            'due_date' => 'required',
            'items' => 'required',
            'note' => 'nullable',
        ]);
        $settings = new InvoiceSettings();
        $prefix = $settings->prefix;
        $amount = 0;
        foreach($request->items as $item){
            $amount += intval($item['amount']);
        }
        $invoice->update([
            'client_id' => $request->client,
            'project_id' => $request->project,
            'tax_id' => $request->tax,
            'email' => $request->email,
            'client_address' => $request->client_address,
            'billing_address' => $request->billing_address,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'items' => $request->items,
            'discount' => $request->discount,
            'total' => $amount,
            'note' =>$request->note,
            'status' => $request->status,
        ]);
        $notification = notify('invoice has been updated');
        return redirect()->route('invoices.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     * @return Renderable
     */
    public function destroy(Request $request)
    {
        Invoice::findOrFail($request->id)->delete();
        $notification = notify('Invoice has been deleted successfully');
        return back()->with($notification);
    }
}
