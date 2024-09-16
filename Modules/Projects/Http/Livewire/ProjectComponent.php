<?php

namespace Modules\Projects\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use App\Models\Employee;
use Modules\Projects\Entities\Project;

class ProjectComponent extends Component
{
    public function render()
    {
        $clients = Client::get();
        $employees = Employee::get();
        $projects = Project::with(['team'])->get();
        return view('projects::livewire.project-component',compact(
            'clients','employees','projects'
        ));
    }
}
