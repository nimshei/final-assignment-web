<?php

namespace App\Http\Livewire\UserManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserManagement extends Component
{
    use WithPagination;

    public $selectedRole = '';
    public $search = '';
    public $createdDate = '';

    protected $listeners = [
        'confirmedDelete' => 'performDelete',
        'refreshComponent' => 'refreshFilters', // Consistent naming
    ];

    public function deleteUser($userId)
    {
        $user = User::find($userId);
    
        if ($user) {
            $this->dispatch('confirm-delete', [
                'userId' => $userId,
                'message' => 'Are you sure you want to delete this user?',
            ]);
        } else {
            $this->dispatch('show-success-alert', [
                'message' => 'User not found!',
                'type' => 'error',
            ]);
        }
    }
    

    public function performDelete($data)
    {
        $userId = $data['userId'];
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            $this->dispatch('show-success-alert', [
                'message' => 'User deleted successfully!',
                'type' => 'success',
            ]);
            $this->refresh();
        } else {
            $this->dispatch('show-success-alert', [
                'message' => 'User not found!',
                'type' => 'error',
            ]);
        }
    }

    public function refresh()
    {
        $this->reset(['selectedRole', 'search', 'createdDate']); // Reset only filter properties
        $this->resetPage(); // Reset pagination
    }

    public function render()
    {
        $query = User::with('roles');

        if ($this->selectedRole) {
            $query->whereHas('roles', function ($q) {
                $q->where('id', $this->selectedRole);
            });
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        if ($this->createdDate) {
            $query->whereDate('created_at', $this->createdDate);
        }

        $users = $query->paginate(10);
        $roles = Role::all();

        return view('livewire.user-management.user-management', compact('users', 'roles'));
    }
}