<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','purchase_date','purchase_from',
        'manufacturer','model','serial_no',
        'supplier','ast_condition','warranty','cost',
        'description','status','ast_id','user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
