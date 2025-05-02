<?php

namespace App\Http\Livewire\LicenseManagement;

use Livewire\Component;
use App\Models\License;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateLicenseModal extends Component
{
    public $isOpen = false;

    public $license_id;
    public $license_number;
    public $issue_date; // Match typical License model naming
    public $expiry_date;
    public $name;
    public $email;
    public $id_type;
    public $id_number;
    public $date_of_birth;
    public $age;
    public $sex;
    public $permanent_address;
    public $phone_number;
    public $divisional_secretariat_code;
    public $blood_group;
    public $organ_donor_status;
    public $height;
    public $user_id; // Added to track User relationship

    protected $rules = [
        'license_number' => 'required|string|max:255',
        'issue_date' => 'required|date',
        'expiry_date' => 'required|date|after:issue_date',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'id_type' => 'required|string|max:255',
        'id_number' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'age' => 'required|integer|min:0',
        'sex' => 'required|in:Male,Female,Other', // Added 'Other' for flexibility
        'permanent_address' => 'required|string',
        'phone_number' => 'required|string|max:15',
        'divisional_secretariat_code' => 'required|string|size:4',
        'blood_group' => 'required|string|max:3',
        'organ_donor_status' => 'required|boolean',
        'height' => 'required|numeric|min:0', // Changed to numeric for consistency
    ];

    protected $listeners = [
        'openUpdateLicenseModal' => 'openModal',
    ];

    public function openModal($licenseId)
    {
        $this->isOpen = true;
        $this->loadLicense($licenseId);
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'license_id', 'license_number', 'issue_date', 'expiry_date', 'name', 'email',
            'id_type', 'id_number', 'date_of_birth', 'age', 'sex', 'permanent_address',
            'phone_number', 'divisional_secretariat_code', 'blood_group', 'organ_donor_status',
            'height', 'user_id'
        ]);
    }

    public function loadLicense($licenseId)
    {
        $license = License::with('user')->findOrFail($licenseId);
        $this->license_id = $license->id;
        $this->license_number = $license->license_number;
        $this->issue_date = $license->issue_date;
        $this->expiry_date = $license->expiry_date;
        $this->name = $license->name ?? $license->user->name;
        $this->email = $license->email ?? $license->user->email;
        $this->id_type = $license->id_type;
        $this->id_number = $license->id_number;
        $this->date_of_birth = $license->date_of_birth;
        $this->age = $license->age;
        $this->sex = $license->sex;
        $this->permanent_address = $license->permanent_address;
        $this->phone_number = $license->phone_number;
        $this->divisional_secretariat_code = $license->divisional_secretariat_code;
        $this->blood_group = $license->blood_group;
        $this->organ_donor_status = $license->organ_donor_status;
        $this->height = $license->height;
        $this->user_id = $license->user_id;
    }

    public function updateLicense()
    {
        // Dynamically adjust unique rules
        $this->rules['license_number'] = 'required|string|max:255|unique:licenses,license_number,' . $this->license_id;
        $this->rules['id_number'] = 'required|string|max:255|unique:licenses,id_number,' . $this->license_id;
        $this->rules['email'] = 'required|email|max:255|unique:users,email,' . $this->user_id;

        $this->validate();

        $license = License::findOrFail($this->license_id);
        $license->update([
            'license_number' => $this->license_number,
            'issue_date' => $this->issue_date,
            'expiry_date' => $this->expiry_date,
            'id_type' => $this->id_type,
            'id_number' => $this->id_number,
            'date_of_birth' => $this->date_of_birth,
            'age' => $this->age,
            'sex' => $this->sex,
            'permanent_address' => $this->permanent_address,
            'phone_number' => $this->phone_number,
            'divisional_secretariat_code' => $this->divisional_secretariat_code,
            'blood_group' => $this->blood_group,
            'organ_donor_status' => $this->organ_donor_status,
            'height' => $this->height,
        ]);

        if ($license->user) {
            $license->user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);
        }

        $this->dispatch('show-success-alert', [
            'message' => 'License updated successfully!',
            'type' => 'success',
        ]);
        $this->dispatch('refreshComponent'); // Refresh parent component

        $this->closeModal();
    }

    public function updateExpiryDate()
    {
        if ($this->issue_date) {
            $this->expiry_date = \Carbon\Carbon::parse($this->issue_date)->addYears(5)->format('Y-m-d');
        }
    }

    public function render()
    {
        return view('livewire.license-management.update-license-modal');
    }
}