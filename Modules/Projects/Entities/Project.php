<?php

namespace Modules\Projects\Entities;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Modules\Projects\Entities\ProjectTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','client_id','starts_on','ends_on','rate','rate_type',
        'priority','leader_id','description','files','deadline','added_by','status','progress'
    ];

    protected $casts = [
        'files' => 'array'
    ];

    public function leader(){
        return $this->belongsTo(Employee::class,'leader_id');
    }

    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }

    public function team(){
        return $this->hasMany(ProjectTeam::class);
    }

    public function projectTeam(){
        return $this->hasMany(ProjectTeam::class);
    }

    protected static function newFactory()
    {
        return \Modules\Projects\Database\factories\ProjectFactory::new();
    }
}
