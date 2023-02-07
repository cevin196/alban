<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends Component
{
    use WithPagination;

    // public  variable
    public $search = "";
    public $sortBy = 'id';
    public $sortAsc = true;
    public $selectedRole = null;

    public function render()
    {
        $query = ModelsRole::query();

        $query->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%');
            });
        })->get();

        $roles = $query->paginate(10);

        return view('livewire.admin.role', [
            'roles' => $roles,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmRoleDeletion(ModelsRole $criteria)
    {
        $this->selectedRole = $criteria;
    }


    public function deleteRole()
    {

        $this->selectedRole->delete();
        $this->selectedRole = "";
        $this->resetPage();
    }
}
