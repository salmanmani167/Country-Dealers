<?php

namespace Modules\EmployeeAttendance\Http\Controllers;

use App\Models\Employee;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Modules\EmployeeAttendance\Entities\Attendance;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $title = 'attendance';
        if($request->ajax()){
            $attendance = auth()->user()->employee->attendance;
            return DataTables::of($attendance)
                ->addIndexColumn()
                ->addColumn('punchin', function($row){
                    return format_date($row->checkin,'H:i a');
                })
                ->addColumn('punchout', function($row){
                    return format_date($row->checkout,'H:i a');
                })
                ->addColumn('hours', function($row){
                    return $row->hours_difference.' '. Str::plural('Hour',$row->hours_difference);
                })
                ->addColumn('created_at', function($row){
                    return format_date($row->created_at, 'Y-m-d');
                })
                ->make();
        }
        return view('employeeattendance::index',compact(
            'title'
        ));
    }

    public function admin(Request $request){

        $title = 'Employee Attendance';
        $currentMonth = $request->month ?? Carbon::now()->month;
        $currentYear = $request->year ?? Carbon::now()->year;
        $startYear = 2020;
        $years_range = CarbonPeriod::create("$startYear-01-01", Carbon::now()->year."-12-31")->years();
        $days_in_month = Carbon::createFromDate($currentYear, $currentMonth)->daysInMonth;
        $employees = Employee::with(['attendance' => function ($query) use ($currentMonth,$currentYear) {
            $query->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->orderBy('created_at', 'desc')
                ->take(1);
        }])->get();
        return view('employeeattendance::admin-attendance',compact(
            'title','years_range','days_in_month','employees',
        ));
    }
}
