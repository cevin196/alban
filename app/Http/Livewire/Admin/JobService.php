<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Job;
use App\Models\Admin\Service;
use Livewire\Component;

class JobService extends Component
{
    public $job;
    public $jobServices = [];

    public function mount()
    {
        $jobServicesModel = Job::find($this->job->id)->services;
        foreach ($jobServicesModel as $jobService) {
            $this->jobServices[] = ['name' => $jobService->name, 'qty' => $jobService->qty, 'ammount' => $jobService->ammount];
        }
    }

    public function addRow()
    {
        $this->jobServices[] = ['name' => '', 'qty' => '1', 'ammount' => ''];
    }

    public function removeRow($index)
    {
        unset($this->jobServices[$index]);
        array_values($this->jobServices);
    }

    public function render()
    {
        return view('livewire.admin.job-service');
    }
}
