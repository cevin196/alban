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
        $alternativeModels = Alternative::all();

        // criterias
        $criteriaModels = Criteria::all();
        $criteriaDatas = collect();


        // vector S
        $vectorSes = collect();
        $vectorSTotal = 0;
        foreach ($alternativeModels as $alternative) {
            $vectorSTotal += $alternative->vectorS();
        }

        // vector V
        $vectorVs = collect();

        foreach ($alternativeModels as $index => $alternativeModel) {
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




        foreach ($criteriaModels as $index => $criteriaModel) {
            $criteriaDatas->push([
                'name' => $criteriaModel->name,
                'alias' => 'C' . $index + 1,
                'weight' => $criteriaModel->weight,
            ]);
        }

        $alternativeDatas = $alternativeDatas->sortBy('vectorV', SORT_REGULAR, $descending = true);
        $pertama  = $alternativeDatas->first();
        dd('pilihan utama adalah ' . $pertama['name']);

        // $criterias = Criteria::all();
        // $totalPreferenceWeightCount = $criterias->sum('weight');
        // $alternatives = Alternative::all();
        // $alternativeCriterias = AlternativeCriteria::all();

        // $vectorSTotal = 0;
        // foreach ($alternatives as $alternative) {
        //     $vectorSTotal += $alternative->vectorS();
        // }

        // return view('admin.jobPriority', compact(
        //     'criterias',
        //     'alternatives',
        //     'alternativeCriterias',
        //     'totalPreferenceWeightCount',
        //     'vectorSTotal'
        // ));
    }
}
