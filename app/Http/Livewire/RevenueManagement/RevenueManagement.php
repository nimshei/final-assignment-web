<?php

namespace App\Http\Livewire\RevenueManagement;

use App\Models\Vehicle;
use App\Models\RevenueLicense;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Log;

class RevenueManagement extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedVehicleType = '';
    public $selectedActiveStatus = '';
    public $createdDate = '';

    protected $listeners = [
        'confirmedDelete' => 'performDelete',
        'refreshComponent' => 'refresh',
    ];

    // Reset pagination when filters change
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'selectedVehicleType', 'selectedActiveStatus', 'createdDate'])) {
            $this->resetPage();
        }
    }

    public function deleteRevenueLicense($vehicleId)
    {
        $revenueLicenses = RevenueLicense::where('vehicle_id', $vehicleId)->get();

        if ($revenueLicenses->isNotEmpty()) {
            $this->dispatch('confirm-delete', [
                'vehicleId' => $vehicleId,
                'message' => 'Are you sure you want to delete all revenue licenses for this vehicle?'
            ]);
        } else {
            Log::warning('Revenue licenses not found in deleteRevenueLicense for vehicleId: ' . $vehicleId);
            $this->dispatch('show-success-alert', [
                'message' => 'Revenue licenses not found!',
                'type' => 'error',
            ]);
        }
    }

    public function performDelete($data)
    {
        $vehicleId = $data['vehicleId'] ?? null;

        if (!$vehicleId) {
            Log::error('Invalid vehicleId received in performDelete', ['data' => $data]);
            $this->dispatch('show-success-alert', [
                'message' => 'Invalid vehicle ID!',
                'type' => 'error',
            ]);
            return;
        }

        $revenueLicenses = RevenueLicense::where('vehicle_id', $vehicleId)->get();

        if ($revenueLicenses->isNotEmpty()) {
            foreach ($revenueLicenses as $revenueLicense) {
                $revenueLicense->delete();
            }
            $this->dispatch('show-success-alert', [
                'message' => 'All revenue licenses for the vehicle deleted successfully!',
                'type' => 'success',
            ]);
            $this->resetPage();
        } else {
            Log::warning('Revenue licenses not found in performDelete for vehicleId: ' . $vehicleId);
            $this->dispatch('show-success-alert', [
                'message' => 'Revenue licenses not found!',
                'type' => 'error',
            ]);
        }
    }

    public function refresh()
    {
        $this->reset(['search', 'selectedVehicleType', 'selectedActiveStatus', 'createdDate']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Vehicle::with('revenueLicenses');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('plate_number', 'like', '%' . $this->search . '%')
                  ->orWhere('make', 'like', '%' . $this->search . '%')
                  ->orWhere('model', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedVehicleType) {
            $query->where('vehicle_type', $this->selectedVehicleType);
        }

        if ($this->selectedActiveStatus !== '') {
            $query->whereHas('revenueLicenses', function ($q) {
                $q->where('status', $this->selectedActiveStatus);
            });
        }

        if ($this->createdDate) {
            $query->whereHas('revenueLicenses', function ($q) {
                $q->whereDate('issue_date', $this->createdDate);
            });
        }

        $vehicles = $query->paginate(10);
        $vehicleTypes = Vehicle::select('vehicle_type')->distinct()->get();

        return view('livewire.revenue-management.revenue-management', [
            'vehicles' => $vehicles,
            'vehicleTypes' => $vehicleTypes,
        ]);
    }
}