@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
        <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0)" onclick="Livewire.emit('openModal')" class="btn add-btn"><i class="fa fa-plus"></i> Add Policy</a>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 datatable w-100">
                    <thead>
                        <tr>
                            <th style="width: 30px;">#</th>
                            <th>Policy Name </th>
                            <th>Department </th>
                            <th>Description </th>
                            <th>Created </th>
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
@livewire('policy')
@endpush

@push('page-scripts')
    <script>
        $(document).ready(function(){
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('policies.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'department', name: 'department'},
                    {data: 'description', name: 'description'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            });
        })

    </script>
@endpush
