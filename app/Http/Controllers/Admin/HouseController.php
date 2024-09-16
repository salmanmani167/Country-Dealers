<?php

namespace App\Http\Controllers\Admin;

use App\Models\House;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class HouseController extends Controller
{

    public function index(Request $request){
        $title = 'Houses';
        if($request->ajax()){
            $houses = House::with(['manager','cordinator'])->get();
            return DataTables::of($houses)
                ->addIndexColumn()
                ->addColumn('individual', function($row){
                    if(!empty($row->client)){
                        $user = $row->client->user;
                        $name = $user->firstname.' '.$user->lastname;
                        return '<a target="_blank" href="'.route("clients.profile", $user).'">'.$name.'</a>';
                    }
                })
                ->addColumn('manager', function($row){
                    return ($row->manager->firstname.' '.$row->manager->lastname);
                })
                ->addColumn('cordinator', function($row){
                    return ($row->cordinator->firstname.' '.$row->cordinator->lastname);
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
                ->rawColumns(['action','individual'])
                ->make();
        }
        return view('admin.houses',compact(
            'title'
        ));
    }
}
