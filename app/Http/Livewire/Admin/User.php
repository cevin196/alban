<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User as userModel;
use Livewire\WithPagination;

class User extends Component
{
    use WithPagination;

    // public  variable
    public $search = "";
    public $sortBy = 'id';
    public $sortAsc = true;
    public $selectedUser = null;

    // protected $queryString = [
    //     'search' => ['except' => ''],
    //     'active' => ['except' => false],
    //     'sortBy' => ['except' => 'id'],
    //     'sortAsc' => ['except' => true],
    // ];

    // protected $rules = [
    //     'user.name' => 'required|string|min:4',
    //     'user.price' => 'required|numeric|between:1,100',
    //     'user.status' => 'boolean',
    // ];


    public function render()
    {
        $query = userModel::query();

        $query->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
        })->get();

        $users = $query->paginate(10);
        return view('livewire.user', [
            'users' => $users,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmUserDeletion(UserModel $user)
    {
        $this->selectedUser = $user;
    }

    public function deleteUser()
    {
        $this->selectedUser->delete();
        $this->selectedUser = "";
    }
}
