<?php

namespace App\Models;

use App\Models\GoalType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory;

    protected $fillable = [
        'goal_type_id','subject','target',
        'start_date','end_date','description','status','progress'
    ];

    public function goalType(){
        return $this->belongsTo(GoalType::class);
    }
}
