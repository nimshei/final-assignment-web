<?php

namespace App\Http\Livewire\ViolationManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Violation;

class ViolationManagement extends Component
{
    use WithPagination;

    public $selectedStatus = '';
    public $search = '';

    protected $listeners = [
        'confirmedDelete' => 'performDelete',
        'refreshComponent' => 'refreshFilters',
    ];

    public function deleteViolation($violationId)
    {
        $violation = Violation::find($violationId);

        if ($violation) {
            $this->dispatch('confirm-delete', [
                'violationId' => $violationId,
                'message' => 'Are you sure you want to delete this violation?',
            ]);
        } else {
            $this->dispatch('show-success-alert', [
                'message' => 'Violation not found!',
                'type' => 'error',
            ]);
        }
    }

    public function performDelete($data)
    {
        $violationId = $data['violationId'];
        $violation = Violation::find($violationId);

        if ($violation) {
            $violation->delete();
            $this->dispatch('show-success-alert', [
                'message' => 'Violation deleted successfully!',
                'type' => 'success',
            ]);
            $this->refresh();
        } else {
            $this->dispatch('show-success-alert', [
                'message' => 'Violation not found!',
                'type' => 'error',
            ]);
        }
    }

    public function refresh()
    {
        $this->reset(['selectedStatus', 'search']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Violation::query();

        if ($this->selectedStatus) {
            $query->where('status', $this->selectedStatus);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('violation_code', 'like', '%' . $this->search . '%')
                  ->orWhere('violation_name', 'like', '%' . $this->search . '%');
            });
        }

        $violations = $query->paginate(10);

        return view('livewire.violation-management.violation-management', compact('violations'));
    }
}
