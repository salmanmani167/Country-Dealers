<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use App\Settings\CompanySettings;

class Company extends Component
{
    public $company_name, $contact_person, $address, $country, $city, $province,
     $postal_code, $email, $phone, $mobile, $fax, $website_url;
    protected $settings;

    protected $rules = [
        'company_name' => 'required',
        'contact_person' => 'required',
        'address' => 'required',
        'country' => 'required',
        'city' => 'required',
        'province' => 'required',
        'postal_code' => 'required',
        'email' => 'required',
        'phone' => 'required',
        'mobile' => 'required',
        'fax' => 'required',
        'website_url' => 'required|url'
    ];

    public function __construct(){
        $this->settings = (new CompanySettings());
        $this->company_name = $this->settings->company_name;
        $this->contact_person = $this->settings->contact_person;
        $this->address = $this->settings->address;
        $this->country = $this->settings->country;
        $this->city = $this->settings->city;
        $this->province = $this->settings->province;
        $this->postal_code = $this->settings->postal_code;
        $this->email = $this->settings->email;
        $this->phone = $this->settings->phone;
        $this->mobile = $this->settings->mobile;
        $this->fax = $this->settings->fax;
        $this->website_url = $this->settings->website_url;
    }

    public function update(){
        $this->validate();
        $this->settings->company_name = $this->company_name;
        $this->settings->contact_person = $this->contact_person;
        $this->settings->address = $this->address;
        $this->settings->country = $this->country;
        $this->settings->city = $this->city;
        $this->settings->province = $this->province;
        $this->settings->postal_code = $this->postal_code;
        $this->settings->email = $this->email;
        $this->settings->phone = $this->phone;
        $this->settings->mobile = $this->mobile;
        $this->settings->fax = $this->fax;
        $this->settings->website_url = $this->website_url;
        $this->settings->save();
        $this->emit('notify', ['message' => "Company settings has been updated"]);
    }


    public function render()
    {
        return view('livewire.settings.company');
    }
}
