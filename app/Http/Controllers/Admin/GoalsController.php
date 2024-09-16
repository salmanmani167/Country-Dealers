<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\Goal;
use App\Models\GoalType;

class GoalsController extends Controller
{

    public function index(Request $request){
        $title = 'goals';
        if($request->ajax()){
            $goals = Goal::get();
            return DataTables::of($goals)
                ->addIndexColumn()
                ->addColumn('type', function($row){
                    return $row->goalType->type;
                })
                ->addColumn('progress', function($row){
                    return $row->progress.'%';
                })
                ->addColumn('starts', function($row){
                    return format_date($row->start_date, 'd M, Y');
                })
                ->addColumn('ends', function($row){
                    return format_date($row->end_date, 'd M, Y');
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
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.goals',compact(
            'title'
        ));
    }

    public function goalTypes(Request $request){
        $title = 'goal type';
        if($request->ajax()){
            $types = GoalType::get();
            return DataTables::of($types)
                ->addIndexColumn()
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
                ->rawColumns(['action'])
                ->make();
        }
        return view('admin.goal-types',compact(
            'title'
        ));
    }
}
