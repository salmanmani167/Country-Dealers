<?php

namespace App\Http\Livewire;

use App\Models\Goal;
use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\GoalType;

class GoalComponent extends Modal
{
    public $goalId, $type, $subject, $target, $starts, $ends, $description, $status;
    public $progress = 0;

    protected $rules = [
        'type' => 'required',
        'subject' => 'required',
        'target' => 'required',
        'starts' => 'required',
        'ends' => 'required',
        'description' => 'nullable|max:255',
        'status' => 'nullable',
    ];

    protected $listeners = [
        'openModal',
        'hasData' => 'getData',
    ];

    public function store(){
        $this->validate();
        Goal::create([
            'goal_type_id' => $this->type,
            'subject' => $this->subject,
            'target' => $this->target,
            'start_date' => $this->starts,
            'end_date' => $this->ends,
            'description' => $this->description,
            'status' => $this->status,
            'progress' => $this->progress,
        ]);
        $this->emit('notify', ['message' => "Goal has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');

    }

    public function getData(){
        if(!empty($this->data)){
            $goal = Goal::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->goalId = $goal->id;
            $this->type = $goal->goal_type_id;
            $this->subject = $goal->subject;
            $this->target = $goal->target;
            $this->starts = $goal->start_date;
            $this->ends = $goal->end_date;
            $this->description = $goal->description;
            $this->status = $goal->status;
            $this->progress = $goal->progress;
        }
    }

    public function update(){
        $this->validate();
        $goal = Goal::findOrFail($this->goalId);
        $goal->update([
            'goal_type_id' => $this->type,
            'subject' => $this->subject,
            'target' => $this->target,
            'start_date' => $this->starts,
            'end_date' => $this->ends,
            'description' => $this->description,
            'status' => $this->status,
            'progress' => $this->progress,
        ]);
        $this->emit('notify', ['message' => "Goal has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $goal = Goal::findOrFail($this->goalId);
        $goal->delete();
        $this->emit('notify', ['message' => "Goal has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }
    public function render()
    {
        $goal_types = GoalType::get();
        return view('livewire.goal-component', compact(
            'goal_types'
        ));
    }
}
