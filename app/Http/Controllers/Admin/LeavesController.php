<?php

namespace App\Http\Controllers\Admin;

use App\Models\Leave;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class LeavesController extends Controller
{

    public function index(Request $request){

        $title = 'vacations';
        if($request->ajax()){
            $leaves = Leave::get();
            return DataTables::of($leaves)
                ->addIndexColumn()
                ->addColumn('employee', function($row){
                    return $row->employee->emp_id;
                })
                ->addColumn('leave_type', function($row){
                    return $row->leaveType->type;
                })
                ->addColumn('days', function($row){
                    return $row->days.' '.Str::plural('Day',$row->days);
                })
                ->addColumn('from', function($row){
                    return format_date($row->starts_on, 'd M, Y');
                })
                ->addColumn('to', function($row){
                    return format_date($row->ends_on, 'd M, Y');
                })
                ->addColumn('created_at', function($row){
                    return format_date($row->created_at, 'd M, Y');
                })
                ->addColumn('status', function($row){
                    $stats = null;
                    switch($row->status){
                        case 'New':
                            $stats = 'text-purple';
                            break;
                        case 'Approved':
                            $stats = 'text-success';
                            break;
                        case 'Declined':
                            $stats = 'text-danger';
                            break;
                        case 'Pending':
                            $stats = 'text-info';
                            break;
                        default:
                            $stats = 'text-info';
                    }

                    $btn = '<div class="action-label">
                            <a class="btn btn-white btn-sm btn-rounded" href="javascript:void(0);">
                                <i class="fa fa-dot-circle-o '.$stats.'"></i> '.$row->status.'
                            </a>
                        </div>';
                    return $btn;
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
                ->rawColumns(['action','status'])
                ->make();
        }
        return view('admin.leaves',compact(
            'title'
        ));
    }
}
