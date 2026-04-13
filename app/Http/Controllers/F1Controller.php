<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Team;
use App\Models\Circuit;
use App\Models\Season;
use App\Models\Race;
use Illuminate\Http\Request;

class F1Controller extends Controller
{
    public function dashboard()
    {
        $stats = [
            "total_drivers" => Driver::count(),
            "total_teams" => Team::count(),
            "total_circuits" => Circuit::count(),
            "total_seasons" => Season::count(),
            "total_races" => Race::count(),
            "active_seasons" => Season::where("is_active", true)->count(),
        ];

        $latestDrivers = Driver::active()
            ->orderBy("created_at", "desc")
            ->take(5)
            ->get();
        $latestTeams = Team::active()
            ->orderBy("created_at", "desc")
            ->take(5)
            ->get();

        return view(
            "f1.dashboard",
            compact("stats", "latestDrivers", "latestTeams"),
        );
    }

    public function drivers(Request $request)
    {
        // Base query: active drivers with their race results eager loaded
        $query = Driver::with("raceResults")->active();

        // Search: match first_name, last_name (or their concatenation), code, or nationality
        if ($request->filled("q")) {
            $q = $request->q;
            $query->where(function ($w) use ($q) {
                $w->where("first_name", "like", "%{$q}%")
                    ->orWhere("last_name", "like", "%{$q}%")
                    ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", [
                        "%{$q}%",
                    ])
                    ->orWhere("code", "like", "%{$q}%")
                    ->orWhere("nationality", "like", "%{$q}%");
            });
        }

        // Sorting: map logical keys to actual DB columns (name handled specially)
        $allowedSorts = [
            "name" => "name", // handled below (orders by last_name, first_name)
            "wins" => "wins",
            "points" => "career_points",
            "championships" => "world_championships",
            "number" => "driver_number",
        ];

        $sortKey = $request->get("sort", "name");
        $dir = strtolower($request->get("dir", ""));

        // Default directions: numeric fields default to desc, names default to asc
        if (!in_array($dir, ["asc", "desc"])) {
            $dir = in_array($sortKey, ["wins", "points", "championships"])
                ? "desc"
                : "asc";
        }

        // Apply sorting: if sorting by name, order by last_name then first_name
        if ($sortKey === "name") {
            $drivers = $query
                ->orderBy("last_name", $dir)
                ->orderBy("first_name", $dir)
                ->get();
        } else {
            $sortColumn = $allowedSorts[$sortKey] ?? "last_name";
            $drivers = $query->orderBy($sortColumn, $dir)->get();
        }

        // Pass current filters back to the view so the UI can reflect them
        $filters = $request->only(["q", "sort", "dir"]);

        return view("f1.drivers", compact("drivers", "filters"));
    }

    public function driverShow(Driver $driver)
    {
        $driver->load(["team", "raceResults.race.season", "raceResults.team"]);

        $stats = [
            "total_races" => $driver->raceResults()->count(),
            "wins" => $driver->raceResults()->where("position", 1)->count(),
            "podiums" => $driver
                ->raceResults()
                ->whereIn("position", [1, 2, 3])
                ->count(),
            "points" => $driver->raceResults()->sum("points"),
            "fastest_laps" => $driver
                ->raceResults()
                ->where("fastest_lap", 1)
                ->count(),
        ];

        return view("f1.driver", compact("driver", "stats"));
    }

    public function teams()
    {
        $teams = Team::with("raceResults")->active()->get();
        return view("f1.teams", compact("teams"));
    }

    public function teamShow(Team $team)
    {
        $team->load([
            "drivers" => function ($query) {
                $query->where("is_active", true);
            },
            "raceResults.race.season",
            "raceResults.driver",
        ]);

        $stats = [
            "total_races" => $team->raceResults()->count(),
            "wins" => $team->raceResults()->where("position", 1)->count(),
            "podiums" => $team
                ->raceResults()
                ->whereIn("position", [1, 2, 3])
                ->count(),
            "points" => $team->raceResults()->sum("points"),
            "fastest_laps" => $team
                ->raceResults()
                ->where("fastest_lap", 1)
                ->count(),
            "drivers_count" => $team
                ->drivers()
                ->where("is_active", true)
                ->count(),
        ];

        return view("f1.team", compact("team", "stats"));
    }

    public function circuits()
    {
        $circuits = Circuit::active()->get();
        return view("f1.circuits", compact("circuits"));
    }

    public function circuitShow(Circuit $circuit)
    {
        $circuit->load([
            "races.season",
            "races.raceResults.driver",
            "races.raceResults.team",
        ]);

        $stats = [
            "total_races" => $circuit->races()->count(),
            "completed_races" => $circuit
                ->races()
                ->where("is_completed", true)
                ->count(),
        ];

        return view("f1.circuit", compact("circuit", "stats"));
    }

    public function seasons()
    {
        $seasons = Season::with(["championDriver", "championTeam"])->get();
        return view("f1.seasons", compact("seasons"));
    }

    public function seasonShow(Season $season)
    {
        $season->load([
            "races.circuit",
            "races.raceResults.driver",
            "races.raceResults.team",
            "championDriver",
            "championTeam",
        ]);

        $stats = [
            "total_races" => $season->races()->count(),
            "completed_races" => $season
                ->races()
                ->where("is_completed", true)
                ->count(),
            "completion_pct" => $season->completion_percentage,
        ];

        return view("f1.season", compact("season", "stats"));
    }

    public function races()
    {
        $races = Race::with([
            "season",
            "circuit",
            "raceResults.driver",
            "raceResults.team",
        ])
            ->orderByDesc("race_date")
            ->get();

        return view("f1.races", compact("races"));
    }

    public function raceShow(Race $race)
    {
        $race->load([
            "season",
            "circuit",
            "raceResults.driver.team",
            "raceResults.team",
            "fastestLapDriver",
            "polePositionDriver",
        ]);

        return view("f1.race", compact("race"));
    }
}
