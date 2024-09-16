<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class House extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','address','zip_code','cordinator_id','manager_id','client_id'
    ];


    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function manager(){
        return $this->belongsTo(User::class,'manager_id');
    }

    public function cordinator(){
        return $this->belongsTo(User::class, 'cordinator_id');
    }
}
