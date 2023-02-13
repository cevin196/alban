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
        $totalPreferenceWeightCount = $criterias->sum('weight');
        $alternatives = Alternative::all();
        $alternativeCriterias = AlternativeCriteria::all();

        $vectorSTotal = 0;
        foreach ($alternatives as $alternative) {
            $vectorSTotal += $alternative->vectorS();
        }

        return view('admin.jobPriority', compact(
            'criterias',
            'alternatives',
            'alternativeCriterias',
            'totalPreferenceWeightCount',
            'vectorSTotal'
        ));
    }
}
