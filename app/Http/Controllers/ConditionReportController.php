<?php

namespace App\Http\Controllers;

use App\Models\Admin\ConditionReport;
use Illuminate\Http\Request;

class ConditionReportController extends Controller
{
    public function create($jobId)
    {
        return view('admin.conditionReport.create', compact('jobId'));
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(ConditionReport $conditionReport)
    {
        //
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
