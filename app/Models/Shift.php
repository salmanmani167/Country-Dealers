<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','min_start_time','start_time','max_start_time','min_end_time','end_time',
        'max_end_time','break','recurring','repeat_weeks','days','ends_on','indefinite','tag',
        'note'
    ];

    protected $casts = [
        'days' => 'array'
    ];

}
