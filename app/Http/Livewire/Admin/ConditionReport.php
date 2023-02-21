<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\ConditionReport as AdminConditionReport;
use Livewire\Component;

class ConditionReport extends Component
{
    public $job;
    public $selectedConditionReport = null;

    public function confirmJobDeletion(AdminConditionReport $conditionReport)
    {
        $this->selectedConditionReport = $conditionReport;
    }


    public function deleteJob()
    {

        $this->selectedConditionReport->delete();
        $this->selectedConditionReport = "";
        notify()->success('Condition report deleted succesfully!');
        return redirect(route('job.edit', $this->job));
    }

    public function render()
    {
        return view('livewire.admin.condition-report');
    }
}
