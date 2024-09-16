<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Http\Livewire\Modal;
use Livewire\WithFileUploads;
use App\Models\Policy as PolicyModel;

class Policy extends Modal
{
    use WithFileUploads;

    public $policyId;

    public $name, $description, $department, $file;

    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];

    public function delete(){
        $policy = PolicyModel::findOrFail($this->policyId);
        $policy->delete();
        $this->emit('notify', ['message' => "Policy has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function edit(){
        if(!empty($this->data)){
            $policy = PolicyModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->policyId = $policy->id;
            $this->name = $policy->name;
            $this->description = $policy->description;
            $this->department = $policy->department_id;
            $this->file = $policy->file;
        }
    }

    public function update(){
        $this->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        if(is_object($this->file)){
            $this->validate([
                'file' => 'nullable|file|mimes:pdf',
            ]);
            $file = $this->file->getClientOriginalName();
            $this->file->storeAs('policies',$file,'public');
        }
        $policy = PolicyModel::findOrFail($this->policyId);
        $policy->update([
            'name' => $this->name ?? $policy->name,
            'description' => $this->description ?? $policy->description,
            'department_id' => $this->department ?? $policy->department_id,
            'file' => $file ?? $policy->file,
        ]);
        $this->emit('notify', ['message' => "Policy has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function store(){
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|file|mimes:pdf',
        ]);
        if(is_object($this->file)){
            $file = $this->file->getClientOriginalName();
            $this->file->storeAs('policies',$file,'public');
        }
        PolicyModel::create([
            'name' => $this->name,
            'description' => $this->description,
            'department_id' => $this->department,
            'file' => $file,
        ]);
        $this->emit('notify', ['message' => "Policy has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        $departments = Department::get();
        return view('livewire.policy',compact(
            'departments'
        ));
    }
}
