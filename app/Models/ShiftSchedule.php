<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'accept_extra_hrs','date_','shift_id','employee_id','is_published','note',
        'shift_start_time','shift_end_time','file'
    ];

    public function shift(){
        return $this->belongsTo(Shift::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
