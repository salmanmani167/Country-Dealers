<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Http\Livewire\Modal;
use App\Models\Designation as DesignationModel;

class Designation extends Modal
{
    public $designationId, $name, $department;
    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];
    protected $rules = [
        'department' => 'required',
        'name' => 'required|string'
    ];

    public function edit(){
        if(!empty($this->data)){
            $designation = DesignationModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->designationId = $designation->id;
            $this->name = $designation->name;
            $this->department = $designation->department_id;
        }
    }

    public function update(){
        $this->validate();
        $designation = DesignationModel::findOrFail($this->designationId);
        $designation->update([
            'name' => $this->name ?? $designation->name,
            'department_id' => $this->department ?? $designation->department_id,
        ]);
        $this->emit('notify', ['message' => "Designation has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $designation = DesignationModel::findOrFail($this->designationId);
        $designation->delete();
        $this->emit('notify', ['message' => "Designation has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function store(){
        $this->validate();
        DesignationModel::create([
            'name' => $this->name,
            'department_id' => $this->department,
        ]);
        $this->emit('notify', ['message' => "Designation has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        $departments = Department::get();
        return view('livewire.designation',compact(
            'departments'
        ));
    }
}
