<?php

namespace App\Http\Livewire\Settings;

use App\Settings\AttendanceSettings;
use Livewire\Component;

class Attendance extends Component
{
    public $checkin, $checkout;

    protected $settings;

    public function __construct(){
        $this->settings = (new AttendanceSettings());
        $this->checkin = $this->settings->checkin_time;
        $this->checkout = $this->settings->checkout_time;
    }

    public function update(){
        $this->settings->checkin_time = $this->checkin;
        $this->settings->checkout_time = $this->checkout;
        $this->settings->save();
        $this->emit('notify', ['message' => "Attendance settings has been updated"]);
    }

    public function render()
    {
        return view('livewire.settings.attendance');
    }
}
