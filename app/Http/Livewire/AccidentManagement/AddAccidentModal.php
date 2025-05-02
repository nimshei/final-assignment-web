<?php

namespace App\Http\Livewire\AccidentManagement;

use Livewire\Component;
use App\Models\Accident;
use App\Models\Vehicle;
use App\Models\Officer;

class AddAccidentModal extends Component
{
    public $isOpen = false;

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

    public function openModal()
    {
        $this->isOpen = true;
        $this->vehicleInputs = [null]; // Start with one empty input
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset([
            'officer_id', 'accident_date_time', 'location', 'description', 'severity',
            'injuries', 'fatalities', 'property_damage', 'status', 'notes', 'vehicleInputs'
        ]);
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

    public function createAccident()
    {
        $this->validate();
    
        // Create the accident record
        $accident = Accident::create([
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
    
        // Attach vehicles to the accident using the pivot table
        foreach ($this->vehicleInputs as $vehicleId) {
            \DB::table('accident_vehicle')->insert([
            'accident_id' => $accident->id,
            'vehicle_id' => $vehicleId,
            'created_at' => now(),
            'updated_at' => now(),
            ]);
        }
    
        // Dispatch a success alert
        $this->dispatch('show-success-alert', message: 'Accident added successfully!');
    
        // Close the modal and reset the form
        $this->closeModal();
    }
    

    public function render()
    {
        return view('livewire.accident-management.add-accident-modal', [
            'officers' => Officer::all(['id', 'name']),
            'vehicles' => Vehicle::all(['id', 'plate_number']),
        ]);
    }
}