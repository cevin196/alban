<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Picture;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class JobConditionReport extends Component
{
    use WithFileUploads;

    public $conditionReportDetails = [];
    public $conditionReport;
    public $newDescription = "";
    public $newPicture;
    public $selectedConditionReport;

    public function mount()
    {
        $pictures = Picture::where('condition_report_id', $this->conditionReport->id)->get();
        foreach ($pictures as $picture) {
            $this->conditionReportDetails[] = ['id' => $picture->id, 'path' => $picture->path, 'description' => $picture->description];
        }
    }

    public function saveConditionReport()
    {
        $this->validate([
            'newPicture' => 'image',
        ]);
        $imageName =  time() . '.' . $this->newPicture->extension();
        $this->newPicture->storeAs('public/conditionReport', $imageName);
        Picture::create([
            'path' =>   $imageName,
            'description' => $this->newDescription,
            'condition_report_id' => $this->conditionReport->id,
        ]);
        notify()->success('Data added succesfully!');
        return redirect(route('conditionReport.edit', $this->conditionReport));
    }

    public function confirmConditionReportDetailDeletion($conditionReport)
    {
        $this->selectedConditionReport = Picture::find($conditionReport);
    }
    public function deleteConditionReport()
    {
        Storage::delete('public/conditionReport/' . $this->selectedConditionReport->path);
        $this->selectedConditionReport->delete();
        notify()->success('Data deleted succesfully!');
        return redirect(route('conditionReport.edit', $this->conditionReport));
    }

    public function render()
    {
        return view('livewire.admin.job-condition-report');
    }
}
