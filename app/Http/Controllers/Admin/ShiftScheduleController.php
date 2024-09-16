<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shift;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\ShiftSchedule;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ShiftScheduleController extends Controller
{

    public function index(Request $request){

        $title = 'shift schedules';
        $from = $request->from;
        $date = isset($from) ? Carbon::parse($from) : Carbon::now();
        $dates = [];

        for ($i = 0; $i < 7; $i++) {
            $dates[] = $date->copy()->addDays($i);
        }
        if($request->ajax()){
            $schedules = ShiftSchedule::with(['employee','shift'])->get();
            return DataTables::of($schedules)
                ->addIndexColumn()
                ->addColumn('min_start', function($row){
                    return format_date($row->shift->min_start_time, 'H:i:s a');
                })
                ->addColumn('start', function($row){
                    return format_date($row->shift->start_time, 'H:i:s a');
                })
                ->addColumn('max_start', function($row){
                    return format_date($row->shift->max_start_time, 'H:i:s a');
                })
                ->addColumn('max_end', function($row){
                    return format_date($row->shift->max_end_time, 'H:i:s a');
                })
                ->addColumn('end', function($row){
                    return format_date($row->shift->end_time, 'H:i:s a');
                })
                ->addColumn('min_end', function($row){
                    return format_date($row->shift->min_end_time, 'H:i:s a');
                })
                ->addColumn('break', function($row){
                    return format_date($row->shift->break, 'H:i:s a');
                })
                ->addColumn('date', function($row){
                    return format_date($row->date_, 'd M, Y');
                })
                ->addColumn('published', function($row){
                    return ($row->is_published == 1) ? True: False;
                })
                ->addColumn('extra_hrs', function($row){
                    return ($row->accept_extra_hrs == 1) ? True: False;
                })
                ->addColumn('created_at', function($row){
                    return format_date($row->created_at, 'd M, Y');
                })
                ->addColumn('shift', function($row){
                    return $row->shift->name;
                })
                ->addColumn('employee', function($row){
                    return $row->employee->emp_id;
                })
                ->addColumn('action',function ($row){
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item edit" data-schedule="'.json_parse(['model' => $row]).'" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a data-id="'.$row->id.'" class="dropdown-item trash_" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make();
        }
        $singleEmp = null;
        if(!empty($request->employee)){
            $singleEmp = Employee::where('id', $request->employee)->first();
        }
        $employees = Employee::get();
        $shifts = Shift::get();
        return view('admin.schedules',compact(
            'title','employees','shifts','dates',
            'singleEmp'
        ));
    }

    public function shiftScheduleTable($data){

    }

    public function store(Request $request){
        $request->validate([
            'employee' => 'required',
            'shift' => 'required',
        ]);
        ShiftSchedule::create([
            'shift_id' => $request->shift,
            'employee_id' => $request->employee,
            'date_' => $request->date,
            'accept_extra_hrs' => !empty($request->extra_hrs),
            'is_published' => !empty($request->published),
            'note' => $request->note,
        ]);
        $notification = notify("Schedule has been created");
        return back()->with($notification);
    }
    public function update(Request $request){
        $request->validate([
            'employee' => 'required',
            'shift' => 'required',
        ]);
        $schedule = ShiftSchedule::find($request->id);
        $shift = Shift::findOrFail($request->shift);
        $schedule_start_time = $request->date.' '.$shift->start_time;
        $schedule_end_time = $request->date.' '.$shift->end_time;
        $schedule_file = null;
        if($request->hasFile('file')){
            // implement file upload
        }
        if(!empty($schedule)){
            $schedule->update([
                'shift_id' => $request->shift,
                'employee_id' => $request->employee,
                'date_' => $request->date,
                'accept_extra_hrs' => !empty($request->extra_hrs),
                'is_published' => !empty($request->published),
                'note' => $request->note,
                'shift_start_time' => $schedule_start_time,
                'shift_end_time' => $schedule_end_time,
            ]);
            $notification = notify("Schedule has been updated");
            return back()->with($notification);
        }
        ShiftSchedule::create([
            'shift_id' => $request->shift,
            'employee_id' => $request->employee,
            'date_' => $request->date,
            'note' => $request->note,
            'shift_start_time' => $schedule_start_time,
            'shift_end_time' => $schedule_end_time,
        ]);
        $notification = notify('Schedule has been added');
        return back()->with($notification);
    }
    public function destroy(Request $request){
        ShiftSchedule::findOrFail($request->id)->delete();
        $notification = notify("Schedule has been deleted");
        return back()->with($notification);
    }
}
