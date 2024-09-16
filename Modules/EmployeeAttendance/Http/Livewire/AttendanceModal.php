<?php

namespace Modules\EmployeeAttendance\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Modal;
use Modules\EmployeeAttendance\Entities\Attendance;

class AttendanceModal extends Modal
{
    public $attendance;

    protected $listeners = [
        'openModal',
        'hasData' => 'getAttendance',
    ];

    public function getAttendance(){
        if(!empty($this->data)){
            $attendance = Attendance::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->attendance = $attendance;
        }
    }

    public function render()
    {
        return view('employeeattendance::livewire.attendance-modal');
    }
}
