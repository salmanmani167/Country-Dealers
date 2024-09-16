<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\Announcement;
use App\Models\User;
use App\Notifications\AnnouncementNotification;
use Illuminate\Support\Facades\Notification;

class AnnoucementComponent extends Modal
{

    public $subject, $body;

    protected $rules = [
        'subject' => 'required|string',
        'body' => 'required|string',
    ];

    public function send(){
        $this->validate();
        $announcement = Announcement::create([
            'subject' => $this->subject,
            'body' => $this->body,
            'user_id' => auth()->user()->id
        ]);
        Notification::send(User::all(), new AnnouncementNotification($announcement));
        $alert = notify('Announcement has been posted');
        $this->emit('notify', $alert);
        $this->emit('reloadPage');
        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.annoucement-component');
    }
}
