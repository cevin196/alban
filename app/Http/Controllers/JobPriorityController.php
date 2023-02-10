<?php

namespace App\Http\Controllers;

use App\Models\Admin\Alternative;
use App\Models\Admin\AlternativeCriteria;
use App\Models\Admin\Criteria;
use Illuminate\Http\Request;

class JobPriorityController extends Controller
{
    public function index()
    {
        $criterias = Criteria::all();
        $alternatives = Alternative::all();
        $alternativeCriterias = AlternativeCriteria::all();

        return view('admin.jobPriority', compact('criterias', 'alternatives', 'alternativeCriterias'));
    }
}
