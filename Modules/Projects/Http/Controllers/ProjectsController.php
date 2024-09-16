<?php

namespace Modules\Projects\Http\Controllers;

use App\Models\Client;
use App\Models\Employee;
use App\Settings\ThemeSettings;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Projects\Entities\Project;
use Illuminate\Contracts\Support\Renderable;
use Modules\Projects\Entities\ProjectTeam;
use Yajra\DataTables\DataTables;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $title = 'Projects';
        $projects = Project::with(['team'])->get();
        return view('projects::index', compact(
            'title','projects'
        ));
    }

    public function list(Request $request){
        $title = 'Project List';
        if($request->ajax()){
            $projects = Project::with(['team'])->get();
            return DataTables::of($projects)
                ->addIndexColumn()
                ->addColumn('project_priority', function($row){
                    $btn = null;
                    switch($row->priority)
                    {
                        case 'High':
                            $btn = 'danger';
                            break;
                        case 'Medium':
                            $btn = 'warning';
                            break;
                        case 'Success':
                            $btn = 'success';
                            break;
                    }

                    return '<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-'.$btn.'"></i> '.$row->priority.'</a>';

                })
                ->addColumn('project_status', function($row){
                    $btn = null;
                    switch($row->status)
                    {
                        case 'InActive':
                            $btn = 'danger';
                            break;
                        case 'Active':
                            $btn = 'success';
                            break;
                    }

                    return '<a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-'.$btn.'"></i> '.$row->status.'</a>';

                })
                ->addColumn('deadline', function($row){
                    return format_date($row->ends_on, 'd M Y');
                })
                ->addColumn('team_members', function($row){
                    $team_members = array_map(function($team){
                        if(!empty($team)){
                            return $team->employee->user->firstname.' '.$team->employee->user->lastname;
                        }
                    }, $row->team->all());
                    return $team_members;
                })
                ->addColumn('rate', function($row){
                    $currency = (new ThemeSettings())->currency_symbol;
                    return "{$currency} {$row->rate} ({$row->rate_type})";
                })
                ->addColumn('leader', function($row){
                    return $row->leader->user->firstname.' '.$row->leader->user->lastname;
                })
                ->addColumn('project_name', function($row){
                    $a = '<a target="_blank" href="'.route("projects.show", $row->id).'">'.$row->name.'</a>';
                    return $a;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item editbtn"
                                    data-project="'.json_parse($row->toArray()).'"
                                    href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item deletebtn" data-id="'.$row->id.'" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>';

                    return $btn;
                })
                ->rawColumns(['action','project_priority','project_status','project_name'])
                ->make();
        }
        return view('projects::list',compact(
            'title',
        ));
    }


    public function leads(Request $request){
        $title = 'leads';
        if($request->ajax()){
            $leads = Project::with('leader')->get();
            return DataTables::of($leads)
                ->addIndexColumn()
                ->addColumn('leader_name', function($row){
                    $avatar = !empty($row->leader->user->avatar) ? asset("storage/users/".$row->leader->user->avatar): asset("assets/img/profiles/avatar.jpg");
                    $td = '<h2 class="table-avatar">
                    <a target="_blank" href="'.route('employees.profile', $row->leader->id).'" class="avatar">
                        <img alt="avatar" src="'.$avatar.'">
                    </a>
                    <a target="_blank" href="'.route('employees.profile', $row->leader->id).'">'.($row->leader->user->firstname.' '.$row->leader->user->lastname).'</a>
                </h2>';
                    return $td;
                })
                ->addColumn('team_members', function($row){
                    $team_members = array_map(function($team){
                        if(!empty($team)){
                            return $team->employee->user->firstname.' '.$team->employee->user->lastname;
                        }
                    }, $row->team->all());
                    return $team_members;
                })
                ->addColumn('project_name', function($row){
                    $a = '<a target="_blank" href="'.route("projects.show", $row->id).'">'.$row->name.'</a>';
                    return $a;
                })
                ->addColumn('created_at', function($row){
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('phone', function($row){
                    return $row->leader->user->phone;
                })
                ->addColumn('email', function($row){
                    return $row->leader->user->email;
                })
                ->rawColumns(['leader_name','project_name'])
                ->make();
        }
        return view('projects::leads',compact(
            'title'
        ));
    }


    /**
     * Show the specified resource.
     * @param \Modules\Projects\Entities\Project $project
     * @return Renderable
     */
    public function show(Project $project)
    {
        $title = $project->name;
        return view('projects::show',compact(
            'project','title'
        ));
    }

    public function store(Request $request){
        $request->validate([
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
        ]);
        $files = null;
        if($request->hasFile('project_files')){
            $files = array();
            foreach($request->project_files as $file){
                $fileName = time().'.'.$file->extension();
                $file->move(public_path('storage/projects/'.$request->name), $fileName);
                array_push($files,$fileName);
            }
        }
        $project = Project::create([
            'name' => $request->name,
            'client_id' => $request->client,
            'starts_on' => $request->starts_on,
            'ends_on' => $request->ends_on,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'priority' => $request->priority,
            'leader_id' => $request->leader,
            'description' => $request->description,
            'files' => $files,
            'added_by' => auth()->user()->id,
            'status' => $request->status
        ]);
        if((count($request->team) > 0)){
            foreach($request->team as $team){
                ProjectTeam::create([
                    'project_id' => $project->id,
                    'employee_id' => $team,
                ]);
            }
        }
        $notification = notify('project has been added');
        return back()->with($notification);
    }
    public function update(Request $request){
        $request->validate([
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
        ]);
        $project = Project::findOrFail($request->id);
        $files = $project->files;
        if($request->hasFile('project_files')){
            $files = array();
            foreach($request->project_files as $file){
                $fileName = time().'.'.$file->extension();
                $file->move(public_path('storage/projects/'.$request->name), $fileName);
                array_push($files,$fileName);
            }
        }
        $project->update([
            'name' => $request->name,
            'client_id' => $request->client,
            'starts_on' => $request->starts_on,
            'ends_on' => $request->ends_on,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'priority' => $request->priority,
            'leader_id' => $request->leader,
            'description' => $request->description,
            'files' => $files,
            'added_by' => auth()->user()->id,
            'status' => $request->status,
            'progress' => $request->progress,
        ]);
        if((count($request->team) > 0)){
            foreach($request->team as $team){
                $project_team = ProjectTeam::find($team);
                if(!empty($project_team)){
                    $project_team->update([
                        'project_id' => $project->id,
                        'employee_id' => $team,
                    ]);
                }else{

                    ProjectTeam::create(
                    [
                        'project_id' => $project->id,
                        'employee_id' => $team,
                    ]);
                }
            }
        }
        $notification = notify('project has been updated');
        return back()->with($notification);
    }


    public function destroy(Request $request){
        $project = Project::findOrFail($request->id);
        // $project->team()->delete();
        $project->delete();
        $notification = notify("Project has been deleted");
        return back()->with($notification);
    }

}
