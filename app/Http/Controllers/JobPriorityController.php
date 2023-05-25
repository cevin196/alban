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

        // $count = collect();
        $alternatives = Alternative::all();

        // alternatives
        $normalAlternatives = collect();
        $specialAlternatives = collect();
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
            if (!$alternative->lateCheck()) {
                // vector S
                $vectorS = 1;

                foreach ($alternative->criterias as $alternativeCriteria) {
                    if ($alternativeCriteria->pivot->value == 0) {
                        continue;
                    }
                    $maxValue = AlternativeCriteria::where('criteria_id', $alternativeCriteria->id)->max('value');
                    $minValue = AlternativeCriteria::where([
                        ['value', '!=', 0],
                        ['criteria_id', $alternativeCriteria->id]
                    ])->min('value');

                    // vector S
                    $pangkat = $alternativeCriteria->getNormalizedWeight();
                    $vectorS *= pow($this->normalize($alternativeCriteria->pivot->value, $minValue, $maxValue, $alternativeCriteria->type), $pangkat);
                }
                $vectorSTotal += $vectorS;
            }
        }

        foreach ($alternatives as  $index => $alternative) {
            if (!$alternative->lateCheck()) {
                // vector S
                $vectorS = 1;

                // criteria data
                $criteriaDatas = collect();

                foreach ($alternative->criterias as $alternativeCriteria) {

                    if ($alternativeCriteria->pivot->value != 0) {
                        // normalization
                        $maxValue = AlternativeCriteria::where('criteria_id', $alternativeCriteria->id)->max('value');
                        $minValue = AlternativeCriteria::where([
                            ['value', '!=', 0],
                            ['criteria_id', $alternativeCriteria->id]
                        ])->min('value');

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
                        $normalizedValue = $this->normalize($alternativeCriteria->pivot->value, $minValue, $maxValue, $alternativeCriteria->type);



                        // normalize alternative value
                        $criteriaDatas->push([
                            'id' => $alternativeCriteria->id,
                            'name' => $alternativeCriteria->name,
                            'type' => $alternativeCriteria->type,
                            'value' => $alternativeCriteria->pivot->value,
                            'normalized_value' => $normalizedValue,
                            'normalized_weight' => $alternativeCriteria->getNormalizedWeight(),
                        ]);
                    } else {
                        $criteriaDatas->push([
                            'id' => $alternativeCriteria->id,
                            'name' => $alternativeCriteria->name,
                            'type' => $alternativeCriteria->type,
                            'value' => $alternativeCriteria->pivot->value,
                            'normalized_value' => 0,
                            'normalized_weight' => $alternativeCriteria->getNormalizedWeight(),
                        ]);
                    }
                }

                $vectorV =  $vectorS / $vectorSTotal;

                $normalAlternatives->push([
                    'id' => $alternative->id,
                    'name' => $alternative->name,
                    'alias' =>  $index + 1,
                    'criterias' => $criteriaDatas->toArray(),
                    'vector_s' => $vectorS,
                    'vector_v' => round($vectorV, 3),
                ]);
            } else {
                // $specialAlternativeCriteria = AlternativeCriteria::where(['alternative_id' => $alternative->id, 'criteria_id' => 5])->first();
                $specialAlternatives->push([
                    'id' => $alternative->id,
                    'name' => $alternative->name,
                    'alias' =>  $index + 1,
                    'value' => $alternative->lateValue(),
                ]);
            }
        }

        $sortedNormalAlternatives  = $normalAlternatives->sortBy('vector_v', SORT_REGULAR, $descending = true);
        $sortedSpecialAlternatives  = $specialAlternatives->sortBy('value', SORT_REGULAR, $descending = true);

        // dd($normalAlternatives);
        return view('admin.jobPriority', compact(
            'normalAlternatives',
            'specialAlternatives',
            'criterias',
            'totalPreferenceWeightCount',
            'vectorSTotal',
            'sortedNormalAlternatives',
            'sortedSpecialAlternatives'
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
}
