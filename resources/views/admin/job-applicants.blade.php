@extends('layouts.master')

@push('page-styles')
<!-- Datatable CSS -->
<link rel="stylesheet" href="{{asset('assets/css/dataTables.bootstrap4.min.css')}}">
@endpush


@section('content')
<div class="content container-fluid">
    <!-- Page Header -->
    <x-page-header title="Job Applications">

    </x-page-header>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 datatable">
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Apply Date</th>
                            <th class="text-center">Status</th>
                            <th>Resume</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($applicants as $applicant)
                            <tr>
                                <td>{{$applicant->Job->title}}</td>
                                <td>{{$applicant->name}}</td>
                                <td>{{$applicant->email}}</td>
                                <td>{{$applicant->created_at->diffForHumans()}}</td>
                                <td class="text-center">
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-dot-circle-o text-info"></i> New
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-info"></i> New</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-success"></i> Hired</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Rejected</a>
                                            <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i> Interviewed</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{asset('storage/cv/'.$applicant->cv)}}" target="_blank" download="{{$applicant->name.'-cv'}}" rel="noopener noreferrer">Download</a>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fa fa-clock-o m-r-5"></i> Schedule Interview</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


@push('page-scripts')
	<!-- Datatable JS -->
	<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
@endpush
