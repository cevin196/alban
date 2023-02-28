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

        // alternatives
        $alternativeDatas = collect();
        $alternatives = Alternative::all();

        // criterias
        $criterias = Criteria::all();
        $criteriaDatas = collect();
        $totalPreferenceWeightCount = $criterias->sum('weight');

        // alternative criterias
        $alternativeCriterias = AlternativeCriteria::all();

        // vector S
        $vectorSes = collect();
        $vectorSTotal = 0;
        foreach ($alternatives as $alternative) {
            $vectorSTotal += $alternative->vectorS();
        }

        // vector V
        $vectorVs = collect();

        foreach ($alternatives as $index => $alternativeModel) {
            $vectorS = $alternativeModel->vectorS();
            $vectorV = $vectorS / $vectorSTotal;

            $alternativeDatas->push([
                'name' => $alternativeModel->name,
                'alias' => 'A' . $index + 1,
                'alternativeCriterias' => $alternativeModel->criterias,
                'vectorS' => round($vectorS, 3),
                'totalVS' => $vectorSTotal,
                'vectorV' => round($vectorV, 3),
            ]);
        }




        foreach ($criterias as $index => $criteriaModel) {
            $criteriaDatas->push([
                'name' => $criteriaModel->name,
                'alias' => 'C' . $index + 1,
                'weight' => $criteriaModel->weight,
            ]);
        }

        $alternativeDatas = $alternativeDatas->sortBy('vectorV', SORT_REGULAR, $descending = true);
        $pertama  = $alternativeDatas->first();

        // $criterias = Criteria::all();

        // $alternatives = Alternative::all();


        // $vectorSTotal = 0;
        // foreach ($alternatives as $alternative) {
        //     $vectorSTotal += $alternative->vectorS();
        // }

        return view('admin.jobPriority', compact(
            'criterias',
            'alternatives',
            'alternativeCriterias',
            'totalPreferenceWeightCount',
            'vectorSTotal',
            'alternativeDatas'
        ));
    }
}
