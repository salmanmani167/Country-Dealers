<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ClientsController extends Controller
{
    public function index(){
        $title = 'clients';
        $clients = User::with(['client'])->whereHas('client')->where('is_employee',0)->where('is_client',1)->get();
        return view('admin.clients.index',compact(
            'title','clients'
        ));
    }

    public function list(Request $request){
        $title = 'client list';
        if($request->ajax()){
            $users = User::with(['client'])->whereHas('client')->where('is_employee',0)->where('is_client',1)->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->firstname.' '.$row->lastname;
                })
                ->addColumn('clt_id', function ($row) {
                    return $row->client->clt_id;
                })
                ->addColumn('role', function ($row) {

                })
                ->addColumn('active', function ($row) {
                    return ($row->active != '1') ? 'InActive' : 'Active';
                })
                ->addColumn('created_at', function ($row) {
                    return format_date($row->created_at, 'd M, Y');
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a onclick="Livewire.emit(`openModal`, '.json_parse(['model' => $row->id]).')" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a onclick="Livewire.emit(`openModal`,'.json_parse(['model' => $row->id, 'delete' => true]).')" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.clients.list',compact(
            'title'
        ));
    }

    public function profile(User $user){
        $title = 'client profile';
        return view('client.profile',compact(
            'title','user'
        ));
    }
}
