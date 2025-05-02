<?php

namespace App\Http\Livewire\OffenceManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Offence;
use App\Models\License;
use App\Models\Officer;
use App\Models\Vehicle;
use App\Models\Violation;

class OffenceManagement extends Component
{
    use WithPagination;

    public $selectedStatus = '';
    public $search = '';
    public $date = '';

    protected $listeners = [
        'confirmedDelete' => 'performDelete',
        'refreshComponent' => 'refreshFilters',
    ];

    public function deleteOffence($offenceId)
    {
        $offence = Offence::find($offenceId);

        if ($offence) {
            $this->dispatch('confirm-delete', [
                'offenceId' => $offenceId,
                'message' => 'Are you sure you want to delete this offence?',
            ]);
        } else {
            $this->dispatch('show-success-alert', [
                'message' => 'Offence not found!',
                'type' => 'error',
            ]);
        }
    }

    public function performDelete($data)
    {
        $offenceId = $data['offenceId'];
        $offence = Offence::find($offenceId);
        if ($offence) {
            $offence->delete();
            $this->dispatch('show-success-alert', [
                'message' => 'Offence deleted successfully!',
                'type' => 'success',
            ]);
            $this->refresh();
        } else {
            $this->dispatch('show-success-alert', [
                'message' => 'Offence not found!',
                'type' => 'error',
            ]);
        }
    }

    public function refresh()
    {
        $this->reset(['selectedStatus', 'search', 'date']);
        $this->resetPage();
    }

    public function render()
    {
        $query = Offence::with(['license', 'officer', 'vehicle', 'violation']);

        if ($this->selectedStatus) {
            $query->where('status', $this->selectedStatus);
        }

        if ($this->search) {
            $query->where('location', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%')
                  ->orWhereHas('license', function ($q) {
                      $q->where('license_number', 'like', '%' . $this->search . '%');
                  })
                  ->orWhereHas('officer', function ($q) {
                      $q->where('name', 'like', '%' . $this->search . '%');
                  });
        }

        if ($this->date) {
            $query->whereDate('date_time', $this->date);
        }

        $offences = $query->paginate(10);
        $statuses = ['Pending', 'Warning', 'Paid', 'Court'];

        return view('livewire.offence-management.offence-management', compact('offences', 'statuses'));
    }
}