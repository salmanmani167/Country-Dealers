<?php

namespace App\Http\Livewire\Employee;

use App\Http\Livewire\Modal;
use App\Models\Employee;
use Livewire\Component;

class PersonalInfo extends Modal
{
    public $passport, $ssn, $expiry_date, $nationality, $tel, $religion, $marital_stat, $spouse_job, $children;
    public $employeeId;

    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];

    protected $rules = [
        'ssn' => 'required',
       'passport' => 'required',
       'expiry_date' => 'required',
       'nationality' => 'required',
       'tel' => 'required',
       'religion' => 'nullable',
       'marital_stat' => 'required',
    ];

    public function edit(){
        $employee = Employee::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
        $this->employeeId = $employee->id;
        $this->passport = $employee->passport_no ?? '';
        $this->expiry_date = $employee->passport_expiry_date ?? '';
        $this->nationality = $employee->nationality ?? '';
        $this->tel = $employee->phone?? '';
        $this->religion = $employee->religion ?? '';
        $this->marital_stat = $employee->marital_stat ?? '';
        $this->spouse_job = $employee->spouse_employement?? '';
        $this->children = $employee->no_of_children ?? '';
        $this->ssn = $employee->ssn_id?? '';
    }

    public function store(){
        $this->validate();
        $employee = Employee::findOrFail($this->employeeId);

        $employee->update([
            'ssn_id' => $this->ssn,
            'marital_stat' => $this->marital_stat,
            'religion' => $this->religion,
            'nationality' => $this->nationality,
            'passport_no' => $this->passport,
            'passport_expiry_date' => $this->expiry_date,
            'phone' => $this->tel,
            'spouse_employement' => $this->spouse_job,
            'no_of_children' => $this->children,
        ]);
        $this->emit('notify', ['message' => "Personal Information has been updated"]);
        $this->closeModal();
        $this->emit('reloadPage');
    }

    public function render()
    {
        return view('livewire.employee.personal-info');
    }
}
