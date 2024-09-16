<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Client;
use Livewire\Component;
use App\Models\House as HouseModel;

class House extends Modal
{

    public $name, $address, $zip_code, $cordinator, $manager, $client, $houseId;

    protected $rules = [
        'name' => 'required|string|unique:houses',
        'cordinator' => 'required',
        'manager' => 'required',
    ];

    protected $listeners = [
        'openModal',
        'hasData' => 'editHouse',
    ];


    public function delete(){
        $house = HouseModel::findOrFail($this->houseId);
        $house->delete();
        $this->emit('notify', ['message' => "House has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function editHouse(){
        if(!empty($this->data)){
            $house = HouseModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->houseId = $house->id;
            $this->name = $house->name;
            $this->address = $house->address;
            $this->zip_code = $house->zip_code;
            $this->manager = $house->manager_id;
            $this->cordinator = $house->cordinator_id;
            $this->client = $house->client_id;
        }
    }

    public function update(){
        $this->rules['name'] = 'required|string';
        $this->validate();
        HouseModel::findOrFail($this->houseId)->update([
            'name' => $this->name,
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'cordinator_id' => $this->cordinator,
            'manager_id' => $this->manager,
            'client_id' => $this->client,
        ]);
        $this->emit('notify', ['message' => "House has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function store(){
        $this->validate();
        HouseModel::create([
            'name' => $this->name,
            'address' => $this->address,
            'zip_code' => $this->zip_code,
            'cordinator_id' => $this->cordinator,
            'manager_id' => $this->manager,
            'client_id' => $this->client,
        ]);
        $this->emit('notify', ['message' => "House has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }


    public function render()
    {
        $users = User::where('is_client',0)->get();
        $clients = Client::get();
        return view('livewire.house',compact(
            'users','clients'
        ));
    }
}
