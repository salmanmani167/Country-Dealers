<?php

namespace Modules\Accounts\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','user_id','purchased_from','purchased_date',
        'payment_method','amount','file','status',
    ];

    protected function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    protected static function newFactory()
    {
        return \Modules\Accounts\Database\factories\ExpenseFactory::new();
    }
}
