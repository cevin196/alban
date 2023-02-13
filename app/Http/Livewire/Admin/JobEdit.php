<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class JobEdit extends Component
{
    public $job;
    public function render()
    {
        return view('livewire.admin.job-edit', [
            'job' => $this->job,
        ]);
    }
}
