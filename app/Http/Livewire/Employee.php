<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\House;
use App\Models\Agency;
use Livewire\Component;
use App\Models\Department;
use App\Models\Designation;
use App\Http\Livewire\Modal;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee as EmployeeModel;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Employee extends Modal
{

    public $firstname, $lastname, $username, $email, $phone, $is_employee, $active, $avatar, $password, $password_confirmation, $emp_id, $userId, $date_joined, $department, $designation, $agency, $house;
    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];

    protected $rules = [
        'firstname' => 'required',
        'lastname' => 'required',
        'username' => 'required',
        'email' => 'required',
        'phone' => 'nullable',
        'password' => 'required|confirmed',
        'avatar' => 'nullable|image',
        'date_joined' => 'required|string',
        'designation' => 'required',
        'department' => 'required',
        'house' => 'required',
        'agency' => 'required'
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
            'is_employee' => true,
        ]);
        $employee_id = IdGenerator::generate(['table' => 'employees', 'field' => 'emp_id', 'length' => 10, 'prefix' => 'EMP-']);
        EmployeeModel::create([
            'user_id' => $user->id,
            'emp_id' => $this->emp_id ?? $employee_id,
            'house_id' => $this->house,
            'agency_id' => $this->agency,
            'department_id' => $this->department,
            'designation_id' => $this->designation,
            'date_joined' => $this->date_joined,
        ]);
        $this->emit('notify', ['message' => 'Employee has been added']);
        $this->closeModal();
        $this->emit('reloadPage');
    }

    public function edit()
    {
        if (! empty($this->data)) {
            $user = User::findOrFail(is_array($this->data) ? $this->data['model'] : $this->data);
            $this->userId = $user->id;
            $this->firstname = $user->firstname;
            $this->lastname = $user->lastname;
            $this->username = $user->username;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->active = $user->active;
            $this->password = '';
            $this->password_confirmation = '';
            $this->emp_id = $user->employee->emp_id ?? '';
            $this->designation = $user->employee->designation_id ?? '';
            $this->department = $user->employee->department_id;
            $this->house = $user->employee->house_id;
            $this->agency = $user->employee->agency_id;
            $this->date_joined = $user->employee->date_joined;
        }
    }

    public function update()
    {
        $this->rules['password'] = 'nullable';
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
        $user->employee->update([
            'user_id' => $user->id,
            'emp_id' => $this->emp_id,
            'house_id' => $this->house,
            'agency_id' => $this->agency,
            'department_id' => $this->department,
            'designation_id' => $this->designation,
            'date_joined' => $this->date_joined,
        ]);
        $this->emit('notify', ['message' => 'Employee has been updated']);
        $this->closeModal();
        $this->emit('reloadPage');
    }

    public function delete()
    {
        $user = User::findOrFail($this->userId);
        if(!empty($user->employee)){
            $user->employee->delete();
        }
        $user->delete();
        $this->emit('notify', ['message' => 'Employee has been deleted']);
        $this->closeModal();
        $this->emit('reloadPage');
    }

    public function render()
    {
        $houses = House::get();
        $agencies = Agency::get();
        $departments = Department::get();
        $designations = Designation::get();
        return view('livewire.employee',compact(
            'houses','agencies','departments','designations'
        ));
    }
}
