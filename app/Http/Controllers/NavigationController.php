<?php

namespace App\Http\Controllers;

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


        for ($i = 1; $i < 7; $i++) {
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

        // $months = array_reverse($months);
        return view('dashboard', compact('jobDatas', 'months', 'financeDataIncome', 'financeDataOutcome'));
    }
}
