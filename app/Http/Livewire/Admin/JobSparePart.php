<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Job;
use Livewire\Component;

class JobSparePart extends Component
{
    public $job;
    public $jobSpareParts = [];

    public function mount()
    {
        $jobSparePartsModel = Job::find($this->job->id)->spareParts;
        foreach ($jobSparePartsModel as $jobSparePart) {
            $this->jobSpareParts[] = ['name' => $jobSparePart->name, 'qty' => $jobSparePart->qty, 'ammount' => $jobSparePart->ammount];
        }
    }

    public function addRow()
    {
        $this->jobSpareParts[] = ['name' => '', 'qty' => '1', 'ammount' => ''];
    }

    public function removeRow($index)
    {
        unset($this->jobSpareParts[$index]);
        array_values($this->jobSpareParts);
    }

    public function render()
    {
        return view('livewire.admin.job-spare-part');
    }
}
