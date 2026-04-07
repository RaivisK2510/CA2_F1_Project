<?php

use Illuminate\Support\Facades\Route;
use App\Models\Driver;
use App\Models\Team;
use App\Models\Circuit;
use App\Models\Season;

Route::get('/test-db', function () {
    $data = [
        'drivers' => Driver::with('raceResults')->get(),
        'teams' => Team::all(),
        'circuits' => Circuit::all(),
        'seasons' => Season::all(),
    ];

    return response()->json([
        'status' => 'Database setup successful!',
        'counts' => [
            'drivers' => $data['drivers']->count(),
            'teams' => $data['teams']->count(),
            'circuits' => $data['circuits']->count(),
            'seasons' => $data['seasons']->count(),
        ],
        'sample_driver' => [
            'name' => $data['drivers']->first()->full_name,
            'race_results_count' => $data['drivers']->first()->raceResults->count(),
        ],
        'sample_team' => [
            'name' => $data['teams']->first()->name,
            'race_results_count' => $data['teams']->first()->raceResults->count(),
        ],
    ]);
});
