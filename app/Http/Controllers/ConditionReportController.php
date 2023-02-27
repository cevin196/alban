<?php

namespace App\Http\Controllers;

use App\Models\Admin\ConditionReport;
use Illuminate\Http\Request;

class ConditionReportController extends Controller
{
    public function create($jobId)
    {
    }

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

    public function update(Request $request, ConditionReport $conditionReport)
    {
        //
    }

    public function destroy(ConditionReport $conditionReport)
    {
        //
    }
}
