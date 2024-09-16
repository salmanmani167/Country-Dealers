<div>
    <div class="row">
        <div class="col-md-4">
            <div class="card punch-status">
                <div class="card-body">
                    <h5 class="card-title">Timesheet <small class="text-muted">{{date('d M Y')}}</small></h5>
                    @if (!empty($todayAttendance) && !empty($todayAttendance->checkin))
                    <div class="punch-det">
                        <h6>Punch In at</h6>
                        <p>{{format_date($todayAttendance->created_at,'d M Y')}} {{format_date($todayAttendance->checkin,'H:i a')}}</p>
                    </div>
                    @endif
                    <div class="punch-info">
                        <div class="punch-hours">
                            <span>{{ $hrs_count }} hrs </span>
                        </div>
                    </div>
                    <div class="punch-btn-section">
                        @if ($checkin === true)
                        <form wire:submit.prevent="punchin">
                            <button type="submit" class="btn btn-primary punch-btn">Punch In</button>
                        </form>
                        @elseif($checkin === false)
                        <form wire:submit.prevent="punchout">
                            <button type="submit" class="btn btn-primary punch-btn">Punch Out</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card att-statistics">
                <div class="card-body">
                    <h5 class="card-title">Statistics</h5>
                    <div class="stats-list">
                        @if (!empty($todayAttendance))
                        <div class="stats-info">
                            <p>Today <strong>{{$todayAttendance->hours_difference}} <small>{{\Str::plural('hr',$todayAttendance->hours_difference)}}</small></strong></p>
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        @endif
                        <div class="stats-info">
                            <p>This Week <strong>{{$this_week}} <small>{{\Str::plural('hr',$this_week)}}</small></strong></p>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" style="width: 31%" aria-valuenow="31" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="stats-info">
                            <p>This Month <strong>{{$this_month}} <small> {{\Str::plural('hr',$this_month)}}</small></strong></p>
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card recent-activity">
                <div class="card-body">
                    <h5 class="card-title">Today Activity</h5>
                    <ul class="res-activity-list">
                        @if (!empty($todayAttendance) && !empty($todayAttendance->checkin))
                        <li>
                            <p class="mb-0">Punch In at</p>
                            <p class="res-activity-time">
                                <i class="fa fa-clock-o"></i>
                                {{format_date($todayAttendance->checkin,'H:i a')}}
                            </p>
                        </li>
                        @endif
                        @if (!empty($todayAttendance) && !empty($todayAttendance->checkout))
                        <li>
                            <p class="mb-0">Punch Out at</p>
                            <p class="res-activity-time">
                                <i class="fa fa-clock-o"></i>
                                {{format_date($todayAttendance->checkout,'H:i a')}}
                            </p>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
