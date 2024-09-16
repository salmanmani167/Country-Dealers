<?php

namespace Modules\Accounts\Http\Livewire;

use App\Http\Livewire\Modal;
use Livewire\Component;
use Modules\Accounts\Entities\Product;
use \Modules\Accounts\Entities\Sale as SaleModel;
use Modules\Accounts\Entities\SaleProduct;

class SaleComponent extends Modal
{
    public $saleId, $product, $quantity, $total;

    protected $listeners = [
        'openModal',
        'hasData' => 'getData',
    ];

    protected $rules = [
        'product' => 'required',
        'quantity' => 'required',
    ];

    public function getData(){
        if(!empty($this->data)){
            $sale = SaleModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->saleId = $sale->id;
            $this->total = $sale->total;
            $this->product = $sale->products->first()->id;
            $this->quantity = $sale->saleProduct->quantity;
        }
    }

    public function store(){
        $this->validate();
        $total = 0;
        $product = Product::findOrFail($this->product);
        $total = $product->retail_price * $this->quantity;
        $sale = SaleModel::create([
            'total' => $total
        ]);
        SaleProduct::create([
            'sale_id' => $sale->id,
            'product_id' => $product->id,
            'price' => $product->retail_price,
            'quantity' => $this->quantity,
        ]);
        $this->emit('notify', ['message' => "Sale has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function update(){
        $this->validate();
        $sale = SaleModel::findOrFail($this->saleId);

        $product = Product::findOrFail($this->product);
        $total = $product->retail_price * $this->quantity;
        $sale->update([
            'total' => $total
        ]);
        $sale_product = SaleProduct::where('sale_id',$sale->id)->where('product_id',$product->id)->first();
        $sale_product->update([
            'sale_id' => $sale->id,
            'product_id' => $product->id,
            'price' => $product->retail_price,
            'quantity' => $this->quantity,
        ]);
        $this->emit('notify', ['message' => "Sale has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $sale = SaleModel::findOrFail($this->saleId);
        $sale->delete();
        $this->emit('notify', ['message' => "Sale has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        $products = Product::get();
        return view('accounts::livewire.sale-component',compact(
            'products'
        ));
    }
}
