<?php

namespace App\Http\Livewire\ViolationManagement;

use Livewire\Component;
use App\Models\Violation;

class UpdateViolationModal extends Component
{
    public $isOpen = false;
    public $violationId;
    public $violation_code;
    public $violation_name;
    public $description;
    public $fine_amount;
    public $penalty;
    public $status;

    // Define the listener explicitly
    protected $listeners = ['openUpdateViolationModal' => 'openUpdateModal'];

    protected $rules = [
        'violation_code' => 'required|string|unique:violations,violation_code',
        'violation_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'fine_amount' => 'nullable|numeric|min:0',
        'penalty' => 'nullable|integer|min:0',
        'status' => 'required|string|in:active,inactive',
    ];

    public function openUpdateModal($violationId)
    {
        $this->isOpen = true;
        $this->loadViolation($violationId);
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['violationId', 'violation_code', 'violation_name', 'description', 'fine_amount', 'penalty', 'status']);
    }

    public function loadViolation($violationId)
    {
        $violation = Violation::findOrFail($violationId);
        $this->violationId = $violation->id;
        $this->violation_code = $violation->violation_code;
        $this->violation_name = $violation->violation_name;
        $this->description = $violation->description;
        $this->fine_amount = $violation->fine_amount;
        $this->penalty = $violation->penalty;
        $this->status = $violation->status;
    }

    public function updateViolation()
    {
        $this->rules['violation_code'] = 'required|string|unique:violations,violation_code,' . $this->violationId;
        $this->validate();

        $violation = Violation::findOrFail($this->violationId);
        $violation->update([
            'violation_code' => $this->violation_code,
            'violation_name' => $this->violation_name,
            'description' => $this->description,
            'fine_amount' => $this->fine_amount,
            'penalty' => $this->penalty,
            'status' => $this->status,
        ]);

        $this->dispatch('show-success-alert', message: 'Violation updated successfully!');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.violation-management.update-violation-modal');
    }
}