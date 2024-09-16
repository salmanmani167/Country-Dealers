<?php

namespace Modules\Apps\Http\Livewire\Apps;

use App\Http\Livewire\Modal;
use Livewire\Component;
use Modules\Apps\Entities\Event;

class Calendar extends Modal
{
    public $name, $event_date, $category, $eventId;
    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];
    protected $rules = [
        'name' => 'required|string',
        'event_date' => 'required|date',
        'category' => 'required',
    ];

    public function store(){
        $this->validate();
        Event::create([
            'name' => $this->name,
            'date_' => $this->event_date,
            'category' => $this->category,
        ]);
        $this->emit('notify', ['message' => "Event has been added"]);
        $this->closeModal();
        $this->emit('reloadPage');
    }

    public function edit(){
        if(!empty($this->data)){
            $event = Event::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->eventId =$event->id;
            $this->name =$event->name;
            $this->event_date =$event->date_;
            $this->category =$event->category;
        }
    }

    public function update(){
        $this->validate();
       $event = Event::findOrFail($this->eventId);
       $event->update([
        'name' => $this->name,
        'date_' => $this->event_date,
        'category' => $this->category,
        ]);
        $this->emit('notify', ['message' => "Event has been updated"]);
        $this->closeModal();
        $this->emit('reloadPage');
    }

    public function delete(){
       $event = Event::findOrFail($this->eventId);
       $event->delete();
        $this->emit('notify', ['message' => "Event has been deleted"]);
        $this->closeModal();
        $this->emit('reloadPage');
    }

    public function render()
    {
        $events = Event::all();
        return view('apps::livewire.apps.calendar',compact(
            'events'
        ));
    }
}
