<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Alternative as AdminAlternative;
use Livewire\Component;
use Livewire\WithPagination;

class Alternative extends Component
{
    use WithPagination;

    // public  variable
    public $search = "";
    public $sortBy = 'id';
    public $sortAsc = true;
    public $selectedAlternative = null;

    public function render()
    {
        $query = AdminAlternative::query();

        $query->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%');
            });
        })->get();

        $alternatives = $query->paginate(10);

        return view('livewire.admin.alternative', [
            'alternatives' => $alternatives,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmAlternativeDeletion(AdminAlternative $alternative)
    {
        $this->selectedAlternative = $alternative;
    }


    public function deleteAlternative()
    {

        $this->selectedAlternative->delete();
        $this->selectedAlternative = "";
    }
}
