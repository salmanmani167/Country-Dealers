@extends('layouts.master')


@section('content')
<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Leads</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Leads</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-nowrap custom-table mb-0 datatable w-100">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Lead Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Project</th>
                            <th>Assigned Staff</th>
                            <th>Created</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->
@endsection

@push('page-scripts')
<script>
    $(document).ready(function(){
        var table = $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: "{{route('projects.leads')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'leader_name', name: 'leader_name'},
                {data: 'email', name: 'email'},
                {data: 'phone', name: 'phone'},
                {data: 'project_name', name: 'project_name'},
                {data: 'team_members', name: 'team_members'},
                {data: 'created_at', name: 'created_at'},
            ],
            initComplete: function(){
                $('tr>td:last-child').addClass('text-right')
            }
        })
    });
</script>
@endpush
