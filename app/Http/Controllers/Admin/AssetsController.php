<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AssetsController extends Controller
{

    public function index(Request $request){
        $title = 'assets';
        if($request->ajax()){
            $assets = Asset::get();
            return DataTables::of($assets)
                ->addIndexColumn()
                ->addColumn('amount', function($row){
                    return app(\App\Settings\ThemeSettings::class)->currency_symbol.$row->cost;
                })
                ->addColumn('purchase_date', function($row){
                    return $row->purchase_date;
                })
                ->addColumn('user', function($row){
                    $user = $row->user;
                    return view('components.user.avatar',compact('user'));
                })
                ->addColumn('created_at', function($row){
                    return format_date($row->created_at, 'd M, Y');
                })
                ->addColumn('action',function ($row){
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a onclick="Livewire.emit(`openModal`, '.json_parse(['model' => $row->id]).')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a onclick="Livewire.emit(`openModal`,'.json_parse(['model' => $row->id, 'delete' => true]).')" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action', 'user'])
                ->make();
        }
        return view('admin.assets',compact(
            'title'
        ));
    }
}
