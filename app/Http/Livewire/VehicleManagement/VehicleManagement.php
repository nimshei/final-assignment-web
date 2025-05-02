<?php

namespace App\Http\Livewire\VehicleManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Log;

class VehicleManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedVehicleType = '';
    public $selectedYearOfManufacture = '';

    protected $listeners = [
        'confirmedDelete' => 'performDelete',
        'refreshComponent' => 'refreshFilters',
    ];

    public function deleteVehicle($vehicleId)
    {
        $vehicle = Vehicle::find($vehicleId);

        if ($vehicle) {
            $this->dispatch('confirm-delete', [
                'vehicleId' => (int) $vehicleId,
                'message' => 'Are you sure you want to delete this vehicle?',
            ]);
        } else {
            $this->dispatch('show-success-alert', [
                'message' => 'Vehicle not found!',
                'type' => 'error',
            ]);
        }
    }

    public function performDelete($data)
    {
        $vehicleId = $data['vehicleId'];
        $vehicle = Vehicle::find($vehicleId);
        if ($vehicle) {
            $vehicle->delete();
            $this->dispatch('show-success-alert', [
                'message' => 'Vehicle deleted successfully!',
                'type' => 'success',
            ]);
            $this->resetPage();
        } else {
            $this->dispatch('show-success-alert', [
                'message' => 'Vehicle not found!',
                'type' => 'error',
            ]);
        }
    }

    public function refresh()
    {
        $this->reset(['search', 'selectedVehicleType', 'selectedYearOfManufacture']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Vehicle::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('plate_number', 'like', '%' . $this->search . '%')
                  ->orWhere('make', 'like', '%' . $this->search . '%')
                  ->orWhere('model', 'like', '%' . $this->search . '%')
                  ->orWhere('owner_name', 'like', '%' . $this->search . '%')
                  ->orWhere('owner_nic', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedVehicleType) {
            $query->where('vehicle_type', $this->selectedVehicleType);
        }

        if ($this->selectedYearOfManufacture) {
            $query->whereYear('year_of_manufacture', $this->selectedYearOfManufacture);
        }

        $vehicles = $query->paginate(10);
        $vehicleTypes = Vehicle::distinct('vehicle_type')->pluck('vehicle_type')->filter();

        return view('livewire.vehicle-management.vehicle-management', compact('vehicles', 'vehicleTypes'));
    }
}
