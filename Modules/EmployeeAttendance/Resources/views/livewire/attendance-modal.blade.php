<div>
    <x-modals.modal type="modal-lg">
        <x-slot:title>
            Attendance Info
        </x-slot>
        @if (!empty($attendance))
        <div class="row">
            <div class="col-md-6">
                <div class="card punch-status">
                    <div class="card-body">
                        <h5 class="card-title">Timesheet <small class="text-muted">{{format_date($attendance->created_at,'d M Y')}}</small></h5>
                        <div class="punch-det">
                            <h6>Punch In at</h6>
                            <p>{{format_date($attendance->created_at,'d M Y')}} {{format_date($attendance->checkin,'H:i a')}}</p>
                        </div>
                        <div class="punch-info">
                            <div class="punch-hours">
                                <span>{{$attendance->hours_difference}} {{Str::plural('hr', $attendance->hours_difference)}}</span>
                            </div>
                        </div>
                        <div class="punch-det">
                            <h6>Punch Out at</h6>
                            <p>{{format_date($attendance->created_at,'d M Y')}} {{format_date($attendance->checkout,'H:i a')}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card recent-activity">
                    <div class="card-body">
                        <h5 class="card-title">Activity</h5>
                        <ul class="res-activity-list">
                            <li>
                                <p class="mb-0">Punch In at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    {{format_date($attendance->checkin,'H:i a')}}
                                </p>
                            </li>
                            <li>
                                <p class="mb-0">Punch Out at</p>
                                <p class="res-activity-time">
                                    <i class="fa fa-clock-o"></i>
                                    {{format_date($attendance->checkout,'H:i a')}}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </x-modals.modal>
</div>
