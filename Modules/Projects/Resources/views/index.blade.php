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
                <a href="javascript:void(0)" data-toggle="modal" data-target="#create_project" class="btn add-btn"><i class="fa fa-plus"></i> Add Project</a>
                <div class="view-icons">
                    <a href="{{route('projects.index')}}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                    <a href="{{route('projects.list')}}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </x-page-header>
        <!-- /Page Header -->

        <div class="row">
            @foreach ($projects as $project)
            <x-projects::project :project="$project" />
            @endforeach
        </div>
    </div>
    <!-- /Page Content -->
@endsection

@push('modals')
<livewire:projects::project-component />
@endpush

@section('page-scripts')
<!-- Summernote JS -->
<script src="{{asset('assets/plugins/summernote/dist/summernote-bs4.min.js')}}"></script>
@endsection

