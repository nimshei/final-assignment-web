<?php

namespace App\Http\Livewire\UserManagement;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UpdateUserModal extends Component
{
    public $isOpen = false;
    public $userId;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $role;

    // Define the listener explicitly
    protected $listeners = ['openUpdateUserModal' => 'openUpdateModal'];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'password' => 'nullable|string|min:8|same:password_confirmation',
        'password_confirmation' => 'nullable|string|min:8|same:password',
        'role' => 'required|exists:roles,id',
    ];

    public function openUpdateModal($userId)
    {
        $this->isOpen = true;
        $this->loadUser($userId);
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->reset(['userId', 'name', 'email', 'password', 'password_confirmation', 'role']);
    }

    public function loadUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->first()->id ?? null;
    }

    public function updateUser()
    {
        $this->rules['email'] = 'required|email|unique:users,email,' . $this->userId;
        $this->validate();

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : $user->password,
        ]);

        $role = Role::findOrFail($this->role);
        $user->syncRoles([$role->name]);

        $this->dispatch('show-success-alert', message: 'User updated successfully!');

        $this->closeModal();
        
        // return redirect()->to(request()->header('Referer'));
    }

    public function render()
    {
        return view('livewire.user-management.update-user-modal', [
            'roles' => Role::all(['id', 'name']),
        ]);
    }
}