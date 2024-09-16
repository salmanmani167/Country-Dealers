<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_type_id','employee_id','starts_on','ends_on','days','reason','status','remaning_leaves'
    ];

    public function leaveType(){
        return $this->belongsTo(LeaveType::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
