<?php

namespace App\Http\Livewire\ViolationManagement;

use Livewire\Component;
use App\Models\Violation;

class AddViolationModal extends Component
{
    public $isOpen = false;

    public $violation_code;
    public $violation_name;
    public $description;
    public $fine_amount;
    public $penalty;
    public $status;

    protected $rules = [
        'violation_code' => 'required|string|unique:violations,violation_code|max:255',
        'violation_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'fine_amount' => 'nullable|numeric|min:0',
        'penalty' => 'nullable|integer|min:0',
        'status' => 'required|string|in:active,inactive',
    ];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function createViolation()
    {
        $this->validate();

        Violation::create([
            'violation_code' => $this->violation_code,
            'violation_name' => $this->violation_name,
            'description' => $this->description,
            'fine_amount' => $this->fine_amount,
            'penalty' => $this->penalty,
            'status' => $this->status,
        ]);

        $this->dispatch('show-success-alert', message: 'Violation added successfully!');

        $this->closeModal();

        $this->reset(['violation_code', 'violation_name', 'description', 'fine_amount', 'penalty', 'status']);
    }

    public function render()
    {
        return view('livewire.violation-management.add-violation-modal');
    }
}
