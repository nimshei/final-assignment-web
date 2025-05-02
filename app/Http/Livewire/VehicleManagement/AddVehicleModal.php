<?php

namespace App\Http\Livewire\VehicleManagement;

use Livewire\Component;
use App\Models\Vehicle;

class AddVehicleModal extends Component
{
    public $isOpen = false;

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

    protected $rules;

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

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function createVehicle()
    {
        $this->validate();

        // Create the vehicle
        Vehicle::create([
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

        $this->dispatch('show-success-alert', 'Vehicle created successfully!');

        $this->closeModal();

        $this->reset([
            'plate_number', 'make', 'model', 'color', 'owner_nic', 'owner_name',
            'owner_contact', 'chassis_number', 'engine_number', 'vehicle_type', 'year_of_manufacture'
        ]);
    }

    public function render()
    {
        return view('livewire.vehicle-management.add-vehicle-modal');
    }
}
