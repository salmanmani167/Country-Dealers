<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\Sale;
use Illuminate\Contracts\Support\Renderable;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $title = 'sales';
        if($request->ajax()){
            $data = Sale::with(['products'])->get();
            return DataTables::of($data)
                ->addColumn('product', function($row){
                    return $row->saleProduct->product->name;
                })
                ->addColumn('quantity', function($row){
                    return $row->saleProduct->quantity;
                })
                ->addColumn('price', function($row){
                    return app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.$row->saleProduct->price;
                })
                ->addColumn('created_at', function($row){
                    return date_format(date_create($row->created_at),'d M, Y');
                })
                ->addIndexColumn()
                ->addColumn('total', function($row){
                    return app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.$row->total;
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
                ->rawColumns(['action'])
                ->make();
        }
        return view('accounts::sales',compact(
            'title'
        ));
    }
}
