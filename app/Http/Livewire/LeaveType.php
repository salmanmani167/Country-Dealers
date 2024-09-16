<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\LeaveType as LeaveTypeModel;

class LeaveType extends Modal
{

    public $type, $days, $leaveTypeId;

    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];
    protected $rules = [
        'type' => 'required|string',
        'days' => 'required|integer'
    ];

    public function store(){
        $this->validate();
        LeaveTypeModel::create([
            'type' => $this->type,
            'days' => $this->days
        ]);
        $this->emit('notify', ['message' => "Leave Type has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function edit(){
        if(!empty($this->data)){
            $leaveType = LeaveTypeModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->leaveTypeId = $leaveType->id;
            $this->type = $leaveType->type;
            $this->days = $leaveType->days;
        }
    }

    public function update(){
        $leaveType = LeaveTypeModel::findOrFail($this->leaveTypeId);
        $leaveType->update([
            'type' => $this->type,
            'days' => $this->days,
        ]);
        $this->emit('notify', ['message' => "Leave Type has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $leaveType = LeaveTypeModel::findOrFail($this->leaveTypeId);
        $leaveType->delete();
        $this->emit('notify', ['message' => "Leave Type has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        return view('livewire.leave-type');
    }
}
