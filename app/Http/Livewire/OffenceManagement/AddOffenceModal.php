<?php

namespace App\Http\Livewire\OffenceManagement;

use Livewire\Component;
use App\Models\License;
use App\Models\Officer;
use App\Models\Vehicle;
use App\Models\Violation;
use App\Models\Offence;

class AddOffenceModal extends Component
{
    public $isOpen = false;

    public $license_id;
    public $officer_id;
    public $vehicle_id;
    public $violation_id;
    public $date_time;
    public $location;
    public $description;
    public $fine_amount;
    public $court_date;
    public $deadline;
    public $status = 'Pending';

    protected $rules = [
        'license_id' => 'required|exists:licenses,id',
        'officer_id' => 'required|exists:officers,id',
        'vehicle_id' => 'required|exists:vehicles,id',
        'violation_id' => 'required|exists:violations,id',
        'date_time' => 'required|date',
        'location' => 'required|string|max:255',
        'description' => 'nullable|string',
        'fine_amount' => 'required|numeric|min:0',
        'court_date' => 'nullable|date',
        'deadline' => 'nullable|date',
        'status' => 'required|in:Pending,Warning,Paid,Court',
    ];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function createOffence()
    {
        $this->validate();

        Offence::create([
            'license_id' => $this->license_id,
            'officer_id' => $this->officer_id,
            'vehicle_id' => $this->vehicle_id,
            'violation_id' => $this->violation_id,
            'date_time' => $this->date_time,
            'location' => $this->location,
            'description' => $this->description,
            'fine_amount' => $this->fine_amount,
            'court_date' => $this->court_date,
            'deadline' => $this->deadline,
            'status' => $this->status,
        ]);

        $this->dispatch('show-success-alert', message: 'Offence Added successfully!');

        $this->closeModal();

        $this->reset([
            'license_id', 'officer_id', 'vehicle_id', 'violation_id',
            'date_time', 'location', 'description', 'fine_amount',
            'court_date', 'deadline', 'status'
        ]);
    }

    public function render()
    {
        return view('livewire.offence-management.add-offence-modal', [
            'licenses' => License::all(['id', 'license_number']),
            'officers' => Officer::all(['id', 'name']),
            'vehicles' => Vehicle::all(['id', 'plate_number']),
            'violations' => Violation::all(['id', 'violation_name']),
        ]);
    }
}
