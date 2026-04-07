<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Team;
use App\Models\Circuit;
use App\Models\Season;

class F1Controller extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_drivers' => Driver::count(),
            'total_teams' => Team::count(),
            'total_circuits' => Circuit::count(),
            'total_seasons' => Season::count(),
            'active_seasons' => Season::where('is_active', true)->count(),
        ];

        $latestDrivers = Driver::active()->orderBy('created_at', 'desc')->take(5)->get();
        $latestTeams = Team::active()->orderBy('created_at', 'desc')->take(5)->get();

        return view('f1.dashboard', compact('stats', 'latestDrivers', 'latestTeams'));
    }

    public function drivers()
    {
        $drivers = Driver::with('raceResults')->active()->get();
        return view('f1.drivers', compact('drivers'));
    }

    public function teams()
    {
        $teams = Team::with('raceResults')->active()->get();
        return view('f1.teams', compact('teams'));
    }

    public function circuits()
    {
        $circuits = Circuit::active()->get();
        return view('f1.circuits', compact('circuits'));
    }

    public function seasons()
    {
        $seasons = Season::with(['championDriver', 'championTeam'])->get();
        return view('f1.seasons', compact('seasons'));
    }
}
