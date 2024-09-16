<?php

namespace App\Http\Livewire\Settings;

use App\Settings\InvoiceSettings;
use Livewire\Component;
use Livewire\WithFileUploads;

class Invoice extends Component
{
    public $logo, $prefix;

    use WithFileUploads;

    protected $settings;

    public function __construct(){
        $this->settings = (new InvoiceSettings());
        $this->logo = $this->settings->logo;
        $this->prefix = $this->settings->prefix;
    }



    public function update(){
        $this->validate([
            'logo' => 'nullable|image',
            'prefix' => 'required|string',
        ]);
        if(is_object($this->logo)){
            $logo_file = $this->logo->getClientOriginalName();
            $this->logo->storeAs('settings/invoice',$logo_file,'public');
        }
        $this->settings->prefix = $this->prefix ?? $this->settings->prefix;
        $this->settings->logo = $logo_file ?? $this->settings->logo;
        $this->settings->save();
        $this->emit('notify', ['message' => "Invoice settings has been updated"]);
    }

    public function render()
    {
        return view('livewire.settings.invoice');
    }
}
