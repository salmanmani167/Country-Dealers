<?php

namespace App\Http\Livewire;

use App\Models\Asset;
use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AssetComponent extends Modal
{

    public $assetId, $ast_id, $name, $purchase_date, $purchase_from, $manufacturer, $model, $serial_no, $supplier, $condition, $warranty,
     $value, $user, $description, $status;

    protected $rules = [
        'name' => 'required|max:200',
        'purchase_date' => 'required|date',
        'purchase_from' => 'required',
        'manufacturer' => 'required',
        'model' => 'nullable|max:100',
        'serial_no' => 'nullable|max:50',
        'supplier' => 'required|max:200',
        'condition' => 'nullable|max:200',
        'warranty' => 'required',
        'value' => 'required',
        'status' => 'required',
        'user' => 'required',
        'description' => 'nullable|max:255'
    ];

    protected $listeners = [
        'openModal',
        'hasData' => 'getData',
    ];

    public function store(){
        $this->validate();
        $gen_asset_id = IdGenerator::generate(['table' => 'assets','field' => 'ast_id', 'length' => 10, 'prefix' =>'#AST-']);
        Asset::create([
            'ast_id' => $this->ast_id ?? $gen_asset_id,
            'name' => $this->name,
            'purchase_date' => $this->purchase_date,
            'purchase_from' => $this->purchase_from,
            'manufacturer' => $this->manufacturer,
            'model' => $this->model,
            'serial_no' => $this->serial_no,
            'supplier' => $this->supplier,
            'ast_condition' => $this->condition,
            'warranty' => $this->warranty,
            'cost' => $this->value,
            'description' => $this->description,
            'status' => $this->status,
            'user_id' => $this->user,
        ]);
        $this->emit('notify', ['message' => "Asset has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');

    }

    public function getData(){
        if(!empty($this->data)){
            $asset = Asset::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->assetId = $asset->id;
            $this->name = $asset->name;
            $this->ast_id = $asset->ast_id;
            $this->purchase_date = $asset->purchase_date;
            $this->purchase_from = $asset->purchase_from;
            $this->manufacturer = $asset->manufacturer;
            $this->model = $asset->model;
            $this->serial_no = $asset->serial_no;
            $this->supplier = $asset->supplier;
            $this->condition = $asset->ast_condition;
            $this->warranty = $asset->warranty;
            $this->value = $asset->cost;
            $this->description = $asset->description;
            $this->status = $asset->status;
            $this->user = $asset->user_id;
        }
    }

    public function update(){
        $this->validate();
        $asset = Asset::findOrFail($this->assetId);
        $asset->update([
            'ast_id' => $this->ast_id,
            'name' => $this->name,
            'purchase_date' => $this->purchase_date,
            'purchase_from' => $this->purchase_from,
            'manufacturer' => $this->manufacturer,
            'model' => $this->model,
            'serial_no' => $this->serial_no,
            'supplier' => $this->supplier,
            'ast_condition' => $this->condition,
            'warranty' => $this->warranty,
            'cost' => $this->value,
            'description' => $this->description,
            'status' => $this->status,
            'user_id' => $this->user,
        ]);
        $this->emit('notify', ['message' => "Asset has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $asset = Asset::findOrFail($this->assetId);
        $asset->delete();
        $this->emit('notify', ['message' => "Asset has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        $users = User::get();
        return view('livewire.asset-component',compact(
            'users'
        ));
    }
}
