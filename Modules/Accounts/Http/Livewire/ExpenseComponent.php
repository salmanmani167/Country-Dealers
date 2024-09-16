<?php

namespace Modules\Accounts\Http\Livewire;

use App\Http\Livewire\Modal;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Accounts\Entities\Expense as ExpenseModel;

class ExpenseComponent extends Modal
{
    use WithFileUploads;

    public $expenseId, $name, $user, $seller, $date, $payment_method, $amount, $file, $status;

    protected $listeners = [
        'openModal',
        'hasData' => 'getData',
    ];

    protected $rules = [
        'name' => 'required',
        'user' => 'required',
        'seller' => 'required',
        'date' => 'nullable',
        'payment_method' => 'required',
        'amount' => 'required',
        'file' => 'nullable|file',
        'status' => 'required'
    ];

    public function getData(){
        if(!empty($this->data)){
            $expense = ExpenseModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->expenseId = $expense->id;
            $this->name = $expense->name;
            $this->user = $expense->user_id;
            $this->seller = $expense->purchased_from;
            $this->date = $expense->purchased_date;
            $this->payment_method = $expense->payment_method;
            $this->amount = $expense->amount;
            $this->file = $expense->file;
            $this->status = $expense->status;
        }
    }

    public function store(){
        $this->validate();
        if(is_object($this->file)){
            $file = $this->file->getClientOriginalName();
            $this->file->storeAs('expenses',$file,'public');
        }
        ExpenseModel::create([
            'name' => $this->name,
            'user_id' => $this->user ?? auth()->user()->id,
            'purchased_from' => $this->seller,
            'purchased_date' => $this->date,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount,
            'file' => $file ?? null,
            'status' => $this->status ?? 'Approved',
        ]);
        $this->emit('notify', ['message' => "Expense has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function update(){
        $this->validate();
        $expense = ExpenseModel::findOrFail($this->expenseId);
        if(is_object($this->file)){
            $file = $this->file->getClientOriginalName();
            $this->file->storeAs('expenses',$file,'public');
        }
        $expense->update([
            'name' => $this->name,
            'user_id' => $this->user ?? $expense->user_id,
            'purchased_from' => $this->seller ?? $expense->purchased_from,
            'purchased_date' => $this->date ?? $expense->purchased_date,
            'payment_method' => $this->payment_method ?? $expense->payment_method,
            'amount' => $this->amount ?? $expense->amount,
            'file' => $file ?? $expense->file,
            'status' => $this->status ?? $expense->status,
        ]);
        $this->emit('notify', ['message' => "Expense has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $expense = ExpenseModel::findOrFail($this->expenseId);
        $expense->delete();
        $this->emit('notify', ['message' => "Expense has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }


    public function render()
    {
        $users = User::get();
        return view('accounts::livewire.expense-component',compact(
            'users'
        ));
    }
}
