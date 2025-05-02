<?php

namespace App\Http\Livewire\AccidentManagement;

use Livewire\Component;
use App\Models\Accident;
use App\Models\Vehicle;
use App\Models\Officer;

class UpdateAccidentModal extends Component
{
    public $isOpen = false;

    public $accidentId;
    public $officer_id;
    public $accident_date_time;
    public $location;
    public $description;
    public $severity = 'Minor';
    public $injuries = 0;
    public $fatalities = 0;
    public $property_damage = 0;
    public $status = 'Pending';
    public $notes;
    public $vehicleInputs = []; // Array to store vehicle IDs dynamically

    protected $listeners = ['openUpdateAccidentModal' => 'openUpdateModal'];

    protected $rules = [
        'officer_id' => 'required|exists:officers,id',
        'accident_date_time' => 'required|date',
        'location' => 'required|string|max:255',
        'description' => 'nullable|string',
        'severity' => 'required|in:Minor,Moderate,Severe,Fatal',
        'injuries' => 'required|integer|min:0',
        'fatalities' => 'required|integer|min:0',
        'property_damage' => 'required|numeric|min:0',
        'status' => 'required|in:Pending,Investigating,Resolved,Closed',
        'notes' => 'nullable|string',
        'vehicleInputs' => 'required|array|min:1', // At least one vehicle required
        'vehicleInputs.*' => 'required|exists:vehicles,id', // Each vehicle ID must exist
    ];

    public function openUpdateModal($accidentId)
    {
        $this->isOpen = true;
        $this->loadAccident($accidentId);
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset([
            'accidentId', 'officer_id', 'accident_date_time', 'location', 'description', 
            'severity', 'injuries', 'fatalities', 'property_damage', 'status', 'notes', 'vehicleInputs'
        ]);
    }

    public function loadAccident($accidentId)
    {
        $accident = Accident::with('vehicles')->findOrFail($accidentId);
        $this->accidentId = $accident->id;
        $this->officer_id = $accident->officer_id;
        $this->accident_date_time = $accident->accident_date_time;
        $this->location = $accident->location;
        $this->description = $accident->description;
        $this->severity = $accident->severity;
        $this->injuries = $accident->injuries;
        $this->fatalities = $accident->fatalities;
        $this->property_damage = $accident->property_damage;
        $this->status = $accident->status;
        $this->notes = $accident->notes;
        $this->vehicleInputs = $accident->vehicles->pluck('id')->toArray();
    }

    public function addVehicle()
    {
        $this->vehicleInputs[] = null; // Add a new empty vehicle input
    }

    public function removeVehicle($index)
    {
        unset($this->vehicleInputs[$index]);
        $this->vehicleInputs = array_values($this->vehicleInputs); // Re-index array
    }

    public function updateAccident()
    {
        $this->validate();

        $accident = Accident::findOrFail($this->accidentId);
        $accident->update([
            'officer_id' => $this->officer_id,
            'accident_date_time' => $this->accident_date_time,
            'location' => $this->location,
            'description' => $this->description,
            'severity' => $this->severity,
            'injuries' => $this->injuries,
            'fatalities' => $this->fatalities,
            'property_damage' => $this->property_damage,
            'status' => $this->status,
            'notes' => $this->notes,
        ]);

        // Sync vehicles to the accident using the pivot table
        $accident->vehicles()->sync($this->vehicleInputs);

        // Dispatch a success alert
        $this->dispatch('show-success-alert', message: 'Accident updated successfully!');

        // Close the modal and reset the form
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.accident-management.update-accident-modal', [
            'officers' => Officer::all(['id', 'name']),
            'vehicles' => Vehicle::all(['id', 'plate_number']),
        ]);
    }
}