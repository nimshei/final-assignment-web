<?php

namespace App\Http\Livewire\VehicleManagement;

use Livewire\Component;
use App\Models\Vehicle;

class UpdateVehicleModal extends Component
{
    public $isOpen = false;

    public $vehicle_id;
    public $plate_number;
    public $make;
    public $model;
    public $color;
    public $owner_nic;
    public $owner_name;
    public $owner_contact;
    public $chassis_number;
    public $engine_number;
    public $vehicle_type;
    public $year_of_manufacture;

    protected $rules = [];

    public function __construct()
    {
        $this->rules = [
            'plate_number' => 'required|string|max:255|unique:vehicles,plate_number',
            'make' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'owner_nic' => 'required|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_contact' => 'nullable|string|max:15',
            'chassis_number' => 'required|string|max:255|unique:vehicles,chassis_number',
            'engine_number' => 'required|string|max:255|unique:vehicles,engine_number',
            'vehicle_type' => 'required|string|max:255',
            'year_of_manufacture' => 'required|integer|min:1900|max:' . date('Y'),
        ];
    }

    protected $listeners = [
        'openUpdateVehicleModal' => 'openModal',
    ];

    public function openModal($vehicleId)
    {
        $this->isOpen = true;
        $this->loadVehicle($vehicleId);
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'vehicle_id', 'plate_number', 'make', 'model', 'color', 'owner_nic',
            'owner_name', 'owner_contact', 'chassis_number', 'engine_number',
            'vehicle_type', 'year_of_manufacture'
        ]);
    }

    public function loadVehicle($vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);
        $this->vehicle_id = $vehicle->id;
        $this->plate_number = $vehicle->plate_number;
        $this->make = $vehicle->make;
        $this->model = $vehicle->model;
        $this->color = $vehicle->color;
        $this->owner_nic = $vehicle->owner_nic;
        $this->owner_name = $vehicle->owner_name;
        $this->owner_contact = $vehicle->owner_contact;
        $this->chassis_number = $vehicle->chassis_number;
        $this->engine_number = $vehicle->engine_number;
        $this->vehicle_type = $vehicle->vehicle_type;
        $this->year_of_manufacture = $vehicle->year_of_manufacture;
    }

    public function updateVehicle()
    {
        // Dynamically adjust unique rules
        $this->rules['plate_number'] = 'required|string|max:255|unique:vehicles,plate_number,' . $this->vehicle_id;
        $this->rules['chassis_number'] = 'required|string|max:255|unique:vehicles,chassis_number,' . $this->vehicle_id;
        $this->rules['engine_number'] = 'required|string|max:255|unique:vehicles,engine_number,' . $this->vehicle_id;

        $this->validate();

        $vehicle = Vehicle::findOrFail($this->vehicle_id);
        $vehicle->update([
            'plate_number' => $this->plate_number,
            'make' => $this->make,
            'model' => $this->model,
            'color' => $this->color,
            'owner_nic' => $this->owner_nic,
            'owner_name' => $this->owner_name,
            'owner_contact' => $this->owner_contact,
            'chassis_number' => $this->chassis_number,
            'engine_number' => $this->engine_number,
            'vehicle_type' => $this->vehicle_type,
            'year_of_manufacture' => $this->year_of_manufacture,
        ]);

        $this->dispatch('show-success-alert', [
            'message' => 'Vehicle updated successfully!',
            'type' => 'success',
        ]);
        $this->dispatch('refreshComponent'); // Refresh parent component

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.vehicle-management.update-vehicle-modal');
    }
}
