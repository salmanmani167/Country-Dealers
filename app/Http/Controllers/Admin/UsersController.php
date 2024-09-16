<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request){
        $title = 'users';
        if($request->ajax()){
            $users = User::with(['roles'])->where('is_employee', 0)->where('is_client',0)->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('name', function($row){
                    return $row->firstname.' '.$row->lastname;
                })
                ->addColumn('role', function($row){
                    $roles = $row->roles->pluck('name')->toArray();
                    return implode(',',$roles);
                })
                ->addColumn('active', function($row){
                    return ($row->active != '1') ? 'InActive': 'Active';
                })
                ->addColumn('department', function($row){
                    return $row->department->name ?? '';
                })
                ->addColumn('created_at', function($row){
                    return format_date($row->created_at, 'd M, Y');
                })
                ->addColumn('action',function ($row){
                    $editbtn = can("edit-employee") ? '<a onclick="Livewire.emit(`openModal`, '.json_parse(['model' => $row->id]).')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>': "";
                    $impersonatebtn = can("impersonate-users") ? '<a class="dropdown-item" target="_blank" href="'.route('impersonate', $row->id).'"><i class="fa fa-eye m-r-5"></i> Impersonate</a>': "";
                    $deletebtn = can('delete-employee') ? '<a onclick="Livewire.emit(`openModal`,'.json_parse(['model' => $row->id, 'delete' => true]).')" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>': "";
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    '.$editbtn.$impersonatebtn.$deletebtn.'
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.users',compact(
            'title'
        ));
    }
}
