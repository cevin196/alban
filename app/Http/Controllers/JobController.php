<?php

namespace App\Http\Controllers;

use App\Models\admin\job;
use App\Models\Admin\Service;
use App\Models\Admin\SparePart;
use App\Models\User;
use Carbon\Carbon;
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
            'work_estimation' => 'required|integer|gt:0',
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
            'work_estimation' => 'required|integer|gt:0',
        ]);

        notify()->success('Job created succesfully!');
        return redirect(route('job.index'));
    }

    public function show(job $job)
    {
        return view('admin.job.show', compact('job'));
    }

    public function edit(job $job)
    {
        $customers = User::role('customer')->get();
        return view('admin.job.edit', compact('job', 'customers'));
    }

    public function update(Request $request, job $job)
    {
        $validated = $request->validate([
            'name' => 'required',
            'serial_number' => 'required',
            'unit_kilometer' => 'required|integer',
            'date_in' => 'required|date',
            'work_estimation' => 'required|integer|gt:0',
            'customer_name' => 'required'
        ]);

        ($request->date_out) ? $status = 'Done' : $status = $request->status;

        $job->update([
            'name' => $request->name,
            'serial_number' => $request->serial_number,
            'unit_kilometer' => $request->unit_kilometer,
            'date_in' => $request->date_in,
            'date_out' => $request->date_out,
            'work_estimation' => $request->work_estimation,
            'customer_name' => $request->customer_name,
            'status' => $status,
        ]);

        if ($request->jobServices) {
            $job->services()->delete();
            foreach ($request->jobServices as $jobService) {
                Service::create([
                    'name' => $jobService['name'],
                    'qty' => $jobService['qty'],
                    'ammount' => (float)  $jobService['ammount'],
                    'job_id' => $job->id,
                ]);
            }
        }

        if ($request->jobSpareParts) {
            $job->spareParts()->delete();
            foreach ($request->jobSpareParts as $jobSparePart) {
                SparePart::create([
                    'name' => $jobSparePart['name'],
                    'qty' => $jobSparePart['qty'],
                    'ammount' => (float)  $jobSparePart['ammount'],
                    'job_id' => $job->id,
                ]);
            }
        }
        notify()->success('Job updated succesfully!');
        return redirect(route('job.index'));
    }

    public function print(Job $job)
    {
        return view('admin.job.print', compact('job'));
    }
}
