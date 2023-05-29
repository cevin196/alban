<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Job as AdminJob;
use Livewire\Component;
use Livewire\WithPagination;

class Job extends Component
{
    use WithPagination;

    // public  variable
    public $search = "";
    public $sortBy = 'id';
    public $sortAsc = true;
    public $selectedJob = null;

    public function render()
    {
        $query = AdminJob::query();

        $query->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('serial_number', 'like', '%' . $this->search . '%')
                    ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                    ->orWhere('date_in', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%');
            });
        })->orderBy('updated_at', 'desc')->get();

        $jobs = $query->paginate(10);

        return view('livewire.admin.job', [
            'jobs' => $jobs,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmJobDeletion(AdminJob $job)
    {
        $this->selectedJob = $job;
    }


    public function deleteJob()
    {

        $this->selectedJob->delete();
        $this->selectedJob = "";
        $this->resetPage();
    }
}
