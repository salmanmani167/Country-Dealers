<?php

namespace App\Models;

use App\Models\Employee;
use Modules\Projects\Entities\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id','project_id','deadline','date_','hours','total_hours','remaining_hours','description'
    ];

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
