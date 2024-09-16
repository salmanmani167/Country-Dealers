@extends('layouts.master')


@section('content')
<div class="content container-fluid">

    <!-- Page Header -->
    <x-page-header title="{{$title}}"></x-page-header>
    <!-- /Page Header -->

    <!-- Search Filter -->
    <form action="" method="get">
        <div class="row filter-row">
            {{-- <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <input type="text" class="form-control floating">
                    <label class="focus-label">Employee Name</label>
                </div>
            </div> --}}
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select name="month" class="select floating months">
                        <option readonly value="">-</option>
                        <option value="01">Jan</option>
                        <option value="02">Feb</option>
                        <option value="03">Mar</option>
                        <option value="04">Apr</option>
                        <option value="05">May</option>
                        <option value="06">Jun</option>
                        <option value="07">Jul</option>
                        <option value="08">Aug</option>
                        <option value="09">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                    </select>
                    <label class="focus-label">Select Month</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select name="year" class="select floating years">
                        <option readonly value="">-</option>
                        @foreach ($years_range as $year)
                        <option>{{$year->year}}</option>
                        @endforeach
                    </select>
                    <label class="focus-label">Select Year</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-success btn-block">Search</button>
            </div>
        </div>
    </form>
    <!-- /Search Filter -->

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table table-nowrap mb-0">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            @for ($day = 1; $day <= $days_in_month; $day++)
                            <th>{{$day}}</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a class="avatar avatar-xs" href="{{route('employees.profile', $employee->user->id)}}"><img alt="avatar" src="{{!empty($employee->user->avatar) ? asset('storage/users/'.$employee->user->avatar): asset('assets/img/profiles/avatar.jpg')}}"></a>
                                        <a href="{{route('employees.profile', $employee->user->id)}}">{{$employee->user->firstname.' '.$employee->user->lastname}}</a>
                                    </h2>
                                </td>
                                @for ($day = 1; $day <= $days_in_month; $day++)
                                    @php
                                        $currentMonth = request()->month ?? \Carbon\Carbon::now()->month;
                                        $year = request()->year ?? \Carbon\Carbon::now()->year;
                                        $attendance = $employee->attendance()
                                                ->whereDay('created_at', $day)
                                                ->whereMonth('created_at', $currentMonth)
                                                ->whereYear('created_at', $year)
                                                ->first();
                                    @endphp
                                    @if (!empty($attendance->checkin) && !empty($attendance->checkout))
                                    <td class="" onclick="Livewire.emit('openModal',{{$attendance->id}})" data-toggle="tooltip" data-original-title="{{$attendance->status}}" data-attendance="{{$attendance}}"><a href="javascript:void(0);"><i class="fa fa-check text-success"></i></a></td>
                                    @else
                                    <td title="{{$attendance->status ?? ''}}"><a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info"><i class="fa fa-close text-danger"></i></a></td>
                                    @endif
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modals')
<livewire:employeeattendance::attendance-modal />
@endpush


@push('page-scripts')
<script>
    $(document).ready(function(){
        $('.table').DataTable();
        $('.months').val("{{request()->month}}").trigger('change')
        $('.years').val("{{request()->year}}").trigger('change')
    })

</script>
@endpush
