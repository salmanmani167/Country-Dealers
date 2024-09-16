<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'tk_id','subject','assigned_to','client_id','priority',
        'cc','followers','description','files','added_by','status'
    ];

    protected $casts = [
        'followers' => 'array',
        'files' => 'array',
    ];

    public function assignedTo(){
        return $this->belongsTo(Employee::class,'assigned_to');
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function addedBy(){
        return $this->belongsTo(User::class, 'added_by');
    }
}
