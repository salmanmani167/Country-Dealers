<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\Agency as AgencyModel;

class Agency extends Modal
{
    public $name, $contact, $phone, $address, $agencyId;

    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];
    protected $rules = [
        'name' => 'required|string',
        'contact' => 'required|string',
        'phone' => 'required|string',
        'address' => 'required|string',
    ];

    public function store(){
        $this->validate();
        AgencyModel::create([
            'name' => $this->name,
            'contact' => $this->contact,
            'phone' => $this->phone,
            'address' => $this->address
        ]);
        $this->emit('notify', ['message' => "Agency has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }


    public function edit(){
        if(!empty($this->data)){
            $agency = AgencyModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->agencyId = $agency->id;
            $this->name = $agency->name;
            $this->contact = $agency->contact;
            $this->phone = $agency->phone;
            $this->address = $agency->address;
        }
    }

    public function update(){
        $this->validate();
        $agency = AgencyModel::findOrFail($this->agencyId);
        $agency->update([
            'name' => $this->name,
            'contact' => $this->contact,
            'phone' => $this->phone,
            'address' => $this->address
        ]);
        $this->emit('notify', ['message' => "Agency has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $agency = AgencyModel::findOrFail($this->agencyId);
        $agency->delete();
        $this->emit('notify', ['message' => "Agency has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }


    public function render()
    {
        return view('livewire.agency');
    }
}
