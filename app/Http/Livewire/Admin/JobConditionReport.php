<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Picture;
use Livewire\Component;
use Livewire\WithFileUploads;

class JobConditionReport extends Component
{
    use WithFileUploads;

    public $conditionReportPictures = [];
    public $conditionReport;
    public $newDescription = "";
    public $newPicture = "";

    public function mount()
    {
        $pictures = Picture::where('condition_report_id', $this->conditionReport->id)->get();
        foreach ($pictures as $picture) {
            $this->conditionReportPictures[] = ['path' => $picture->path, 'description' => $picture->qty];
        }
    }

    public function updatedNewPicture()
    {
        // dd($this->newPicture);
        // $this->photo->storeAs('photos');
    }

    public function updatedNewDescription()
    {
        dd($this->newDescription);
    }

    public function addRow()
    {
        // $this->jobServices[] = ['name' => '', 'qty' => '1', 'ammount' => ''];
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024',
        ]);
    }

    public function save()
    {
        // ...
    }

    public function render()
    {
        return view('livewire.admin.job-condition-report');
    }
}
