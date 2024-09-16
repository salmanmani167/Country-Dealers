<?php

namespace Modules\Projects\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use App\Models\Employee;
use App\Http\Livewire\Modal;
use Livewire\WithFileUploads;
use Modules\Projects\Entities\ProjectTeam;
use Modules\Projects\Entities\Project as ProjectModel;

class Project extends Modal
{
    use WithFileUploads;

    public $name, $client, $starts_on, $ends_on, $rate, $rate_type, $priority, $leader, $description, $files, $status, $projectId;
    public $refeshPage = false;
    public $team = [];

    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];

    protected $rules = [
        'name' => 'required',
        'client' => 'required',
        'starts_on' => 'required|date',
        'ends_on' => 'required|date',
        'rate' => 'required',
        'rate_type' => 'required',
        'priority' => 'required',
        'leader' => 'required',
        'team' => 'required',
        'description' => 'required'
    ];

    public function store(){
        dd($this);
        $this->validate();
        $uploaded_files = null;
        if(is_object($this->files)){
            $uploaded_files = $this->files->getClientOriginalName();
            $this->avatar->storeAs('projects',$uploaded_files,'public');
        }
        $project = ProjectModel::create([
            'name' => $this->name,
            'client_id' => $this->client,
            'starts_on' => $this->starts_on,
            'ends_on' => $this->ends_on,
            'rate' => $this->rate,
            'rate_type' => $this->rate_type,
            'priority' => $this->priority,
            'leader_id' => $this->leader,
            'description' => $this->description,
            'files' => $uploaded_files,
            'added_by' => auth()->user()->id,
            'status' => $this->status
        ]);
        if(count($this->team)){
            foreach($this->team as $team){
                ProjectTeam::create([
                    'project_id' => $project->id,
                    'employee_id' => $team,
                ]);
            }
        }
        if($this->refreshPage != true){
            $this->emit('reloadTable');
        }else{
            $this->emit('reloadPage');
        }
    }

    public function edit(){
        if(!empty($this->data)){
            $project = ProjectModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->projectId =$project->id;
            $this->name =$project->name;
            $this->client =$project->client_id;
            $this->starts_on =$project->starts_on;
            $this->ends_on =$project->ends_on;
            $this->rate = $project->rate;
            $this->rate_type = $project->rate_type;
            $this->priority = $project->priority;
            $this->leader = $project->leader_id;
            $this->description = $project->description;
            $this->files = $project->files;
            $this->status = $project->status;
        }
    }

    public function update(){
        $this->validate();
        $uploaded_files = null;
        if(is_object($this->files)){
            $uploaded_files = $this->files->getClientOriginalName();
            $this->avatar->storeAs('projects',$uploaded_files,'public');
        }
        $project = ProjectModel::findOrFail($this->projectId);
        $project->update([
            'name' => $this->name,
            'client_id' => $this->client,
            'starts_on' => $this->starts_on,
            'ends_on' => $this->ends_on,
            'rate' => $this->rate,
            'rate_type' => $this->rate_type,
            'priority' => $this->priority,
            'leader_id' => $this->leader,
            'description' => $this->description,
            'files' => $uploaded_files,
            'added_by' => auth()->user()->id,
            'status' => $this->status
        ]);
        $this->emit('notify', ['message' => 'Project has been updated']);
        $this->closeModal();
        if($this->refreshPage != true){
            $this->emit('reloadTable');
        }else{
            $this->emit('reloadPage');
        }
    }

    public function delete(){
        ProjectModel::findOrFail($this->projectId)->delete();
        $this->emit('notify', ['message' => 'Project has been deleted']);
        $this->closeModal();
        if($this->refreshPage != true){
            $this->emit('reloadTable');
        }else{
            $this->emit('reloadPage');
        }
    }

    public function render()
    {
        $clients = Client::get();
        $employees = Employee::get();
        return view('projects::livewire.project',compact(
            'clients','employees'
        ));
    }
}
