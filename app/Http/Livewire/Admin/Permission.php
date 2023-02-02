<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends Component
{
    use WithPagination;

    public $search = "";
    public $selectedPermission = null;

    public function render()
    {
        $query = ModelsPermission::query(10);

        $query->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%');
            });
        })->get();

        $permissions = $query->paginate(5);

        return view('livewire.admin.permission', [
            'permissions' => $permissions
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function permissionsDetail(ModelsPermission $permission)
    {
        $this->selectedPermission = $permission;
    }
}
