@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
        <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0)" onclick="Livewire.emit('openModal')" class="btn add-btn"><i class="fa fa-plus"></i> Add Goal Type</a>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 w-100 datatable">
                    <thead>
                        <tr>
                            <th>Goal Type</th>
                            <th>Subject</th>
                            <th>Target Achievement</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Description </th>
                            <th>Status </th>
                            <th>Progress </th>
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
@livewire('goal-component')
@endpush

@push('page-scripts')
    <script>
        $(document).ready(function(){
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('goals')}}",
                columns: [
                    {data: 'type', name: 'type'},
                    {data: 'subject', name: 'subject'},
                    {data: 'target', name: 'target'},
                    {data: 'starts', name: 'starts'},
                    {data: 'ends', name: 'ends'},
                    {data: 'description', name: 'description'},
                    {data: 'status', name: 'status'},
                    {data: 'progress', name: 'progress'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            })
        })

    </script>
@endpush
