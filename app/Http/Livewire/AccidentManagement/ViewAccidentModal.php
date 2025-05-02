<?php

namespace App\Http\Livewire\AccidentManagement;

use Livewire\Component;

class ViewAccidentModal extends Component
{
    public $isOpen = false;
    public $note;
    public $description;

    protected $listeners = ['openViewAccidentModal'];

    public function openViewAccidentModal($data)
    {
        $this->note = $data['note'];
        $this->description = $data['description'];
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['note', 'description']);
    }

    public function render()
    {
        return view('livewire.accident-management.view-accident-modal');
    }
}
