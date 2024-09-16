<?php

namespace Modules\Accounts\Http\Livewire;

use App\Http\Livewire\Modal;
use Livewire\Component;
use \Modules\Accounts\Entities\Product as ProductModel;

class ProductComponent extends Modal
{
    public $productId, $name, $supplier, $quantity, $cost, $retail, $desc;

    protected $listeners = [
        'openModal',
        'hasData' => 'getData',
    ];

    protected $rules = [
        'name' => 'required',
        'quantity' => 'required',
        'retail' => 'required'
    ];

    public function getData(){
        if(!empty($this->data)){
            $product = ProductModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->productId = $product->id;
            $this->name = $product->name;
            $this->supplier = $product->supplier;
            $this->quantity = $product->quantity;
            $this->cost = $product->cost_price;
            $this->retail = $product->retail_price;
            $this->desc = $product->description;
        }
    }

    public function store(){
        $this->validate();
        ProductModel::create([
            'name' => $this->name,
            'supplier' => $this->supplier,
            'quantity' => $this->quantity,
            'cost_price' => $this->cost,
            'retail_price' => $this->retail,
            'description' => $this->desc,
        ]);
        $this->emit('notify', ['message' => "Product has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function update(){
        $this->validate();
        $product = ProductModel::findOrFail($this->productId);
        $product->update([
            'name' => $this->name,
            'supplier' => $this->supplier,
            'quantity' => $this->quantity,
            'cost_price' => $this->cost,
            'retail_price' => $this->retail,
            'description' => $this->desc,
        ]);
        $this->emit('notify', ['message' => "Product has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $product = ProductModel::findOrFail($this->productId);
        $product->delete();
        $this->emit('notify', ['message' => "Product has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        return view('accounts::livewire.product-component');
    }
}
