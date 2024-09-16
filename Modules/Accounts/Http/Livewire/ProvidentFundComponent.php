<?php

namespace Modules\Accounts\Http\Livewire;

use App\Http\Livewire\Modal;
use App\Models\Employee;
use Livewire\Component;
use \Modules\Accounts\Entities\ProvidentFund as ProvidentFundModel;

class ProvidentFundComponent extends Modal
{
    public $employee, $type, $emp_amount, $org_amount, $emp_percent, $org_percent, $description, $providentFundId;

    protected $listeners = [
        'openModal',
        'hasData' => 'getData',
    ];

    protected $rules = [
        'employee' => 'required',
        'type' => 'required',
        'emp_amount' => 'required',
        'org_amount' => 'required',
        'emp_percent' => 'required',
        'org_percent' => 'required',
        'description' => 'required',
    ];

    public function getData(){
        if(!empty($this->data)){
            $fund = ProvidentFundModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->providentFundId = $fund->id;
            $this->employee = $fund->employee_id;
            $this->type = $fund->type;
            $this->emp_amount = $fund->employee_share_amount;
            $this->org_amount = $fund->org_share_amount;
            $this->emp_percent = $fund->employee_share_percent;
            $this->org_percent = $fund->org_share_percent;
            $this->description = $fund->description;
        }
    }

    public function store(){
        $this->validate();
        ProvidentFundModel::create([
            'employee_id' => $this->employee,
            'type' => $this->type,
            'employee_share_amount' => $this->emp_amount,
            'org_share_amount' => $this->org_amount,
            'employee_share_percent' => $this->emp_percent,
            'org_share_percent' => $this->org_percent,
            'description' => $this->description,
        ]);
        $this->emit('notify', ['message' => "Provident Fund has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function update(){
        $this->validate();
        $fund = ProvidentFundModel::findOrFail($this->providentFundId);
        $fund->update([
            'employee_id' => $this->employee ?? $fund->employee_id,
            'type' => $this->type ?? $fund->type,
            'employee_share_amount' => $this->emp_amount ?? $fund->employee_share_amount,
            'org_share_amount' => $this->org_amount ?? $fund->org_share_amount,
            'employee_share_percent' => $this->emp_percent,
            'org_share_percent' => $this->org_percent,
            'description' => $this->description,
        ]);
        $this->emit('notify', ['message' => "Provident Fund has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $fund = ProvidentFundModel::findOrFail($this->providentFundId);
        $fund->delete();
        $this->emit('notify', ['message' => "Provident Fund has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }


    public function render()
    {
        $employees = Employee::get();
        return view('accounts::livewire.provident-fund-component',compact(
            'employees'
        ));
    }
}
