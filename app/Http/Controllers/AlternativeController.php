<?php

namespace App\Http\Controllers;

use App\Models\admin\Alternative;
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
        return view('admin.alternative.create', compact('jobs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $alternative = Alternative::create([
            'name' => $request->name,
        ]);

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
        $jobs = Job::all();
        return view('admin.alternative.edit', compact('alternative', 'jobs'));
    }

    public function update(Request $request, Alternative $alternative)
    {
        $validated = $request->validate([
            'name' => 'required',
        ]);

        $alternative->update([
            'name' => $request->name,
        ]);


        if ($request->job_id) {
            $alternative->job_id = $request->job_id;
            $alternative->update();
        }

        notify()->success('Alternative updated succesfully!');
        return redirect(route('alternative.index'));
    }
}
