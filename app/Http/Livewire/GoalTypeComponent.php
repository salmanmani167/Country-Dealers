<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\GoalType;

class GoalTypeComponent extends Modal
{

    public $goalTypeId, $name, $description;

    protected $rules = [
        'name' => 'required|max:100',
        'description' => 'nullable|max:255'
    ];

    protected $listeners = [
        'openModal',
        'hasData' => 'getData',
    ];

    public function store(){
        $this->validate();
        GoalType::create([
            'type' => $this->name,
            'description' => $this->description
        ]);
        $this->emit('notify', ['message' => "Goal Type has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');

    }

    public function getData(){
        if(!empty($this->data)){
            $goalType = GoalType::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->goalTypeId = $goalType->id;
            $this->name = $goalType->type;
            $this->description = $goalType->description;
        }
    }

    public function update(){
        $this->validate();
        $goalType = GoalType::findOrFail($this->goalTypeId);
        $goalType->update([
            'type' => $this->name,
            'description' => $this->description
        ]);
        $this->emit('notify', ['message' => "Goal Type has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $goalType = GoalType::findOrFail($this->goalTypeId);
        $goalType->delete();
        $this->emit('notify', ['message' => "Goal Type has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        return view('livewire.goal-type-component');
    }
}
