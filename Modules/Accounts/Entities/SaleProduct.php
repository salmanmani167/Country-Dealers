<?php

namespace Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleProduct extends Model
{
    use HasFactory;

    protected $table = "product_sale";

    protected $fillable = [
        'sale_id','product_id','price','quantity'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    protected static function newFactory()
    {
        return \Modules\Accounts\Database\factories\SaleProductFactory::new();
    }
}
