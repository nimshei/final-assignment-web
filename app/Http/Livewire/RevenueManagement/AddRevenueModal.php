<?php

namespace App\Http\Livewire\RevenueManagement;

use Livewire\Component;
use App\Models\Vehicle;
use App\Models\RevenueLicense;
use Carbon\Carbon;

class AddRevenueModal extends Component
{
    public $isOpen = false;
    public $selectedVehicle;
    public $amount;

    protected $rules = [
        'selectedVehicle' => 'required|exists:vehicles,id',
        'amount' => 'required|numeric|min:0',
    ];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['selectedVehicle', 'amount']);
    }

    public function addRevenue()
    {
        $this->validate();

        $existingRevenue = RevenueLicense::where('vehicle_id', $this->selectedVehicle)
            ->orderBy('issue_date', 'desc')
            ->first();

        if ($existingRevenue) {
            $existingRevenue->update([
                'fee_paid' => $this->amount,
                'issue_date' => Carbon::now(),
                'expiry_date' => Carbon::now()->addYear(),
            ]);
        } else {
            RevenueLicense::create([
                'vehicle_id' => $this->selectedVehicle,
                'fee_paid' => $this->amount,
                'issue_date' => Carbon::now(),
                'expiry_date' => Carbon::now()->addYear(),
            ]);
        }

        $this->dispatch('show-success-alert', message: 'Revenue added/updated successfully!');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.revenue-management.add-revenue-modal', [
            'vehicles' => Vehicle::all(['id', 'plate_number']),
        ]);
    }
}
