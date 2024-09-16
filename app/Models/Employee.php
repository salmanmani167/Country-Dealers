<?php

namespace App\Models;

use Modules\Projects\Entities\Project;
use Illuminate\Database\Eloquent\Model;
use Modules\Projects\Entities\ProjectTeam;
use Modules\EmployeeAttendance\Entities\Attendance;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'emp_id','ssn_id','marital_stat','religion','nationality',
        'passport_no','passport_expiry_date','phone','spouse_employement','no_of_children',
        'user_id','department_id','designation_id','agency_id','house_id','education','experience','emergency_contacts','work_availability',
        'work_days','work_transportation','have_driver_license','driver_license_no','work_restrictions','date_joined',
        'family_information','bank_information'
    ];

    protected $casts = [
        'education' => 'collection',
        'experience' => 'collection',
        'emergency_contacts' => 'collection',
        'work_restrictions' => 'array',
        'family_information' => 'collection',
        'bank_information' => 'collection',
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public function agency(){
        return $this->belongsTo(Agency::class);
    }

    public function house(){
        return $this->belongsTo(House::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function leadProjects(){
        return $this->hasMany(Project::class,'leader_id');
    }

    public function relatedProjects()
    {
        return Project::whereHas('projectTeam', function ($query) {
            return $query->where('employee_id', $this->id);
        })->get();
    }

    public function projects()
    {
        return $this->hasManyThrough(Project::class, ProjectTeam::class, 'employee_id', 'id', 'id', 'project_id');
    }

    public function projectTeam(){
        return $this->hasMany(ProjectTeam::class);
    }

    public function shiftSchedules(){
        return $this->hasMany(ShiftSchedule::class);
    }
}
