<?php

namespace App\Http\Controllers\Admin;

use App\Models\Overtime;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class OvertimesController extends Controller
{

    public function index(Request $request){
        $title = 'overtime';
        if($request->ajax()){
            $overtimes = Overtime::get();
            return DataTables::of($overtimes)
                ->addIndexColumn()
                ->addColumn('employee', function($row){
                    $image = !empty($row->employee->user->avatar) ? asset('storage/users/'.$row->employee->user->avatar): asset('assets/img/profiles/avatar.jpg');
                    $h = '<h2 class="table-avatar blue-link">
                        <a target="_blank" href="'.route('employees.profile',$row->employee->user->id).'" class="avatar"><img alt="avatar" src="'.$image.'"></a>
                        <a target="_blank" href="'.route('employees.profile',$row->employee->user->id).'">'.$row->employee->user->firstname." ".$row->employee->user->lastname.'</a>
                    </h2>';
                return $h;
                })
                ->addColumn('overtime_date', function($row){
                    return format_date($row->overtime_date, 'd M Y');
                })
                ->addColumn('overtime_hours', function($row){
                    return Str::plural('hour',$row->hours);
                })
                ->addColumn('is_approved', function($row){
                    return ($row->approved == true) ? 'True': 'False';
                })
                ->addColumn('created_at', function($row){
                    return format_date($row->created_at, 'Y-m-d');
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
                ->rawColumns(['action','employee'])
                ->make();
        }
        return view('admin.overtime',compact(
            'title'
        ));
    }
}
