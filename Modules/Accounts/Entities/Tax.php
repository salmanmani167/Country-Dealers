<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','percentage','status'
    ];

    protected static function newFactory()
    {
        return \Modules\Accounts\Database\factories\TaxFactory::new();
    }
}
