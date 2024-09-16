<?php

namespace Modules\Projects\Entities;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectTeam extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id','employee_id'
    ];


    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    protected static function newFactory()
    {
        return \Modules\Projects\Database\factories\ProjectTeamFactory::new();
    }
}
