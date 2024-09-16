<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\Employee;
use App\Models\Leave as LeaveModel;
use App\Models\LeaveType;
use App\Models\User;

class Leave extends Modal
{
    public $type, $employee, $status, $starts, $ends, $days, $reason, $leaveId;
    public $days_left = 0;

    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];
    protected $rules = [
        'type' => 'required|string',
        'employee' => 'required',
        'starts' => 'required|date',
        'ends' => 'required|date',
        'reason' => 'required|string',
    ];

    public function store(){
        $this->validate();
        $s = new \DateTime($this->starts);
        $e = new \DateTime($this->ends);
        $days = $s->diff($e)->format("%d");
        LeaveModel::create([
            'leave_type_id' => $this->type,
            'employee_id' => $this->employee,
            'starts_on' => $this->starts,
            'ends_on' => $this->ends,
            'days' => $days,
            'reason' => $this->reason,
            'status' => $this->status,
        ]);
        $this->emit('notify', ['message' => "Leave has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function edit(){
        if(!empty($this->data)){
            $leave = LeaveModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->leaveId = $leave->id;
            $this->type = $leave->leave_type_id;
            $this->employee = $leave->employee_id;
            $this->starts = $leave->starts_on;
            $this->ends = $leave->ends_on;
            $this->days = $leave->days;
            $this->reason = $leave->reason;
            $this->status = $leave->status;

            $start_date = new \DateTime();
            $end_date = new \DateTime($leave->ends_on);
            $this->days_left = $start_date->diff($end_date)->format("%d");
        }
    }

    public function update(){
        $leave = LeaveModel::findOrFail($this->leaveId);
        $leave->update([
            'leave_type_id' => $this->type,
            'employee_id' => $this->employee,
            'starts_on' => $this->starts,
            'ends_on' => $this->ends,
            'days' => $this->days,
            'reason' => $this->reason,
            'status' => $this->status,
        ]);
        $this->emit('notify', ['message' => "Leave has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $leave = LeaveModel::findOrFail($this->leaveId);
        $leave->delete();
        $this->emit('notify', ['message' => "Leave has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        $employees = Employee::with(['user'])->get();
        $leave_types = LeaveType::get();
        return view('livewire.leave',compact(
            'employees','leave_types'
        ));
    }
}
