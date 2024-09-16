<?php

namespace App\Http\Controllers\Admin;

use App\Models\Employee;
use App\Models\Timesheet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Projects\Entities\Project;
use Yajra\DataTables\DataTables;

class TimesheetsController extends Controller
{
    public function index(Request $request){

        $title = 'timesheets';
        if($request->ajax()){
            $employee = $request->employee;
            $from = $request->from;
            $to = $request->to;
            if(!empty($employee)){
                $employee_timesheet = Timesheet::where('employee_id', $employee);
                $timesheets = $employee_timesheet->get();
                if(!empty($from) && !empty($to)){
                    $timesheets = $employee_timesheet->whereBetween('date_', [$from, $to])->get();
                }
            }else{
                $filtered_timesheets = Timesheet::whereBetween('date_', [$from, $to])->get();
                    $timesheets = $filtered_timesheets;
                if(!empty($filtered_timesheets) && ($filtered_timesheets->count() > 0)){
                    $timesheets = $filtered_timesheets;
                }else{
                    $timesheets = Timesheet::get();
                }
            }
            return DataTables::of($timesheets)
                ->addIndexColumn()
                ->addColumn('employee', function($row){
                    if(!empty($row->employee)){
                        $image = !empty($row->employee->user->avatar) ? asset('storage/users/'.$row->employee->user->avatar): asset('assets/img/profiles/avatar.jpg');
                        $h = '<h2 class="table-avatar blue-link">
                            <a target="_blank" href="'.route('employees.profile',$row->employee->user->id).'" class="avatar"><img alt="avatar" src="'.$image.'"></a>
                            <a target="_blank" href="'.route('employees.profile',$row->employee->user->id).'">'.$row->employee->user->firstname." ".$row->employee->user->lastname.'</a>
                        </h2>';
                        return $h;
                    }
                })
                ->addColumn('project', function($row){
                    return $row->project->name ?? '';
                })
                ->addColumn('date', function($row){
                    return format_date($row->date_, 'd M Y');
                })
                ->addColumn('created_at', function($row){
                    return format_date($row->created_at, 'Y-m-d');
                })
                ->addColumn('action',function ($row){
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                <a data-timesheet="'.json_parse(['model' => $row]).'" class="dropdown-item edit" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <a data-id="'.$row->id.'" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action','employee'])
                ->make();
        }
        $projects = Project::get();
        $employees = Employee::get();
        return view('admin.timesheets',compact(
            'title','projects','employees'
        ));
    }


    public function store(Request $request){
        $request->validate([
            'employee' => 'required',
            'project' => 'required',
            'emp_hours' => 'required',
            'date' => 'required',
            'deadline' => 'required',
            'remaining_hours' => 'required',
            'total_hours' => 'required',
        ]);
        Timesheet::create([
            'employee_id' => $request->employee,
            'project_id' => $request->project,
            'deadline' => $request->deadline,
            'date_' => $request->date,
            'hours' => $request->emp_hours,
            'total_hours' => $request->total_hours,
            'remaining_hours' => $request->remaining_hours,
            'description' => $request->description
        ]);
        $notification = notify("Timesheet has been added");
        return back()->with($notification);
    }
    public function update(Request $request){
        $request->validate([
            'employee' => 'required',
            'project' => 'required',
            'emp_hours' => 'required',
            'date' => 'required',
            'deadline' => 'required',
            'remaining_hours' => 'required',
            'total_hours' => 'required',
        ]);
        $timesheet = Timesheet::findOrFail($request->id);
        $timesheet->update([
            'employee_id' => $request->employee,
            'project_id' => $request->project,
            'deadline' => $request->deadline,
            'date_' => $request->date,
            'hours' => $request->emp_hours,
            'total_hours' => $request->total_hours,
            'remaining_hours' => $request->remaining_hours,
            'description' => $request->description
        ]);
        $notification = notify("Timesheet has been updated");
        return back()->with($notification);
    }

    public function destroy(Request $request){
        Timesheet::findOrFail($request->id)->delete();
        $notification = notify("Timesheet has been deleted");
        return back()->with($notification);
    }
}
