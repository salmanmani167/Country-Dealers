<?php

namespace Modules\EmployeeAttendance\Entities;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','checkin','checkout','status'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function getHoursDifferenceAttribute()
    {
        return Carbon::parse($this->attributes['checkout'])->diffInHours(Carbon::parse($this->attributes['checkin']));
    }

    protected static function newFactory()
    {
        return \Modules\EmployeeAttendance\Database\factories\AttendanceFactory::new();
    }
}
