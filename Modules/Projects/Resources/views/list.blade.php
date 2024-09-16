@extends('layouts.master')

@push('page-styles')
    <!-- Summernote CSS -->
	<link rel="stylesheet" href="{{asset('assets/plugins/summernote/dist/summernote-bs4.css')}}">
@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
        <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#create_project" class="btn add-btn"><i class="fa fa-plus"></i> Add Project</a>
            <div class="view-icons">
                <a href="{{route('projects.index')}}" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                <a href="{{route('projects.list')}}" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
            </div>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table datatable w-100">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Leader</th>
                            <th>Team</th>
                            <th>Deadline</th>
                            <th>Priority</th>
                            <th>Rate</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modals')
<livewire:projects::project-component />
@endpush

@section('page-scripts')
<!-- Summernote JS -->
<script src="{{asset('assets/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
<script>
    $(document).ready(function(){
        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: "{{route('projects.list')}}",
            columns: [
                {data: 'project_name', name: 'project_name'},
                {data: 'leader', name: 'leader'},
                {data: 'team_members', name: 'team_members'},
                {data: 'deadline', name: 'deadline'},
                {data: 'project_priority', name: 'project_priority'},
                {data: 'rate', name: 'rate'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            initComplete: function(){
                $('tr>td:last-child').addClass('text-right')
            }
        })
    });
</script>
@endsection
