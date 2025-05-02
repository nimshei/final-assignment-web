<?php

namespace App\Http\Livewire\LicenseManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\License;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LicenseManagement extends Component
{
    use WithPagination;

    public $selectedUser = '';
    public $search = '';
    public $expiryDate = '';
    public $selectedLicenseType = '';
    public $selectedActiveStatus = '';
    public $selectedBloodGroup = '';
    public $selectedOrganDonorStatus = '';

    protected $listeners = [
        'confirmedDelete' => 'performDelete',
        'refreshComponent' => 'refreshFilters',
    ];

    public function deleteLicense($licenseId)
    {
        $license = License::find($licenseId);

        if ($license) {
            $this->dispatch('confirm-delete', [
                'licenseId' => $licenseId,
                'message' => 'Are you sure you want to delete this license?',
            ]);
        } else {
            Log::warning('License not found in deleteLicense for licenseId: ' . $licenseId);
            $this->dispatch('show-success-alert', [
                'message' => 'License not found!',
                'type' => 'error',
            ]);
        }
    }

    public function performDelete($data)
    {
        $licenseId = $data['licenseId'];
        $license = License::find($licenseId);
        if ($license) {
            $license->delete();
            $this->dispatch('show-success-alert', [
                'message' => 'License deleted successfully!',
                'type' => 'success',
            ]);
            $this->resetPage();
        } else {
            Log::warning('License not found in performDelete for licenseId: ' . $licenseId);
            $this->dispatch('show-success-alert', [
                'message' => 'License not found!',
                'type' => 'error',
            ]);
        }
    }

    public function refresh()
    {
        $this->reset(['selectedUser', 'search', 'expiryDate', 'selectedLicenseType', 'selectedActiveStatus', 'selectedBloodGroup', 'selectedOrganDonorStatus']);
        $this->resetPage();
    }

    public function toggleActiveStatus($licenseId)
    {
        Log::info('toggleActiveStatus called with licenseId: ' . $licenseId);
        $license = License::find($licenseId);

        if ($license) {
            $license->active_status = !$license->active_status;
            $license->save();

            $this->dispatch('show-success-alert', [
                'message' => 'License ' . ($license->active_status ? 'activated' : 'deactivated') . ' successfully!',
                'type' => 'success',
            ]);
        } else {
            Log::warning('License not found in toggleActiveStatus for licenseId: ' . $licenseId);
            $this->dispatch('show-success-alert', [
                'message' => 'License not found!',
                'type' => 'error',
            ]);
        }
    }

    public function render()
    {
        $query = License::with('user');

        if ($this->selectedUser) {
            $query->where('user_id', $this->selectedUser);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->whereHas('user', function ($userQuery) {
                    $userQuery->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhere('license_number', 'like', '%' . $this->search . '%')
                ->orWhere('id_number', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->expiryDate) {
            $query->whereDate('expiry_date', $this->expiryDate);
        }

        if ($this->selectedLicenseType) {
            $query->where('id_type', $this->selectedLicenseType);
        }

        if ($this->selectedActiveStatus !== '') {
            $query->where('active_status', $this->selectedActiveStatus);
        }

        $licenses = $query->paginate(10);
        $users = User::all();
        $licenseTypes = License::distinct()->pluck('id_type')->filter();

        // Attach total penalties to each license row
        $penaltiesPerLicense = \DB::table('offences')
            ->join('violations', 'offences.violation_id', '=', 'violations.id')
            ->select('offences.license_id', \DB::raw('SUM(violations.penalty) as total_penalty'))
            ->groupBy('offences.license_id')
            ->pluck('total_penalty', 'offences.license_id');

        foreach ($licenses as $license) {
            $license->total_penalty = $penaltiesPerLicense->get($license->id, 0);
        }

        return view('livewire.license-management.license-management', compact('licenses', 'users', 'licenseTypes'));
    }
}