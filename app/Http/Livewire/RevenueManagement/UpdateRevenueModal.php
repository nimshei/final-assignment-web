<?php

namespace App\Http\Livewire\RevenueManagement;

use Livewire\Component;
use App\Models\Vehicle;
use App\Models\RevenueLicense;
use Carbon\Carbon;

class UpdateRevenueModal extends Component
{
    public $isOpen = false;
    public $revenueId;
    public $selectedVehicle;
    public $amount;

    protected $listeners = ['openUpdateRevenueModal' => 'openModal'];

    protected $rules = [
        'selectedVehicle' => 'required|exists:vehicles,id',
        'amount' => 'required|numeric|min:0',
    ];

    public function openModal($revenueId)
    {
        $this->revenueId = $revenueId;
        $revenue = RevenueLicense::findOrFail($revenueId);

        $this->selectedVehicle = $revenue->vehicle_id;
        $this->amount = $revenue->fee_paid;

        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['revenueId', 'selectedVehicle', 'amount']);
    }

    public function updateRevenue()
    {
        $this->validate();

        $revenue = RevenueLicense::findOrFail($this->revenueId);

        $revenue->update([
            'vehicle_id' => $this->selectedVehicle,
            'fee_paid' => $this->amount,
            'issue_date' => Carbon::now(),
            'expiry_date' => Carbon::now()->addYear(),
        ]);

        $this->dispatch('show-success-alert', message: 'Revenue updated successfully!');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.revenue-management.update-revenue-modal', [
            'vehicles' => Vehicle::all(['id', 'plate_number']),
        ]);
    }
}
