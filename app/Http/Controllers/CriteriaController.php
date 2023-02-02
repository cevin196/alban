<?php

namespace App\Http\Controllers;

use App\Models\Admin\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function index()
    {
        return view('admin.criteria.index');
    }

    public function create()
    {
        return view('admin.criteria.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'weight' => 'required|integer|between:1,5'
        ]);

        $criteria = Criteria::create([
            'name' => $request->name,
            'weight' => $request->weight,
            'type' => $request->type,
        ]);

        notify()->success('Criteria created succesfully!');
        return redirect(route('criteria.index'));
    }

    public function show($id)
    {
        // dd(Criteria::find($id));
    }

    public function edit($id)
    {
        $criteria = Criteria::find($id);
        return view('admin.criteria.edit', compact('criteria'));
    }

    public function update(Request $request, $id)
    {
        $criteria = Criteria::find($id);
        $validated = $request->validate([
            'name' => 'required',
            'weight' => 'required|integer|between:1,5'
        ]);

        $criteria->update([
            'name' => $request->name,
            'weight' => $request->weight,
            'type' => $request->type,
        ]);

        notify()->success('Criteria updated succesfully!');
        return redirect(route('criteria.index'));
    }

    public function destroy(Criteria $criteria)
    {
        //
    }
}
