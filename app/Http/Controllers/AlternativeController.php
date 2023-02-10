<?php

namespace App\Http\Controllers;

use App\Models\admin\Alternative;
use App\Models\Admin\AlternativeCriteria;
use App\Models\Admin\Criteria;
use App\Models\Admin\Job;
use Illuminate\Http\Request;

class AlternativeController extends Controller
{
    public function index()
    {
        return view('admin.alternative.index');
    }

    public function create()
    {
        $jobs = Job::all();
        $criterias = Criteria::all();
        return view('admin.alternative.create', compact('jobs', 'criterias'));
    }

    public function store(Request $request)
    {

        // dd((new Criteria)->totalPreferenceWeightCount());

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $alternative = Alternative::create([
            'name' => $request->name,
        ]);

        foreach (Criteria::all() as $criteria) {
            $name = 'criteria' . $criteria->id;
            $alternative->criterias()->attach([$criteria->id => ['value' => $request->$name]]);
        }

        if ($request->job_id) {
            $alternative->job_id = $request->job_id;
            $alternative->update();
        }

        notify()->success('Alternative created succesfully!');
        return redirect(route('alternative.index'));
    }

    public function show(Alternative $alternative)
    {
        return view('admin.alternative.show', compact('alternative'));
    }

    public function edit(Alternative $alternative)
    {

        // dd(AlternativeCriteria::where([
        //     'alternative_id' => 6, 'criteria_id' => 1
        // ])->first());
        $criterias = Criteria::all();
        $jobs = Job::all();
        return view('admin.alternative.edit', compact('alternative', 'jobs', 'criterias'));
    }

    public function update(Request $request, Alternative $alternative)
    {

        $validated = $request->validate([
            'name' => 'required',
        ]);

        $alternative->update([
            'name' => $request->name,
        ]);

        $alternative->criterias()->detach();
        foreach (Criteria::all() as $criteria) {
            $criteriaName = 'criteria' . $criteria->id;
            $alternative->criterias()->attach([$criteria->id => ['value' => $request->$criteriaName]]);
        }

        if ($request->job_id) {
            $alternative->job_id = $request->job_id;
            // $alternative->update();
        }

        $alternative->update();

        notify()->success('Alternative updated succesfully!');
        return redirect(route('alternative.index'));
    }
}
