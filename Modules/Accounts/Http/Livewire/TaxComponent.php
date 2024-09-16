<?php

namespace Modules\Accounts\Http\Livewire;

use App\Http\Livewire\Modal;
use Livewire\Component;
use Modules\Accounts\Entities\Tax as TaxModel;

class TaxComponent extends Modal
{
    public $taxId, $name, $percentage, $status;

    protected $listeners = [
        'openModal',
        'hasData' => 'getData',
    ];

    protected $rules = [
        'name' => 'required',
        'percentage' => 'required',
        'status' => 'required'
    ];

    public function getData(){
        if(!empty($this->data)){
            $tax = TaxModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->taxId = $tax->id;
            $this->name = $tax->name;
            $this->percentage = $tax->percentage;
            $this->status = $tax->status;
        }
    }

    public function store(){
        $this->validate();
        TaxModel::create([
            'name' => $this->name,
            'percentage' => $this->percentage,
            'status' => $this->status
        ]);
        $this->emit('notify', ['message' => "Tax has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function update(){
        $this->validate();
        $tax = TaxModel::findOrFail($this->taxId);
        $tax->update([
            'name' => $this->name ?? $tax->name,
            'percentage' => $this->percentage ?? $tax->percentage,
            'status' => $this->status ?? $tax->status,
        ]);
        $this->emit('notify', ['message' => "Tax has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $tax = TaxModel::findOrFail($this->taxId);
        $tax->delete();
        $this->emit('notify', ['message' => "Tax has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        return view('accounts::livewire.tax-component');
    }
}
