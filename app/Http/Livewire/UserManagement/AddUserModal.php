<?php

namespace App\Http\Livewire\UserManagement;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddUserModal extends Component
{
    public $isOpen = false;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.user-management.add-user-modal', [
            'roles' => Role::all(['id', 'name']),
        ]);
    }

    public function sendToast($type, $message)
    {
        // You can customize the types and messages here
        session()->flash('toast', ['type' => $type, 'message' => $message]);
    }

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|same:password_confirmation',
        'password_confirmation' => 'required|string|min:8|same:password',
        'role' => 'required|exists:roles,id',
    ];

    public function createUser()
    {
        $this->validate();

        $user = \App\Models\User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $role = Role::findOrFail($this->role);
        $user->assignRole($role->name);

        $this->dispatch('show-success-alert', message: 'User Added successfully!');

        $this->closeModal();

        $this->reset(['name', 'email', 'password', 'password_confirmation', 'role']);

        // return redirect()->to(request()->header('Referer'));
    }
}
