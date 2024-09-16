<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department as DepartmentModel;


class Department extends Modal
{
    public $departmentId, $name;
    public $delete = false;
    protected $rules = [
        'name' => 'required|string|unique:departments'
    ];

    protected $listeners = [
        'openModal',
        'hasData' => 'editDepartment',
        'deleteModel' => 'isDelete'
    ];

    public function isDelete(){
        $this->delete = true;
        $this->departmentId = $this->data['model'];
    }

    public function delete(){
        $department = DepartmentModel::findOrFail($this->departmentId);
        $department->delete();
        $this->emit('notify', ['message' => "Department has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function editDepartment(){
        if(!empty($this->data)){
            $department = DepartmentModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->departmentId = $department->id;
            $this->name = $department->name;
        }
    }

    public function update(){
        $this->validate();
        DepartmentModel::findOrFail($this->departmentId)->update([
            'name' => $this->name
        ]);
        $this->emit('notify', ['message' => "Department has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function store(){
        $this->validate();
        DepartmentModel::create([
            'name' => $this->name,
        ]);
        $this->emit('notify', ['message' => "Department has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }
    public function render()
    {
        return view('livewire.department');
    }
}
