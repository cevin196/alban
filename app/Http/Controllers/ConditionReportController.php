<?php

namespace App\Http\Controllers;

use App\Models\Admin\ConditionReport;
use App\Models\Admin\Job;
use App\Models\Admin\Picture;
use Illuminate\Http\Request;

class ConditionReportController extends Controller
{
    public function store(Request $request)
    {
        dd($request);
        $validated = $request->validate([
            'name' => 'required',
            'weight' => 'required|integer|between:1,5',
            'unit' => 'required|string|max:100',
        ]);

        ConditionReport::create([
            'name' => $request->name,
            'date' => $request->date
        ]);
    }

    public function edit(ConditionReport $conditionReport)
    {

        return view('admin.conditionReport.edit', compact('conditionReport'));
    }

    public function print(ConditionReport $conditionReport)
    {
        $job = Job::find($conditionReport->job_id);
        $pictures = Picture::where('condition_report_id', $conditionReport->id)->get();

        return view('admin.conditionReport.print', compact('conditionReport', 'job', 'pictures'));
    }
}
