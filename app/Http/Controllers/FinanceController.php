<?php

namespace App\Http\Controllers;

use App\Models\Admin\Finance;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index()
    {
        return view('admin.finance.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Finance $finance)
    {
        //
    }

    public function edit(Finance $finance)
    {
        //
    }

    public function update(Request $request, Finance $finance)
    {
        //
    }
}
