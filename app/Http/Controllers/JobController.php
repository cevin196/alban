<?php

namespace App\Http\Controllers;

use App\Models\admin\job;
use App\Models\User;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        return view('admin.job.index');
    }

    public function create()
    {
        $customers = User::role('customer')->get();
        return view('admin.job.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'serial_number' => 'required',
            'unit_kilometer' => 'required|integer',
            'date_in' => 'required|date',
            'customer_name' => 'required'
        ]);

        $job = Job::create([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'unit_kilometer' => $request->unit_kilometer,
            'date_in' => $request->date_in,
            'date_out' => $request->date_out,
            'customer_name' => $request->customer_name,
            'status' => $request->status,
        ]);

        notify()->success('Job created succesfully!');
        return redirect(route('job.index'));
    }

    public function show(job $job)
    {
        //
    }

    public function edit(job $job)
    {
        $customers = User::role('customer')->get();
        return view('admin.job.edit', compact('job', 'customers'));
    }

    public function update(Request $request, job $job)
    {
        //
    }

    public function destroy(job $job)
    {
        //
    }
}
