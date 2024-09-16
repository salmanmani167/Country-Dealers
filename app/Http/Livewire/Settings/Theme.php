<?php

namespace App\Http\Livewire\Settings;

use App\Settings\ThemeSettings;
use Livewire\Component;
use Livewire\WithFileUploads;

class Theme extends Component
{
    use WithFileUploads;

    public $site_name, $currency_code, $currency_symbol, $favicon, $logo;

    protected $settings;

    public function __construct(){
        $this->settings = (new ThemeSettings());
        $this->site_name = $this->settings->site_name;
        $this->logo = $this->settings->logo;
        $this->favicon = $this->settings->favicon;
        $this->currency_code = $this->settings->currency_code;
        $this->currency_symbol = $this->settings->currency_symbol;

    }



    public function update(){
        $this->validate([
            'logo' => 'nullable',
            'favicon' => 'nullable|image',
        ]);
        if(is_object($this->logo)){
            $logo_file = $this->logo->getClientOriginalName();
            $this->logo->storeAs('settings/theme',$logo_file,'public');
        }
        if(is_object($this->favicon)){
            $favicon_file = $this->favicon->getClientOriginalName();
            $this->favicon->storeAs('settings/theme', $favicon_file,'public');
        }
        $this->settings->site_name = $this->site_name ?? $this->settings->site_name;
        $this->settings->logo = $logo_file ?? $this->settings->logo;
        $this->settings->favicon = $favicon_file ?? $this->settings->favicon;
        $this->settings->currency_code = $this->currency_code ?? $this->settings->currency_code;
        $this->settings->currency_symbol = $this->currency_symbol ?? $this->settings->currency_symbol;
        $this->settings->save();
        $this->emit('notify', ['message' => "Theme has been updated"]);
    }

    public function render()
    {
        return view('livewire.settings.theme');
    }
}
