<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Criteria as AdminCriteria;
use Livewire\Component;
use Livewire\WithPagination;

class Criteria extends Component
{
    use WithPagination;

    // public  variable
    public $search = "";
    public $sortBy = 'id';
    public $sortAsc = true;
    public $selectedCriteria = null;

    public function render()
    {
        $query = AdminCriteria::query();

        $query->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%');
            });
        })->get();

        $criterias = $query->paginate(10);

        return view('livewire.admin.criteria', [
            'criterias' => $criterias,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmCriteriaDeletion(AdminCriteria $criteria)
    {
        $this->selectedCriteria = $criteria;
    }


    public function deleteCriteria()
    {

        $this->selectedCriteria->delete();
        $this->selectedCriteria = "";
        $this->resetPage();
    }
}
