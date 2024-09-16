<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{

    public $isOpen = false;
    public $data , $modal_id;

    protected $listeners = ['openModal', 'closeModal'];

    public function openModal($data = null)
    {
        $this->data = $data;
        $this->isOpen = true;
        if(!empty($data)){
            $this->emit('hasData');
            if(is_array($this->data)){
                if(in_array('delete',$this->data)){
                    $this->emit('deleteModel');
                }
                if(!empty($this->data['modal'])){
                    $this->modal_id = $this->data['modal'];
                }
            }
        }
        $this->emit('reusableModalOpened',[
            'modal' => $this->modal_id
        ]);
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->data = null;

        $this->emit('reusableModalClosed',[
            'modal' => $this->modal_id
        ]);
    }

}
