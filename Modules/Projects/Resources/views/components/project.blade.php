@props(['project' => $project])
<div class="col-lg-4 col-sm-6 col-md-4 col-xl-3">
    <div class="card">
        <div class="card-body">
            <div class="dropdown dropdown-action profile-action">
                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item editbtn" data-project="{{json_encode($project)}}" href="javascript:void(0)"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                    <a class="dropdown-item deletebtn" data-id="{{$project->id}}" href="javascript:void(0)"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
            </div>
            <h4 class="project-title"><a href="{{route('projects.show', $project->id)}}">{{$project->name}}</a></h4>
            <p class="text-muted">
                {!! substr($project->description,0,120)!!}
            </p>
            <div class="pro-deadline m-b-15">
                <div class="sub-title">
                    Deadline:
                </div>
                <div class="text-muted">
                    {{format_date($project->ends_on, 'd M Y')}}
                </div>
            </div>
            <div class="project-members m-b-15">
                <div>Project Leader :</div>
                <ul class="team-members">
                    <li>
                        <a href="{{route('employees.profile', $project->leader->id)}}" data-toggle="tooltip" title="{{$project->leader->user->firstname.' '.$project->leader->user->lastname}}">
                            <img alt="avatar" src="{{!empty($project->leader->user->avatar) ? asset('storage/users/'.$project->leader->user->avatar): asset('assets/img/profiles/avatar.jpg')}}"></a>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="project-members m-b-15">
                <div>Team :</div>
                <ul class="team-members">
                    @foreach ($project->team as $key => $team_member)
                    @if ($key != 4)
                    <li>
                        <a target="_blank" href="{{route('employees.profile', $team_member->id)}}" data-toggle="tooltip" title="{{$team_member->employee->user->firstname. ' '. $team_member->employee->user->lastname}}"><img alt="avatar" src="{{!empty($team_member->employee->user->avatar) ? asset('storage/users/'.$team_member->employee->user->avatar): asset('assets/img/profiles/avatar.jpg')}}"></a>
                    </li>
                    @endif
                    @endforeach
                    @if ($project->team->count() > 4)
                    <li class="dropdown avatar-dropdown">
                        <a href="#" class="all-users dropdown-toggle" data-toggle="dropdown" aria-expanded="false">+{{count($project->team) - 4}}</a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="avatar-group">
                                @foreach ($project->team as $key => $team_member)
                                @if ($key >= 4)
                                <li>
                                    <a class="avatar avatar-xs" target="_blank" href="{{route('employees.profile', $team_member->id)}}" data-toggle="tooltip" title="{{$team_member->employee->user->firstname. ' '. $team_member->employee->user->lastname}}"><img alt="avatar" src="{{!empty($team_member->employee->user->avatar) ? asset('storage/users/'.$team_member->employee->user->avatar): asset('assets/img/profiles/avatar.jpg')}}"></a>
                                </li>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </li>
                    @endif

                </ul>
            </div>
            <p class="m-b-5">Progress <span class="text-success float-right">{{$project->progress}}%</span></p>
            <div class="progress progress-xs mb-0">
                <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="{{$project->progress}}%" style="width: {{$project->progress}}%"></div>
            </div>
        </div>
    </div>
</div>
