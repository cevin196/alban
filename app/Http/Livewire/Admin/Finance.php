<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin\Finance as FinanceModel;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Finance extends Component
{
    use WithPagination;

    // public  variable
    public $search = "";
    public $sortBy = 'id';
    public $sortAsc = true;
    public $selectedFinance = null;

    // create data
    public $inputDescription = "";
    public $inputAmmount = "";
    public $inputType = "";
    public $inputDate = "";

    // validation
    protected $rules = [
        'inputDescription' => 'required',
        'inputAmmount' => 'required|numeric',
        'inputType' => 'required',
        'inputDate' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $query = FinanceModel::query();

        $query->when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query
                    ->where('description', 'like', '%' . $this->search . '%')
                    ->orWhere('type', 'like', '%' . $this->search . '%')
                    ->orWhere('date', 'like', '%' . $this->search . '%');
            });
        })->orderBy('date', 'desc')->get();

        $finances = $query->paginate(10);

        return view('livewire.admin.finance', [
            'finances' => $finances,
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmJobDeletion(FinanceModel $finance)
    {
        $this->selectedFinance = $finance;
    }

    public function confirmFinanceEdit(FinanceModel $finance)
    {
        $this->selectedFinance = $finance;
        $this->inputDescription = $finance->description;
        $this->inputAmmount = $finance->ammount;
        $this->inputType = $finance->type;
        $this->inputDate = $finance->date;
    }

    public function saveFinance()
    {
        $validatedData = $this->validate();
        FinanceModel::create([
            'description' => $validatedData['inputDescription'],
            'ammount' => $validatedData['inputAmmount'],
            'type' => $validatedData['inputType'],
            'date' => $validatedData['inputDate'],
        ]);
        notify()->success('Data keuangan berhasil ditambahkan!');
        return redirect(route('finance.index'));
    }

    public function updateFinance()
    {
        $validatedData = $this->validate();
        $this->selectedFinance->update([
            'description' => $validatedData['inputDescription'],
            'ammount' => $validatedData['inputAmmount'],
            'type' => $validatedData['inputType'],
            'date' => $validatedData['inputDate'],
        ]);
        notify()->success('Data keuangan berhasil diupdate!');
        return redirect(route('finance.index'));
    }

    public function deleteJob()
    {
        $this->selectedFinance->delete();
        $this->selectedFinance = "";
        notify()->success('Data keuangan berhasil dihapus!');
        return redirect(route('finance.index'));
    }
}
