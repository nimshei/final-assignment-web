<?php

namespace App\Http\Livewire\LicenseManagement;

use Livewire\Component;
use App\Models\License;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AddLicenseModal extends Component
{
    public $isOpen = false;

    public $license_number;
    public $license_type;
    public $issued_date;
    public $expiry_date;
    public $name;
    public $email;
    public $password;
    public $confirm_password;
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

    protected $rules = [
        'license_number' => 'required|string|max:255|unique:licenses,license_number',
        'issued_date' => 'required|date',
        'expiry_date' => 'required|date|after:issued_date',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8',
        'confirm_password' => 'required|same:password',
        'id_type' => 'required|string|max:255',
        'id_number' => 'required|string|max:255|unique:licenses,id_number',
        'date_of_birth' => 'required|date',
        'age' => 'required|integer|min:0',
        'sex' => 'required|in:Male,Female',
        'permanent_address' => 'required|string',
        'phone_number' => 'required|string|max:15',
        'divisional_secretariat_code' => 'required|string|size:4',
        'blood_group' => 'required|string|max:3',
        'organ_donor_status' => 'required|boolean',
        'height' => 'required|string|max:255',
    ];

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function createLicense()
    {
        $this->validate();

        // Create the user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        // Assign the 'user' role to the created user
        $user->assignRole('user');

        // Create the license and associate it with the user
        License::create([
            'user_id' => $user->id,
            'name' => $this->name,
            'email' => $this->email,
            'license_number' => $this->license_number,
            'issue_date' => $this->issued_date,
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

        $this->dispatch('show-success-alert', 'License and User created successfully!');

        $this->closeModal();

        $this->reset([
            'license_number', 'issued_date', 'expiry_date', 'name', 'email',
            'password', 'confirm_password', 'id_type', 'id_number', 'date_of_birth', 'age', 'sex',
            'permanent_address', 'phone_number', 'divisional_secretariat_code', 'blood_group',
            'organ_donor_status', 'height'
        ]);
    }

    public function updateExpiryDate()
    {
        if ($this->issued_date) {
            $this->expiry_date = \Carbon\Carbon::parse($this->issued_date)->addYears(5)->format('Y-m-d');
        }
    }

    public function render()
    {
        return view('livewire.license-management.add-license-modal');
    }
}
