@extends('layouts.master')

@push('page-styles')
    <!-- Summernote CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote-bs4.css')}}">
@endpush

@section('content')
<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
        <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0)" data-project="{{$project->with(['team'])->first()}}" class="btn add-btn editbtn"><i class="fa fa-pencil"></i> Edit Project</a>
            <div class="view-icons">
                <a href="{{route('projects.index')}}" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                <a href="{{route('projects.list')}}" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
            </div>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-8 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="project-title mb-2">
                        <h5 class="card-title"><b>{{$project->name}}</b></h5>
                        {{-- <small class="block text-ellipsis m-b-15"><span class="text-xs">2</span> <span class="text-muted">open tasks, </span><span class="text-xs">5</span> <span class="text-muted">tasks completed</span></small> --}}
                    </div>
                    {!! $project->description !!}
                </div>
            </div>

            {{-- <div class="card">
                <div class="card-body">
                    <h5 class="card-title m-b-20">Uploaded files</h5>
                    <ul class="files-list">
                        <li>
                            <div class="files-cont">
                                <div class="file-type">
                                    <span class="files-icon"><i class="fa fa-file-pdf-o"></i></span>
                                </div>
                                <div class="files-info">
                                    <span class="file-name text-ellipsis"><a href="#">AHA Selfcare Mobile Application Test-Cases.xls</a></span>
                                    <span class="file-author"><a href="#">John Doe</a></span> <span class="file-date">May 31st at 6:53 PM</span>
                                    <div class="file-size">Size: 14.8Mb</div>
                                </div>
                                <ul class="files-action">
                                    <li class="dropdown dropdown-action">
                                        <a href="" class="dropdown-toggle btn btn-link" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)">Download</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#share_files">Share</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <div class="files-cont">
                                <div class="file-type">
                                    <span class="files-icon"><i class="fa fa-file-pdf-o"></i></span>
                                </div>
                                <div class="files-info">
                                    <span class="file-name text-ellipsis"><a href="#">AHA Selfcare Mobile Application Test-Cases.xls</a></span>
                                    <span class="file-author"><a href="#">Richard Miles</a></span> <span class="file-date">May 31st at 6:53 PM</span>
                                    <div class="file-size">Size: 14.8Mb</div>
                                </div>
                                <ul class="files-action">
                                    <li class="dropdown dropdown-action">
                                        <a href="" class="dropdown-toggle btn btn-link" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_horiz</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)">Download</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#share_files">Share</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="project-task">
                <ul class="nav nav-tabs nav-tabs-top nav-justified mb-0">
                    <li class="nav-item"><a class="nav-link active" href="#all_tasks" data-toggle="tab" aria-expanded="true">All Tasks</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pending_tasks" data-toggle="tab" aria-expanded="false">Pending Tasks</a></li>
                    <li class="nav-item"><a class="nav-link" href="#completed_tasks" data-toggle="tab" aria-expanded="false">Completed Tasks</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="all_tasks">
                        <div class="task-wrapper">
                            <div class="task-list-container">
                                <div class="task-list-body">
                                    <ul id="task-list">
                                        <li class="task">
                                            <div class="task-container">
                                                <span class="task-action-btn task-check">
                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                        <i class="material-icons">check</i>
                                                    </span>
                                                </span>
                                                <span class="task-label" contenteditable="true">Patient appointment booking</span>
                                                <span class="task-action-btn task-btn-right">
                                                    <span class="action-circle large" title="Assign">
                                                        <i class="material-icons">person_add</i>
                                                    </span>
                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                        <i class="material-icons">delete</i>
                                                    </span>
                                                </span>
                                            </div>
                                        </li>
                                        <li class="task">
                                            <div class="task-container">
                                                <span class="task-action-btn task-check">
                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                        <i class="material-icons">check</i>
                                                    </span>
                                                </span>
                                                <span class="task-label" contenteditable="true">Appointment booking with payment gateway</span>
                                                <span class="task-action-btn task-btn-right">
                                                    <span class="action-circle large" title="Assign">
                                                        <i class="material-icons">person_add</i>
                                                    </span>
                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                        <i class="material-icons">delete</i>
                                                    </span>
                                                </span>
                                            </div>
                                        </li>
                                        <li class="completed task">
                                            <div class="task-container">
                                                <span class="task-action-btn task-check">
                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                        <i class="material-icons">check</i>
                                                    </span>
                                                </span>
                                                <span class="task-label">Doctor available module</span>
                                                <span class="task-action-btn task-btn-right">
                                                    <span class="action-circle large" title="Assign">
                                                        <i class="material-icons">person_add</i>
                                                    </span>
                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                        <i class="material-icons">delete</i>
                                                    </span>
                                                </span>
                                            </div>
                                        </li>
                                        <li class="task">
                                            <div class="task-container">
                                                <span class="task-action-btn task-check">
                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                        <i class="material-icons">check</i>
                                                    </span>
                                                </span>
                                                <span class="task-label" contenteditable="true">Patient and Doctor video conferencing</span>
                                                <span class="task-action-btn task-btn-right">
                                                    <span class="action-circle large" title="Assign">
                                                        <i class="material-icons">person_add</i>
                                                    </span>
                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                        <i class="material-icons">delete</i>
                                                    </span>
                                                </span>
                                            </div>
                                        </li>
                                        <li class="task">
                                            <div class="task-container">
                                                <span class="task-action-btn task-check">
                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                        <i class="material-icons">check</i>
                                                    </span>
                                                </span>
                                                <span class="task-label" contenteditable="true">Private chat module</span>
                                                <span class="task-action-btn task-btn-right">
                                                    <span class="action-circle large" title="Assign">
                                                        <i class="material-icons">person_add</i>
                                                    </span>
                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                        <i class="material-icons">delete</i>
                                                    </span>
                                                </span>
                                            </div>
                                        </li>
                                        <li class="task">
                                            <div class="task-container">
                                                <span class="task-action-btn task-check">
                                                    <span class="action-circle large complete-btn" title="Mark Complete">
                                                        <i class="material-icons">check</i>
                                                    </span>
                                                </span>
                                                <span class="task-label" contenteditable="true">Patient Profile add</span>
                                                <span class="task-action-btn task-btn-right">
                                                    <span class="action-circle large" title="Assign">
                                                        <i class="material-icons">person_add</i>
                                                    </span>
                                                    <span class="action-circle large delete-btn" title="Delete Task">
                                                        <i class="material-icons">delete</i>
                                                    </span>
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="task-list-footer">
                                    <div class="new-task-wrapper">
                                        <textarea  id="new-task" placeholder="Enter new task here. . ."></textarea>
                                        <span class="error-message hidden">You need to enter a task first</span>
                                        <span class="add-new-task-btn btn" id="add-task">Add Task</span>
                                        <span class="btn" id="close-task-panel">Close</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="pending_tasks"></div>
                    <div class="tab-pane" id="completed_tasks"></div>
                </div>
            </div> --}}
        </div>
        <div class="col-lg-4 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title m-b-15">Project details</h6>
                    <table class="table table-striped table-border">
                        <tbody>
                            <tr>
                                <td>Cost:</td>
                                <td class="text-right">{{(new \App\Settings\ThemeSettings())->currency_symbol. ' '. $project->rate}}</td>
                            </tr>
                            <tr>
                                <td>Total Hours:</td>
                                <td class="text-right">100 Hours</td>
                            </tr>
                            <tr>
                                <td>Created:</td>
                                <td class="text-right">{{format_date($project->created_at,' d M, Y')}}</td>
                            </tr>
                            <tr>
                                <td>Date Started:</td>
                                <td class="text-right">{{format_date($project->starts_on,' d M, Y')}}</td>
                            </tr>
                            <tr>
                                <td>Deadline:</td>
                                <td class="text-right">{{format_date($project->ends_on,' d M, Y')}}</td>
                            </tr>
                            <tr>
                                <td>Priority:</td>
                                <td class="text-right">
                                    @php
                                        $color = null;
                                        switch ($project->priority) {
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
                                    @endphp
                                    <a href="#"><i class="fa fa-dot-circle-o text-{{$color}}"></i> {{$project->priority}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Created by:</td>
                                <td class="text-right">{{$project->addedBy->firstname.' '.$project->addedBy->lastname}}</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td class="text-right">{{$project->status}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="m-b-5">Progress <span class="text-success float-right">{{$project->progress}}%</span></p>
                    <div class="progress progress-xs mb-0">
                        <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="{{$project->progress}}%" style="width: {{$project->progress}}%"></div>
                    </div>
                </div>
            </div>
            <div class="card project-user">
                <div class="card-body">
                    <h6 class="card-title m-b-20">Assigned Leader </h6>
                    <ul class="list-box">
                        <li>
                            <a href="{{route('employees.profile', $project->leader->id)}}" data-toggle="tooltip" title="{{$project->leader->user->firstname.' '.$project->leader->user->lastname}}">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">
                                            <img alt="avatar" src="{{!empty($project->leader->user->avatar) ? asset('storage/users/'.$project->leader->user->avatar): asset('assets/img/profiles/avatar.jpg')}}"></a>
                                        </span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">{{$project->leader->user->firstname.' '.$project->leader->user->lastname}}</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Team Leader</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card project-user">
                <div class="card-body">
                    <h6 class="card-title m-b-20">
                        Assigned users
                    </h6>
                    <ul class="list-box">
                        @foreach ($project->team as $key => $team_member)
                        <li>
                            <a target="_blank" href="{{route('employees.profile', $team_member->id)}}" data-toggle="tooltip" title="{{$team_member->employee->user->firstname. ' '. $team_member->employee->user->lastname}}">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">
                                            <img alt="avatar" src="{{!empty($team_member->employee->user->avatar) ? asset('storage/users/'.$team_member->employee->user->avatar): asset('assets/img/profiles/avatar.jpg')}}">
                                        </span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">{{$team_member->employee->user->firstname. ' '. $team_member->employee->user->lastname}}</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">{{$team_member->employee->designation->name}}</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->
@endsection

@push('modals')
    <livewire:projects::project-component />
@endpush


@push('page-scripts')
<!-- Summernote JS -->
<script src="{{asset('assets/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
@endpush
