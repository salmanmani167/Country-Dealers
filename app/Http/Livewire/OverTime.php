<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\Employee;
use App\Models\Overtime as OvertimeModel;

class OverTime extends Modal
{

    public $overtimeId,$employee, $otd, $oth, $description, $ot_type,$approved;
    protected $listeners = [
        'openModal',
        'hasData' => 'getOvertime',
    ];

    protected $rules = [
        'employee' => 'required',
        'oth' => 'required',
        'otd' => 'required',
        'description' => 'required',
        'ot_type' => 'required',
    ];

    public function getOvertime(){
        if(!empty($this->data)){
            $overtime = OvertimeModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->overtimeId = $overtime->id;
            $this->employee = $overtime->employee_id;
            $this->otd = $overtime->overtime_date;
            $this->oth = $overtime->hours;
            $this->ot_type = $overtime->type;
            $this->description = $overtime->description;
            $this->approved = $overtime->approved;
        }
    }

    public function store(){
        $this->validate();
        OvertimeModel::create([
            'employee_id' => $this->employee,
            'overtime_date' => $this->otd,
            'hours' => $this->oth,
            'type' => $this->ot_type,
            'description' => $this->description,
            'approved' => $this->approved,
        ]);
        $this->emit('notify', ['message' => "Overtime has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }


    public function update(){
        $this->validate();
        $overtime = OvertimeModel::findOrFail($this->overtimeId);
        $overtime->update([
            'employee_id' => $this->employee,
            'overtime_date' => $this->otd,
            'hours' => $this->oth,
            'type' => $this->ot_type,
            'description' => $this->description,
            'approved' => $this->approved,
        ]);
        $this->emit('notify', ['message' => "Overtime has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $overtime = OvertimeModel::findOrFail($this->overtimeId);
        $overtime->delete();
        $this->emit('notify', ['message' => "Overtime has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        $employees = Employee::get();
        return view('livewire.over-time',compact(
            'employees'
        ));
    }
}
