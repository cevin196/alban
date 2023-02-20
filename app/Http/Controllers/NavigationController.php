<?php

namespace App\Http\Controllers;

use App\Models\Admin\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function dashboard()
    {
        $jobs = Job::select()
            ->whereBetween('date_in', [Carbon::now()->subMonth(6), Carbon::now()])
            ->where('status', 'Done')
            ->orderBy('date_in')
            ->get();
        return view('dashboard', compact('jobs'));
    }
}
