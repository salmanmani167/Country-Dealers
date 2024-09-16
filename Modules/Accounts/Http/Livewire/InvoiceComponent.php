<?php

namespace Modules\Accounts\Http\Livewire;

use App\Http\Livewire\Modal;
use Livewire\Component;
use Modules\Accounts\Entities\Invoice as InvoiceModel;

class InvoiceComponent extends Modal
{
    public $inv_id,$invoiceId;

    protected $listeners = [
        'openModal',
        'hasData' => 'getData',
    ];

    public function getData(){
        if(!empty($this->data)){
            $invoice = InvoiceModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->invoiceId = $invoice->id;
            $this->inv_id = $invoice->inv_id;
        }
    }

    public function delete(){
        $expense = InvoiceModel::findOrFail($this->invoiceId);
        $expense->delete();
        $this->emit('notify', ['message' => "Invoice has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }


    public function render()
    {
        return view('accounts::livewire.invoice-component');
    }
}
