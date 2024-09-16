@extends('layouts.master')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-page-header title="{{$title}}">
            <div class="col-auto float-right ml-auto">
                <a href="javascript:void(0)" onclick="Livewire.emit('openModal')" class="btn add-btn"><i class="fa fa-plus"></i> Add Employee</a>
                <div class="view-icons">
                    <a href="{{route('employees.index')}}" class="grid-view btn btn-link"><i class="fa fa-th"></i></a>
                    <a href="{{route('employees.list')}}" class="list-view btn btn-link active"><i class="fa fa-bars"></i></a>
                </div>
            </div>
        </x-page-header>
        <!-- /Page Header -->

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table w-100 datatable">
                        <thead>
                            <tr>
                                <th style="width: 30px;">#</th>
                                <th>Employee ID</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Active</th>
                                <th>Join Date</th>
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
    <!-- /Page Content -->
@endsection
@push('modals')
    @livewire('employee')
@endpush

@push('page-scripts')
    <script>
        $(document).ready(function(){
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('employees.list')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'emp_id', name: 'emp_id'},
                    {data: 'name', name: 'name'},
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'active', name: 'active'},
                    {data: 'date_joined', name: 'date_joined'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            })
        })

    </script>
@endpush
