@extends('layouts.master')

@push('page-styles')
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <style>
        a.green-border {
            border: 2px dashed #1eb53a;
        }
        .user-add-shedule-list h2 a {
            padding: 10px;
            display: inline-block;
        }
    </style>
@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}">
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
                <button type="submit" class="btn btn-success btn-block"> Search </a>
            </div>
        </div>
    </form>
    <!-- /Search Filter -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            @foreach ($dates as $date)
                            <th class="px-1">{{ $date->format('d') }} <span class="text-uppercase">{{$date->formatLocalized('%A')}}</span> <br> <span class="text-uppercase">{{ $date->format('M') }}</span></th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($singleEmp))
                            @php
                                $employee = $singleEmp;
                            @endphp
                            <tr>
                                <td>{{$employee->emp_id}}</td>
                                <td>
                                    @if(!empty($employee))
                                        @php
                                            $image = !empty($employee->user->avatar) ? asset('storage/users/'.$employee->user->avatar): asset('assets/img/profiles/avatar.jpg');
                                        @endphp
                                        <h2 class="table-avatar blue-link">
                                            <a target="_blank" href="{{route('employees.profile',$employee->user->id)}}" class="avatar"><img alt="avatar" src="{{$image}}"></a>
                                            <a target="_blank" href="{{route('employees.profile',$employee->user->id)}}">{{$employee->user->firstname." ".$employee->user->lastname}}</a>
                                        </h2>
                                    @endif
                                </td>
                                @foreach ($dates as $date)
                                @php
                                    $employee_schedule = $employee->shiftSchedules()->whereDate('date_',$date)->first();
                                @endphp
                                @if (!empty($employee_schedule))
                                @php
                                    $start_time = \Carbon\Carbon::parse($employee_schedule->shift_start_time)->format('H:i a');
                                    $end_time = \Carbon\Carbon::parse($employee_schedule->shift_end_time)->format('H:i a');
                                @endphp
                                <td>
                                    <div class="user-add-shedule-list">
                                        <h2>
                                            <a data-schedule="{{$employee_schedule->id}}" data-shift="{{$employee_schedule->shift_id}}" data-emp="{{$employee_schedule->employee_id}}" data-note="{{$employee_schedule->note}}" data-date="{{$date->format('Y-m-d')}}" href="javascript:void(0)" class="green-border update_emp_schedule">
                                                <span class="username-info m-b-10"> {{$start_time. ' - '.$end_time}}</span>
                                                <span class="userrole-info">{{$employee->designation->name ?? ''}} </span>
                                            </a>
                                        </h2>
                                    </div>
                                </td>
                                @else
                                <td>
                                    <div class="user-add-shedule-list">
                                        <a data-emp="{{$employee->id}}" data-date="{{$date->format('Y-m-d')}}" href="javascript:void(0)" class="add_emp_schedule">
                                            <span><i class="fa fa-plus"></i></span>
                                        </a>
                                    </div>
                                </td>
                                @endif

                                @endforeach
                            </tr>
                        @else
                            @foreach ($employees as $employee)
                            <tr>
                                <td>{{$employee->emp_id}}</td>
                                <td>
                                    @if(!empty($employee))
                                        @php
                                            $image = !empty($employee->user->avatar) ? asset('storage/users/'.$employee->user->avatar): asset('assets/img/profiles/avatar.jpg');
                                        @endphp
                                        <h2 class="table-avatar blue-link">
                                            <a target="_blank" href="{{route('employees.profile',$employee->user->id)}}" class="avatar"><img alt="avatar" src="{{$image}}"></a>
                                            <a target="_blank" href="{{route('employees.profile',$employee->user->id)}}">{{$employee->user->firstname." ".$employee->user->lastname}}</a>
                                        </h2>
                                    @endif
                                </td>
                                @foreach ($dates as $date)
                                @php
                                    $employee_schedule = $employee->shiftSchedules()->whereDate('date_',$date)->first();
                                @endphp
                                @if (!empty($employee_schedule))
                                @php
                                    $start_time = \Carbon\Carbon::parse($employee_schedule->shift_start_time)->format('H:i a');
                                    $end_time = \Carbon\Carbon::parse($employee_schedule->shift_end_time)->format('H:i a');
                                @endphp
                                <td>
                                    <div class="user-add-shedule-list">
                                        <h2>
                                            <a data-schedule="{{$employee_schedule->id}}" data-shift="{{$employee_schedule->shift_id}}" data-emp="{{$employee_schedule->employee_id}}" data-note="{{$employee_schedule->note}}" data-date="{{$date->format('Y-m-d')}}" href="javascript:void(0)" class="green-border update_emp_schedule">
                                                <span class="username-info m-b-10"> {{$start_time. ' - '.$end_time}}</span>
                                                <span class="userrole-info">{{$employee->designation->name ?? ''}} </span>
                                            </a>
                                        </h2>
                                    </div>
                                </td>
                                @else
                                <td>
                                    <div class="user-add-shedule-list">
                                        <a data-emp="{{$employee->id}}" data-date="{{$date->format('Y-m-d')}}" href="javascript:void(0)" class="add_emp_schedule">
                                            <span><i class="fa fa-plus"></i></span>
                                        </a>
                                    </div>
                                </td>
                                @endif

                                @endforeach
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@push('modals')
<x-modals.modal id="employee_shift_schedule" type="modal-md">
    <x-slot:title>
        Update Shift
    </x-slot>
    <form id="update_emp_schedule_form" action="{{route('schedules.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <input type="hidden" name="id" id="edit_id">
        <div class="row">
            <div class="col-sm-12">
                <div class="input-block mb-3">
                    <x-form.select id="edit_employee" name="employee" label="Employee">
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="input-block mb-3">
                    <x-form.select id="edit_shift" name="shift" label="Shift">
                        @foreach ($shifts as $shift)
                            <option value="{{$shift->id}}">{{$shift->name}}</option>
                        @endforeach
                    </x-form.select>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="input-block mb-3">
                    <x-form.datepicker name="date" label="Date"></x-form.datepicker>
                </div>
            </div>
            <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.textarea name="note" id="update_note" label="Add Note"></x-form.textarea>
                </div>
            </div>
            {{-- <div class="col-md-12">
                <div class="input-block mb-3">
                    <x-form.input type="file" name="file" label="Add File"></x-form.input>
                </div>
            </div> --}}
        </div>
        <div class="submit-section">
            <button class="btn btn-primary submit-btn">Submit</button>
        </div>
    </form>
</x-modals.modal>
<x-modals.modal id="delete_shift_schedule">
    <div class="form-header">
        <h3>Delete Schedule</h3>
        <p>Are you sure want to delete?</p>
    </div>
    <form method="post" action="{{route('schedules.destroy')}}">
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
<script src="{{asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('.datatable').DataTable({
                destroy: true,
                dom: 'Bfrtip',
                buttons: [
                    'excelHtml5',
                    'pdfHtml5'
                ]
            })

            $('table').on('click','.add_emp_schedule', function(){
                var emp = $(this).data('emp');
                var date = $(this).data('date');
                $('#employee_shift_schedule').modal('show');
                $('#employee_shift_schedule #id_date').val(date);
                $('#employee_shift_schedule #edit_employee').val(emp).trigger('change');
            })
            $('table').on('click','.update_emp_schedule', function(){
                var id = $(this).data('schedule');
                var emp = $(this).data('emp');
                var date = $(this).data('date');
                var note = $(this).data('note');
                var shift = $(this).data('shift');
                $('#employee_shift_schedule').modal('show');
                $('#employee_shift_schedule #edit_id').val(id);
                $('#employee_shift_schedule #id_date').val(date);
                $('#employee_shift_schedule #id_note').val(note);
                $('#employee_shift_schedule #edit_shift').val(shift).trigger('change');
                $('#employee_shift_schedule #edit_employee').val(emp).trigger('change');
            })

            $('#employee_shift_schedule').on('hidden.bs.modal', function (e) {
                $(this).find('#update_emp_schedule_form')[0].reset();
            });
            $('table').on('click', '.trash_', function(){
                $('#delete_shift_schedule').modal('show');
                var id = $(this).data('id');
                $('#delete_id').val(id);
            });
            if($('.timepicker').length > 0) {
                $('.timepicker').datetimepicker({
                    format: "hh:mm:ss",
                    icons: {
                        up: "fa fa-angle-up",
                        down: "fa fa-angle-down",
                        next: 'fa fa-angle-right',
                        previous: 'fa fa-angle-left'
                    }
                });
            }
            $('.multiple').select2({
                width: "100%"
            });
        })

    </script>
@endpush
