<?php

namespace App\Http\Livewire\AccidentManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Accident;
use App\Models\Officer;
use App\Models\Vehicle;

class AccidentManagement extends Component
{
    use WithPagination;

    public $selectedSeverity = '';
    public $selectedStatus = '';
    public $searchLocation = '';
    public $accidentDate = '';

    protected $listeners = [
        'confirmedDelete' => 'performDelete',
        'refreshComponent' => 'refreshFilters',
    ];

    public function deleteAccident($accidentId)
    {
        $accident = Accident::find($accidentId);

        if ($accident) {
            $this->dispatch('confirm-delete', [
                'accidentId' => $accidentId,
                'message' => 'Are you sure you want to delete this accident record?',
            ]);
        } else {
            $this->dispatch('show-success-alert', [
                'message' => 'Accident record not found!',
                'type' => 'error',
            ]);
        }
    }

    public function performDelete($data)
    {
        $accidentId = $data['accidentId'];
        $accident = Accident::find($accidentId);

        if ($accident) {
            $accident->delete();
            $this->dispatch('show-success-alert', [
                'message' => 'Accident record deleted successfully!',
                'type' => 'success',
            ]);
            $this->refresh();
        } else {
            $this->dispatch('show-success-alert', [
                'message' => 'Accident record not found!',
                'type' => 'error',
            ]);
        }
    }

    public function refresh()
    {
        $this->reset(['selectedSeverity', 'selectedStatus', 'searchLocation', 'accidentDate']);
        $this->resetPage();
    }

    public function updated($propertyName)
    {
        // Reset pagination when a filter is updated
        if (in_array($propertyName, ['selectedSeverity', 'selectedStatus', 'searchLocation', 'accidentDate'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $query = Accident::with(['officer', 'vehicles'])
            ->addSelect(['plate_numbers' => Vehicle::selectRaw('GROUP_CONCAT(plate_number SEPARATOR ", ")')
                ->join('accident_vehicle', 'vehicles.id', '=', 'accident_vehicle.vehicle_id')
                ->whereColumn('accident_vehicle.accident_id', 'accidents.id')
                ->groupBy('accident_vehicle.accident_id')
            ]);

        if (!empty($this->selectedSeverity)) {
            $query->where('severity', $this->selectedSeverity);
        }

        if (!empty($this->selectedStatus)) {
            $query->where('status', $this->selectedStatus);
        }

        if (!empty($this->searchLocation)) {
            $query->where(function ($subQuery) {
                $subQuery->where('location', 'like', '%' . $this->searchLocation . '%')
                    ->orWhereHas('vehicles', function ($vehicleQuery) {
                        $vehicleQuery->where('plate_number', 'like', '%' . $this->searchLocation . '%');
                    })
                    ->orWhereHas('officer', function ($officerQuery) {
                        $officerQuery->where('name', 'like', '%' . $this->searchLocation . '%');
                    });
            });
        }

        if (!empty($this->accidentDate)) {
            $query->whereDate('accident_date_time', $this->accidentDate);
        }

        $accidents = $query->paginate(10);
        $officers = Officer::all();

        return view('livewire.accident-management.accident-management', compact('accidents', 'officers'));
    }
}