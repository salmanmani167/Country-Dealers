<?php

namespace Modules\Reports\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\Expense;
use Modules\Accounts\Entities\Invoice;
use Illuminate\Contracts\Support\Renderable;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function expenses(Request $request)
    {
        $title = 'expense report';
        $users = User::get();
        if($request->ajax()){
            $buyer = $request->buyer;
            $from = $request->from;
            $to = $request->to;
            if(!empty($buyer)){
                $user_expenses = Expense::where('user_id', $buyer);
                $expenses = $user_expenses->get();
                if(!empty($from) && !empty($to)){
                    $expenses = $user_expenses->whereBetween('purchased_date', [$from, $to])->get();
                }
            }else{
                $filtered_expenses = Expense::whereBetween('purchased_date', [$from, $to])->get();
                if(!empty($filtered_expenses) && ($filtered_expenses->count() > 0)){
                    $expenses = $filtered_expenses;
                }else{
                    $expenses = Expense::get();
                }
            }
            return DataTables::of($expenses)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return ucwords($row->status);
                })
                ->addColumn('buyer', function($row){
                    $user = $row->user;
                    return view('components.user.avatar',compact('user'));
                })
                ->addColumn('paid_by', function($row){
                    return $row->payment_method;
                })
                ->addColumn('amount', function($row){
                    return app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.$row->amount;
                })
                ->addColumn('purchase_date', function($row){
                    return format_date($row->purchased_date,'d M,Y');
                })
                ->addColumn('purchased_from', function($row){
                    return $row->purchased_from;
                })
                ->addColumn('action',function ($row){
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a onclick="Livewire.emit(`openModal`, '.json_parse(['model' => $row->id]).')" class="dropdown-item edit_department" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <a onclick="Livewire.emit(`openModal`,'.json_parse(['model' => $row->id, 'delete' => true]).')" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action','buyer'])
                ->make();
        }
        return view('reports::expenses',compact(
            'title','users'
        ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function invoices(Request $request)
    {
        $title = 'Invoice Report';
        if($request->ajax()){
            $client = $request->client;
            $from = $request->from;
            $to = $request->to;
            if(!empty($client)){
                $client_invoices = Invoice::where('client_id', $client);
                $invoices = $client_invoices->get();
                if(!empty($from) && !empty($to)){
                    $invoices = $client_invoices->whereBetween('invoice_date', [$from, $to])->get();
                }
            }else{
                $filtered_invoices = Invoice::whereBetween('invoice_date', [$from, $to])->get();
                    $invoices = $filtered_invoices;
                if(!empty($filtered_invoices) && ($filtered_invoices->count() > 0)){
                    $invoices = $filtered_invoices;
                }else{
                    $invoices = Invoice::get();
                }
            }
            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('inv_id', function($row){
                    return '<a href="'.route("invoices.show",$row->id).'">'.$row->inv_id.'</a>';
                })
                ->addColumn('amount', function($row){
                    return app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.$row->total;
                })
                ->addColumn('client', function($row){
                    return $row->client->company;
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
        $clients = Client::get();
        return view('reports::invoices',compact(
            'title','clients'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('reports::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('reports::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
