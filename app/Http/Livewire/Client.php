<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Http\Livewire\Modal;
use Illuminate\Support\Facades\Hash;
use App\Models\Client as ClientModel;
use App\Models\Employee;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Client extends Modal
{
    public $firstname, $employee, $lastname, $username, $email, $phone, $active, $avatar, $password, $password_confirmation, $clt_id, $userId, $company;
    public $refreshPage = false;
    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];

    protected $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'username' => 'required',
        'email' => 'required|unique:users,email',
        'phone' => 'nullable',
        'password' => 'required|confirmed',
        'avatar' => 'nullable|image',
        'company' => 'required',
        'employee' => 'required',
    ];

    public function store()
    {
        $this->validate();
        if (is_object($this->avatar)) {
            $avatar = $this->avatar->getClientOriginalName();
            $this->avatar->storeAs('users', $avatar, 'public');
        }
        $user = User::create([
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'active' => $this->active,
            'password' => Hash::make($this->password),
            'avatar' => $avatar ?? null,
            'is_employee' => false,
            'is_client' => true,
        ]);
        $client_id = IdGenerator::generate(['table' => 'clients', 'field' => 'clt_id', 'length' => 10, 'prefix' => 'CLT-']);
        ClientModel::create([
            'user_id' => $user->id,
            'clt_id' => $this->clt_id ?? $client_id,
            'company' => $this->company,
            'employee_id' => $this->employee,
        ]);
        $this->emit('notify', ['message' => 'Client has been added']);
        $this->closeModal();
        if($this->refreshPage != true){
            $this->emit('reloadTable');
        }else{
            $this->emit('reloadPage');
        }
    }

    public function edit()
    {
        if (!empty($this->data)) {
            $user = User::findOrFail(is_array($this->data) ? $this->data['model'] : $this->data);
            if(!empty($this->data['refresh'])){
                $this->refreshPage = true;
            }
            $this->userId = $user->id;
            $this->firstname = $user->firstname;
            $this->lastname = $user->lastname;
            $this->username = $user->username;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->active = $user->active;
            $this->password = '';
            $this->password_confirmation = '';
            $this->clt_id = $user->client->clt_id ?? '';
            $this->company = $user->client->company ?? '';
            $this->employee = $user->client->employee_id ?? '';
        }
    }

    public function update()
    {
        $this->rules['password'] = 'nullable';
        $this->rules['email'] = 'required';
        $this->validate();
        if (is_object($this->avatar)) {
            $avatar = $this->avatar->getClientOriginalName();
            $this->avatar->storeAs('users', $avatar, 'public');
        }
        $user = User::findOrFail($this->userId);
        $user->update([
            'firstname' => $this->firstname ?? $user->firstname,
            'lastname' => $this->lastname ?? $user->lastname,
            'username' => $this->username ?? $user->username,
            'email' => $this->email ?? $user->email,
            'phone' => $this->phone ?? $user->phone,
            'active' => $this->active,
            'password' => (! empty($this->password) && ! empty($this->password_confirmation)) ? Hash::make($this->password) : $user->password,
            'avatar' => $avatar ?? $user->avatar,
        ]);
        $user->client->update([
            'user_id' => $user->id,
            'clt_id' => $this->clt_id,
            'company' => $this->company,
            'employee_id' => $this->employee,
        ]);
        $this->emit('notify', ['message' => 'Client has been updated']);
        $this->closeModal();
        if($this->refreshPage != true){
            $this->emit('reloadTable');
        }else{
            $this->emit('reloadPage');
        }
    }

    public function delete()
    {
        $user = User::findOrFail($this->userId);
        if(!empty($user->client)){
            $user->client->delete();
        }
        $user->delete();
        $this->emit('notify', ['message' => 'Client has been deleted']);
        $this->closeModal();
        if($this->refreshPage != true){
            $this->emit('reloadTable');
        }else{
            $this->emit('reloadPage');
        }
    }

    public function render()
    {
        $employees = Employee::get();
        return view('livewire.client',compact(
            'employees'
        ));
    }
}
