<?php

namespace App\Http\Controllers;

use App\Models\Admin\Alternative;
use App\Models\Admin\AlternativeCriteria;
use App\Models\Admin\Criteria;
use App\Models\Admin\Finance;
use App\Models\Admin\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function dashboard()
    {
        $this->authorize('user_access');
        $months = [];

        // job done
        $jobDatas = '';

        // finance
        $financeDataIncome = '';
        $financeDataOutcome = '';

        // job status
        $jobStatus = '';
        $statuses = ['Doing', 'To Do', 'Cancelled'];
        foreach ($statuses as $status) {
            $jobStatus .= Job::where('status', $status)->whereBetween('date_in', [
                Carbon::now()
                    ->startOfMonth()
                    ->subMonth(4),
                Carbon::now()
                    ->startOfMonth()
                    ->subMonth(3),
            ])->count() . ', ';
        }

        for ($i = 6; $i > 0; $i--) {
            // get months name
            $months[] = Carbon::now()
                ->startOfMonth()
                ->subMonth($i)
                ->translatedFormat('F');

            // get job done
            $jobDatas .=
                Job::whereBetween('date_in', [
                    Carbon::now()
                        ->startOfMonth()
                        ->subMonth($i),
                    Carbon::now()
                        ->startOfMonth()
                        ->subMonth($i - 1),
                ])
                ->where('status', 'Done')
                ->orderBy('date_in')
                ->count() . ', ';

            // income
            $financeDataIncome .= Finance::whereBetween('date', [
                Carbon::now()->startOfMonth()->subMonth($i),
                Carbon::now()->startOfMonth()->subMonth($i - 1)
            ])
                ->where('type', 0)
                ->sum('ammount') . ', ';

            // outcome
            $financeDataOutcome .= Finance::whereBetween('date', [
                Carbon::now()->startOfMonth()->subMonth($i),
                Carbon::now()->startOfMonth()->subMonth($i - 1)
            ])
                ->where('type', 1)
                ->sum('ammount') . ', ';
        }


        // job priority

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


        // $months = array_reverse($months);
        return view('dashboard', compact(
            'jobDatas',
            'months',
            'financeDataIncome',
            'financeDataOutcome',
            'sortedNormalAlternatives',
            'sortedSpecialAlternatives',
            'jobStatus'
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

    public function monitoring()
    {
        $jobs = Job::orderBy('updated_at', 'desc')->take(10)->get();
        return view('user.monitoring', compact('jobs'));
    }
}
