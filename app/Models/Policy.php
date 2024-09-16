<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','description','department_id','file'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }
}
