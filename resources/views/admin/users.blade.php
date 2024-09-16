@extends('layouts.master')

@section('content')
    <!-- Page Content -->
    <div class="content container-fluid">

        <!-- Page Header -->
        <x-page-header title="{{$title}}">
            <div class="col-auto float-right ml-auto">
                <a href="javascript:void(0)" onclick="Livewire.emit('openModal')" class="btn add-btn"><i class="fa fa-plus"></i> Add User</a>
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
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Active</th>
                                <th>Created At</th>
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
    @livewire('user')
@endpush

@push('page-scripts')
    <script>
        $(document).ready(function(){
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('users.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'username', name: 'username'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'active', name: 'active'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            })
        })

    </script>
@endpush
