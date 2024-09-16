<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Modal;
use Livewire\WithFileUploads;
use App\Models\User as UserModel;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class User extends Modal
{
    use WithFileUploads;

    public $firstname, $lastname, $middlename, $username, $email, $phone, $active, $password, $password_confirmation, $avatar, $role, $userId;
    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];
    protected $rules = [
        'firstname' => 'required',
        'middlename' => 'required',
        'lastname' => 'required',
        'username' => 'required',
        'email' => 'required',
        'phone' => 'nullable',
        'password' => 'required|confirmed',
        'avatar' => 'nullable|image'
    ];
    public function store(){
        $this->validate();
        if(is_object($this->avatar)){
            $avatar = $this->avatar->getClientOriginalName();
            $this->avatar->storeAs('users',$avatar,'public');
        }
        $user = UserModel::create([
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'email' => $this->email,
            'phone' => $this->phone,
            'active' => $this->active,
            'password' => Hash::make($this->password),
            'avatar' => $avatar ?? null,
        ]);
        $user->assignRole($this->role);
        $this->emit('notify', ['message' => "User has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function edit(){
        if(!empty($this->data)){
            $user = UserModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->userId = $user->id;
            $this->firstname = $user->firstname;
            $this->middlename = $user->middlename;
            $this->lastname = $user->lastname;
            $this->username = $user->username;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->active = $user->active;
            $this->role = $user->roles->pluck('id')->toArray();
        }
    }

    public function update(){
        $this->rules['password'] = 'nullable';
        $this->validate();
        if(is_object($this->avatar)){
            $avatar = $this->avatar->getClientOriginalName();
            $this->avatar->storeAs('users',$avatar,'public');
        }
        $user = UserModel::findOrFail($this->userId);
        $user->update([
            'firstname' => $this->firstname ?? $user->firstname,
            'middlename' => $this->middlename ?? $user->middlename,
            'lastname' => $this->lastname ?? $user->lastname,
            'username' => $this->username ?? $user->username,
            'email' => $this->email ?? $user->email,
            'phone' => $this->phone ?? $user->phone,
            'active' => $this->active,
            'password' => (!empty($this->password) && !empty($this->password_confirmation)) ? Hash::make($this->password): $user->password,
            'avatar' => $avatar ?? $user->avatar,
        ]);
        $user->syncRoles([$this->role]);
        $this->emit('notify', ['message' => "User has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }
    public function delete(){
        $user = UserModel::findOrFail($this->userId);
        $user->delete();
        $this->emit('notify', ['message' => "User has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }
    public function render()
    {
        $roles = Role::get();
        return view('livewire.user',compact(
            'roles'
        ));
    }
}

