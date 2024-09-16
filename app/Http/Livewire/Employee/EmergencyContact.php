<?php

namespace App\Http\Livewire\Employee;

use App\Http\Livewire\Modal;
use App\Models\Employee;
use Livewire\Component;

class EmergencyContact extends Modal
{
    public $p_name, $p_relation, $p_phone, $p_phone2;
    public $s_name, $s_relation, $s_phone, $s_phone2;

    public $employeeId;

    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];
    protected $rules = [
       'p_name' => 'required',
       'p_relation' => 'required',
       'p_phone' => 'required',
    ];

    public function edit(){
        $employee = Employee::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
        $contacts = $employee->emergency_contacts;

        $this->employeeId = $employee->id;
        $primary = $contacts['primary'] ?? '';
        $secondary = $contacts['secondary'] ?? '';
        $this->p_name = $primary['name'] ?? '';
        $this->p_relation =  $primary['relationship'] ?? '';
        $this->p_phone = $primary['phone'] ?? '';
        $this->p_phone2 = $primary['phone2'] ?? '';

        $this->s_name = $secondary['name'] ?? '';
        $this->s_relation =  $secondary['relationship'] ?? '';
        $this->s_phone = $secondary['phone'] ?? '';
        $this->s_phone2 = $secondary['phone2'] ?? '';
    }

    public function store(){
        $this->validate();
        $employee = Employee::findOrFail($this->employeeId);
        $contacts = [
            'primary' => [
                'name' => $this->p_name,
                'relationship' => $this->p_relation,
                'phone' => $this->p_phone,
                'phone2' => $this->p_phone2,
            ],
            'secondary' => [
                'name' => $this->s_name,
                'relationship' => $this->s_relation,
                'phone' => $this->s_phone,
                'phone2' => $this->s_phone2,
            ],
        ];
        $employee->update([
            'emergency_contacts' => $contacts,
        ]);
        $this->emit('notify', ['message' => "Emergency contacts has been updated"]);
        $this->closeModal();
        $this->emit('reloadPage');
    }


    public function render()
    {
        return view('livewire.employee.emergency-contact');
    }
}
