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
        // $criteriaDatas = collect();
        $totalPreferenceWeightCount = $criterias->sum('weight');

        // alternative criterias
        $alternativeCriterias = AlternativeCriteria::all();


        // // vector S
        $vectorSTotal = 0;
        foreach ($alternatives as $index => $alternative) {
            // vector S
            $vectorS = 1;

            foreach ($alternative->criterias as $alternativeCriteria) {
                $maxValue = AlternativeCriteria::where('criteria_id', $alternativeCriteria->id)->max('value');
                $minValue = AlternativeCriteria::where('criteria_id', $alternativeCriteria->id)->min('value');

                // vector S
                $pangkat = $alternativeCriteria->getNormalizedWeight();
                $vectorS *= pow($this->normalize($alternativeCriteria->pivot->value, $minValue, $maxValue, $alternativeCriteria->type), $pangkat);
            }
            $vectorSTotal += $vectorS;
        }

        foreach ($alternatives as  $index => $alternative) {
            // vector S
            $vectorS = 1;

            // criteria data
            $criteriaDatas = collect();

            foreach ($alternative->criterias as $alternativeCriteria) {
                // normalization
                $maxValue = AlternativeCriteria::where('criteria_id', $alternativeCriteria->id)->max('value');
                $minValue = AlternativeCriteria::where('criteria_id', $alternativeCriteria->id)->min('value');

                // vector S
                $pangkat = $alternativeCriteria->getNormalizedWeight();
                $vectorS *= pow(
                    $this->normalize(
                        $alternativeCriteria->pivot->value,
                        $minValue,
                        $maxValue,
                        $alternativeCriteria->type
                    ),
                    $pangkat
                );

                // normalize alternative value
                $criteriaDatas->push([
                    'name' => $alternativeCriteria->name,
                    'type' => $alternativeCriteria->type,
                    'value' => $alternativeCriteria->pivot->value,
                    'normalized_value' => $this->normalize($alternativeCriteria->pivot->value, $minValue, $maxValue, $alternativeCriteria->type),
                    'normalized_weight' => $alternativeCriteria->getNormalizedWeight(),
                ]);
            }

            $vectorV =  $vectorS / $vectorSTotal;

            $alternativeDatas->push([
                'name' => $alternative->name,
                'alias' => 'A' . $index + 1,
                'criterias' => $criteriaDatas->toArray(),
                'vector_s' => $vectorS,
                'vector_v' => round($vectorV, 3),
            ]);
        }


        // dd($alternativeDatas);
        // $alternativeDatas = $alternativeDatas->sortBy('vectorV', SORT_REGULAR, $descending = true);
        $sortedAlternatives  = $alternativeDatas->sortBy('vector_v', SORT_REGULAR, $descending = true);

        return view('admin.jobPriority', compact(
            'alternativeDatas',
            'criterias',
            // 'alternatives',
            // 'alternativeCriterias',
            'totalPreferenceWeightCount',
            'vectorSTotal',
            'sortedAlternatives'
        ));
    }

    function normalize($value, $min, $max,  $type)
    {
        $hasil = 1;
        if ($type == "Benefit") {
            $hasil = $value / $max;
        } elseif ($type == "Cost") {
            $hasil = $min / $value;
        } else {
            dd($type);
        }

        return $hasil;
    }

    public function vectorS($criterias)
    {
    }
}
