<?php

namespace Modules\Apps\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','date_','category'
    ];

    protected static function newFactory()
    {
        return \Modules\Apps\Database\factories\EventFactory::new();
    }
}
