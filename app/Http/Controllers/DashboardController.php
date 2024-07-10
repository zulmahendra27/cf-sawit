<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $results = DB::select("SELECT" .
            "(SELECT COUNT(id) FROM diseases) as count_disease," .
            "(SELECT COUNT(id) FROM symptoms) as count_symptom," .
            "(SELECT COUNT(id) FROM consultations) as count_consultation")[0];

        $counts = [
            'count_disease' => $results->count_disease,
            'count_symptom' => $results->count_symptom,
            'count_consultation' => $results->count_consultation,
        ];

        return view('main', [
            'title' => 'Dashboard',
            'counts' => collect($counts)
        ]);
    }
}
