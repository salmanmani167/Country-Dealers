@extends('layouts.master')

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
        <div class="col-auto float-right ml-auto">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#add_timesheet"  class="btn add-btn"><i class="fa fa-plus"></i> Add Today Work</a>
        </div>
    </x-page-header>
    <!-- /Page Header -->

    <!-- Search Filter -->
    <form action="" method="get">
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" id="employee" name="employee">
                        <option value="">Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</option>
                        @endforeach
                    </select>
                    <label class="focus-label">Purchased By</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text" id="from_date" name="from" value="{{request()->from}}">
                    </div>
                    <label class="focus-label">From</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text" id="to_date" name="to" value="{{request()->to}}">
                    </div>
                    <label class="focus-label">To</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <button id="search_" type="button" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
    </form>
    <!-- /Search Filter -->

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped custom-table mb-0 datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Date</th>
                        <th>Projects</th>
                        <th class="text-center">Assigned Hours</th>
                        <th class="text-center">Hours</th>
                        <th class="d-none d-sm-table-cell">Description</th>
                        <th>Created At</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection

@push('modals')
<x-modals.modal id="add_timesheet" type="modal-lg">
    <x-slot:title>
        Add Timesheet
    </x-slot>
    <form action="{{route('timesheet')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <x-form.select name="employee" label="Employee">
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <x-form.select name="project" label="Project">
                        @foreach ($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.datepicker name="deadline" label="Deadline"></x-form.datepicker>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.input name="total_hours" label="Total Hours"></x-form.input>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.input name="remaining_hours" label="Remaining Hours"></x-form.input>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <x-form.datepicker name="date" label="Date"></x-form.datepicker>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <x-form.input name="emp_hours" label="Hours"></x-form.input>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <x-form.textarea name="description" label="Description"></x-form.textarea>
                </div>
            </div>
        </div>
        <div class="submit-section">
            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
        </div>
    </form>
</x-modals.modal>
<x-modals.modal id="edit_timesheet" type="modal-lg">
    <x-slot:title>
        Edit Timesheet
    </x-slot>
    <form action="{{route('timesheet')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <input type="hidden" name="id" id="edit_id">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <x-form.select id="edit_employee" name="employee" label="Employee">
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <x-form.select id="edit_project" name="project" label="Project">
                        @foreach ($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-12">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.datepicker name="deadline" label="Deadline"></x-form.datepicker>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.input name="total_hours" label="Total Hours"></x-form.input>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <x-form.input name="remaining_hours" label="Remaining Hours"></x-form.input>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <x-form.datepicker name="date" label="Date"></x-form.datepicker>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <x-form.input name="emp_hours" label="Hours"></x-form.input>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <x-form.textarea name="description" label="Description"></x-form.textarea>
                </div>
            </div>
        </div>
        <div class="submit-section">
            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
        </div>
    </form>
</x-modals.modal>
<x-modals.modal id="delete_timesheet">
    <div class="form-header">
        <h3>Delete Timesheet</h3>
        <p>Are you sure want to delete?</p>
    </div>
    <form method="post" action="{{route('timesheet')}}">
        @csrf
        @method("DELETE")
        <input type="hidden" name="id" id="delete_id">
        <div class="modal-btn delete-action">
            <div class="row">
                <div class="col-6">
                    <button type="submit"  class="btn btn-primary w-100 continue-btn">Delete</button>
                </div>
                <div class="col-6">
                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                </div>
            </div>
        </div>
    </form>
</x-modals.modal>
@endpush

@push('page-scripts')
    <script>
        $(document).ready(function(){
            var $columns = [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'employee', name: 'employee'},
                {data: 'date', name: 'date'},
                {data: 'project', name: 'project'},
                {data: 'hours', name: 'hours'},
                {data: 'remaining_hours', name: 'remaining_hours'},
                {data: 'description', name: 'description'},
                {data: 'created_at', name: 'created_at'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ];
            $('.datatable').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: "{{route('timesheet')}}",
                columns: $columns,
                initComplete: function(){
                    $('tr>td:last-child').addClass('text-right')
                }
            });
            $('form').on('click','#search_', function(e){
                e.preventDefault();
                var employee = $('#employee').val();
                var from = $('#from_date').val();
                var to = $('#to_date').val();
                $.get("{{route('timesheet')}}",{
                    employee: employee,
                    from: from,
                    to: to,
                }, function(e){
                    var timesheets = e.data;
                    $('.datatable').DataTable({
                        data: timesheets,
                        destroy: true,
                        columns: $columns,
                        initComplete: function(){
                            $('tr>td:last-child').addClass('text-right')
                        }
                    });
                });
            });
            $('table').on('click', '.edit', function(){
                var timesheet = $(this).data('timesheet').model;
                $('#edit_timesheet').modal('show');
                var id  = timesheet.id;
                var employee = timesheet.employee_id;
                var project = timesheet.project_id;
                var deadline = timesheet.deadline;
                var total_hrs = timesheet.total_hours;
                var remaining_hrs = timesheet.remaining_hours;
                var date = timesheet.date_;
                var emp_hrs = timesheet.hours;
                var description = timesheet.description;
                $('#edit_timesheet #edit_id').val(id);
                $('#edit_timesheet #id_deadline').val(deadline);
                $('#edit_timesheet #id_total_hours').val(total_hrs);
                $('#edit_timesheet #id_remaining_hours').val(remaining_hrs);
                $('#edit_timesheet #id_emp_hours').val(emp_hrs);
                $('#edit_timesheet #id_description').val(description);
                $('#edit_timesheet #id_date').val(date);
                $('#edit_timesheet #edit_employee').val(employee).trigger('change');
                $('#edit_timesheet #edit_project').val(project).trigger('change');
            });
            $('table').on('click', '.trash_', function(){
                $('#delete_timesheet').modal('show');
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
        })

    </script>
@endpush
