<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\Holiday as HolidayModel;

class Holiday extends Modal
{

    public $name, $holiday_date, $completed, $holidayId;
    protected $listeners = [
        'openModal',
        'hasData' => 'edit',
    ];
    protected $rules = [
        'name' => 'required|string',
        'holiday_date' => 'required|date'
    ];

    public function store(){
        $this->validate();
        HolidayModel::create([
            'name' => $this->name,
            'holiday_date' => $this->holiday_date,
            'completed' => $this->completed ?? false
        ]);
        $this->emit('notify', ['message' => "Holiday has been added"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function edit(){
        if(!empty($this->data)){
            $holiday = HolidayModel::findOrFail(is_array($this->data) ? $this->data['model']: $this->data);
            $this->holidayId = $holiday->id;
            $this->name = $holiday->name;
            $this->holiday_date = $holiday->holiday_date;
            $this->completed = $holiday->completed;
        }
    }

    public function update(){
        $this->validate();
        $holiday = HolidayModel::findOrFail($this->holidayId);
        $holiday->update([
            'name' => $this->name,
            'holiday_date' => $this->holiday_date,
            'completed' => $this->completed ?? false,
        ]);
        $this->emit('notify', ['message' => "Holiday has been updated"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function delete(){
        $holiday = HolidayModel::findOrFail($this->holidayId);
        $holiday->delete();
        $this->emit('notify', ['message' => "Holiday has been deleted"]);
        $this->closeModal();
        $this->emit('reloadTable');
    }

    public function render()
    {
        return view('livewire.holiday');
    }
}
