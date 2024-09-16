@extends('layouts.master')

@push('page-styles')

@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">

    </x-page-header>
    <!-- /Page Header -->

    <livewire:employeeattendance::attendance />



    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date </th>
                            <th>Punch In</th>
                            <th>Punch Out</th>
                            <th class="text-center">Production</th>
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
        $('.datatable').DataTable({
            processing: true,
            serverSide: true,
            destroy: true,
            ajax: "{{route('attendance')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'created_at', name: 'created_at'},
                {data: 'punchin', name: 'punchin'},
                {data: 'punchout', name: 'punchout'},
                {data: 'hours', name: 'hours'},
            ],
            initComplete: function(){
                $('tr>td:last-child').addClass('text-center')
            }
        });
    })

</script>
@endpush
