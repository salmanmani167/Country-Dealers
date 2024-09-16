<?php

namespace Modules\Accounts\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Modules\Accounts\Entities\Product;
use Illuminate\Contracts\Support\Renderable;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $title = 'products';
        if($request->ajax()){
            $data = Product::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('cost', function($row){
                    return app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.$row->cost_price;
                })
                ->addColumn('retail', function($row){
                    return app(\App\Settings\ThemeSettings::class)->currency_symbol.' '.$row->retail_price;
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
        return view('accounts::products',compact(
            'title'
        ));
    }
}
