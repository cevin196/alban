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
        $criterias = Criteria::all();
        $validations = [
            'name' => 'required',
        ];
        foreach ($criterias as $criteria) {
            if ($criteria->id == 5) {
                continue;
            }
            $validations['criteria' . $criteria->id] = 'required|numeric|gt:0';
        }
        $validated = $request->validate($validations);

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
        $criterias = Criteria::all();
        $validations = [
            'name' => 'required',
        ];
        foreach ($criterias as $criteria) {
            if ($criteria->id == 5) {
                continue;
            }
            $validations['criteria' . $criteria->id] = 'required|numeric';
        }
        $validated = $request->validate($validations);

        $alternative->update([
            'name' => $request->name,
        ]);

        $alternative->criterias()->detach();
        foreach (Criteria::all() as $criteria) {
            $criteriaName = 'criteria' . $criteria->id;
            $validated = $request->validate([
                $criteriaName => 'required|numeric',
            ]);
            $alternative->criterias()->attach([$criteria->id => ['value' => $request->$criteriaName]]);
        }

        $alternative->job()->dissociate();
        $alternative->job()->associate($request->job_id);

        $alternative->update();

        notify()->success('Alternative updated succesfully!');
        return redirect(route('alternative.index'));
    }
}
