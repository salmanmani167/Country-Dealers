<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
    ];

    public function saleProduct(){
        return $this->hasOne(SaleProduct::class);
    }

    public function saleProducts(){
        return $this->hasMany(SaleProduct::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    protected static function newFactory()
    {
        return \Modules\Accounts\Database\factories\SaleFactory::new();
    }
}
