<?php

namespace Modules\EmployeeAttendance\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Settings\AttendanceSettings;
use Modules\EmployeeAttendance\Entities\Attendance as AttendanceModel;

class Attendance extends Component
{
    public $checkin = true;

    protected $todayAttendance;

    public function mount()
    {
        $today_record = AttendanceModel::whereDate('created_at', Carbon::today())->where('employee_id',auth()->user()->employee->id)->first();
        $this->todayAttendance = $today_record;
        if(!empty($today_record) && !empty($today_record->checkout)){
            $this->checkin = 'Close';
        }elseif(!empty($today_record) && empty($today_record->checkout)){
            $this->checkin = false;
        }
    }

    public function punchin(){
        $settings = new AttendanceSettings();
        $time = now()->toTimeString();
        $min_checkin_time = strtotime($settings->checkin_time) + 1800;
        if($time < $settings->checkin_time){
            $status = 'early';
        }if($time <= date('H:i',$min_checkin_time)){
            $status = 'ontime';
        }else{
            $status = 'late';
        }
       AttendanceModel::create([
            'employee_id' => auth()->user()->employee->id,
            'checkin' => date('H:i:s'),
            'checkout' => null,
            'status' => $status,
        ]);
        $this->checkin = false;
        $this->emit('reloadPage');
        $this->emit('notify', ['message' => "You have successfully checked in"]);
    }

    public function punchout(){
        $today_record = AttendanceModel::whereDate('created_at', Carbon::today())->where('employee_id',auth()->user()->employee->id)->first();
        $today_record->update([
            'checkout' => now()->toTimeString(),
        ]);
        $this->checkin = 'Close';
        $this->emit('reloadPage');
        $this->emit('notify', ['message' => "You have successfully checked out"]);
    }

    public function render()
    {
        $todayAttendance = $this->todayAttendance;
        $hrs_count = !empty($todayAttendance) ? $todayAttendance->hours_difference: 0;
        $this_week = auth()->user()->employee->attendance()->whereBetween('created_at', [Carbon::now ()->startOfWeek (), Carbon::now ()->endOfWeek ()])->get()->sum('hours_difference');
        $last_week = auth()->user()->employee->attendance()->where('created_at', '>', Carbon::now()->subWeek())->get()->sum('hours_difference');
        $this_month = auth()->user()->employee->attendance()->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->startOfMonth()->addMonth()])->get()->sum('hours_difference');
        return view('employeeattendance::livewire.attendance',compact(
            'todayAttendance','hrs_count','this_week','last_week','this_month'
        ));
    }
}
