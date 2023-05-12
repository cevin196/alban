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
        $months = [];

        // job done
        $jobDatas = '';

        // finance
        $financeDataIncome = '';
        $financeDataOutcome = '';


        // for ($i = 6; $i > 0; $i--) {
        //     // get months name
        //     $months[] = Carbon::now()
        //         ->startOfMonth()
        //         ->subMonth($i)
        //         ->format('F');
        // }

        for ($i = 6; $i > 0; $i--) {
            // get months name
            $months[] = Carbon::now()
                ->startOfMonth()
                ->subMonth($i)
                ->format('F');

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

        // alternatives
        $normalAlternatives = collect();
        $specialAlternatives = collect();
        $alternatives = Alternative::all();

        // criterias
        $criterias = Criteria::all();

        // alternative criterias
        $alternativeCriterias = AlternativeCriteria::all();

        // vector S
        $vectorSTotal = 0;
        foreach ($alternatives as $index => $alternative) {
            if ($alternative->lateCheck()) {
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
            if ($alternative->lateCheck()) {
                // vector S
                $vectorS = 1;

                foreach ($alternative->criterias as $alternativeCriteria) {
                    if ($alternativeCriteria->pivot->value == 0) {
                        continue;
                    }
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
                }

                $vectorV =  $vectorS / $vectorSTotal;

                $normalAlternatives->push([
                    'id' => $alternative->id,
                    'job_name' => ($alternative->job) ? $alternative->job->name : '',
                    'job_id' => $alternative->job_id,
                    'name' => $alternative->name,
                    'alias' => 'A' . $index + 1,
                    'vector_v' => round($vectorV, 3),
                ]);
            } else {
                $specialAlternativeCriteria = AlternativeCriteria::where(['alternative_id' => $alternative->id, 'criteria_id' => 5])->first();
                $specialAlternatives->push([
                    'id' => $alternative->id,
                    'job_name' => ($alternative->job) ? $alternative->job->name : '',
                    'job_id' => $alternative->job_id,
                    'name' => $alternative->name,
                    'alias' => 'A' . $index + 1,
                    'value' => $specialAlternativeCriteria->value,
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
