<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','supplier','quantity','cost_price',
        'retail_price','description',
    ];

    public function sale(){
        return $this->belongsToMany(Sale::class);
    }

    protected static function newFactory()
    {
        return \Modules\Accounts\Database\factories\ProductFactory::new();
    }
}
