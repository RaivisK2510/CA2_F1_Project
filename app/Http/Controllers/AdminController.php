<?php

namespace App\Http\Controllers;

use App\Models\Circuit;
use App\Models\Driver;
use App\Models\Race;
use App\Models\RaceResult;
use App\Models\Season;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth", "admin"]);
    }

    public function index()
    {
        $counts = [
            "users" => User::count(),
            "drivers" => Driver::count(),
            "teams" => Team::count(),
            "circuits" => Circuit::count(),
            "races" => Race::count(),
            "seasons" => Season::count(),
            "results" => RaceResult::count(),
        ];

        return view("admin.index", compact("counts"));
    }

    public function users()
    {
        $users = User::orderBy("created_at", "desc")->paginate(15);

        return view("admin.users", compact("users"));
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()
                ->route("admin.users.index")
                ->with("error", "You cannot delete your own admin account.");
        }

        $user->delete();

        return redirect()
            ->route("admin.users.index")
            ->with("success", "User removed successfully.");
    }

    // F1 Dashboard
    public function f1Dashboard()
    {
        $stats = [
            "total_drivers" => Driver::count(),
            "total_teams" => Team::count(),
            "total_circuits" => Circuit::count(),
            "total_seasons" => Season::count(),
            "total_races" => Race::count(),
            "total_results" => RaceResult::count(),
        ];

        $latestDrivers = Driver::orderBy("created_at", "desc")->take(5)->get();
        $latestTeams = Team::orderBy("created_at", "desc")->take(5)->get();

        return view(
            "admin.f1.dashboard",
            compact("stats", "latestDrivers", "latestTeams"),
        );
    }

    // Drivers CRUD
    public function driversIndex()
    {
        $drivers = Driver::with("team")->orderBy("first_name")->paginate(15);
        return view("admin.f1.drivers.index", compact("drivers"));
    }

    public function driversCreate()
    {
        $teams = Team::orderBy("name")->get();
        return view("admin.f1.drivers.create", compact("teams"));
    }

    public function driversStore(Request $request)
    {
        $validated = $request->validate([
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "code" => "required|string|max:3|unique:drivers,code",
            "driver_number" =>
                "required|integer|min:1|max:99|unique:drivers,driver_number",
            "nationality" => "required|string|max:100",
            "place_of_birth" => "nullable|string|max:255",
            "date_of_birth" => "required|date",
            "height_cm" => "nullable|integer|min:100|max:250",
            "weight_kg" => "nullable|integer|min:40|max:150",
            "bio" => "nullable|string|max:5000",
            "profile_image" => "nullable|string|max:255",
            "debut_year" => "nullable|date_format:Y",
            "retirement_year" => "nullable|date_format:Y",
            "wins" => "nullable|integer|min:0|max:10000",
            "podiums" => "nullable|integer|min:0|max:10000",
            "pole_positions" => "nullable|integer|min:0|max:10000",
            "fastest_laps" => "nullable|integer|min:0|max:10000",
            "career_points" => "nullable|integer|min:0|max:100000",
            "world_championships" => "nullable|integer|min:0|max:10",
            "team_id" => "nullable|exists:teams,id",
            "is_active" => "boolean",
        ]);

        $validated["place_of_birth"] =
            $validated["place_of_birth"] ?? $validated["nationality"];

        // Convert year fields to full dates
        if (!empty($validated["debut_year"])) {
            $validated["debut_year"] = Carbon::createFromFormat(
                "Y",
                $validated["debut_year"],
            )->startOfYear();
        }
        if (!empty($validated["retirement_year"])) {
            $validated["retirement_year"] = Carbon::createFromFormat(
                "Y",
                $validated["retirement_year"],
            )->startOfYear();
        }

        // Set defaults for stats
        $validated["wins"] = $validated["wins"] ?? 0;
        $validated["podiums"] = $validated["podiums"] ?? 0;
        $validated["pole_positions"] = $validated["pole_positions"] ?? 0;
        $validated["fastest_laps"] = $validated["fastest_laps"] ?? 0;
        $validated["career_points"] = $validated["career_points"] ?? 0;
        $validated["world_championships"] =
            $validated["world_championships"] ?? 0;

        Driver::create($validated);

        return redirect()
            ->route("admin.f1.drivers.index")
            ->with("success", "Driver created successfully.");
    }

    public function driversEdit(Driver $driver)
    {
        $teams = Team::orderBy("name")->get();
        return view("admin.f1.drivers.edit", compact("driver", "teams"));
    }

    public function driversUpdate(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "code" =>
                "required|string|max:3|unique:drivers,code," . $driver->id,
            "driver_number" =>
                "required|integer|min:1|max:99|unique:drivers,driver_number," .
                $driver->id,
            "nationality" => "required|string|max:100",
            "place_of_birth" => "nullable|string|max:255",
            "date_of_birth" => "required|date",
            "height_cm" => "nullable|integer|min:100|max:250",
            "weight_kg" => "nullable|integer|min:40|max:150",
            "bio" => "nullable|string|max:5000",
            "profile_image" => "nullable|string|max:255",
            "debut_year" =>
                "nullable|integer|digits:4|min:1950|max:" . date("Y"),
            "retirement_year" =>
                "nullable|integer|digits:4|min:1950|max:" . date("Y"),
            "wins" => "nullable|integer|min:0|max:10000",
            "podiums" => "nullable|integer|min:0|max:10000",
            "pole_positions" => "nullable|integer|min:0|max:10000",
            "fastest_laps" => "nullable|integer|min:0|max:10000",
            "career_points" => "nullable|integer|min:0|max:100000",
            "world_championships" => "nullable|integer|min:0|max:10",
            "team_id" => "nullable|exists:teams,id",
            "is_active" => "boolean",
        ]);

        $validated["place_of_birth"] =
            $validated["place_of_birth"] ?? $validated["nationality"];

        // Convert year fields to dates
        if (!empty($validated["debut_year"])) {
            $validated["debut_year"] = Carbon::createFromFormat(
                "Y",
                $validated["debut_year"],
            )->startOfYear();
        }
        if (!empty($validated["retirement_year"])) {
            $validated["retirement_year"] = Carbon::createFromFormat(
                "Y",
                $validated["retirement_year"],
            )->startOfYear();
        }

        // Set default values for null statistics
        $validated["wins"] = $validated["wins"] ?? 0;
        $validated["podiums"] = $validated["podiums"] ?? 0;
        $validated["pole_positions"] = $validated["pole_positions"] ?? 0;
        $validated["fastest_laps"] = $validated["fastest_laps"] ?? 0;
        $validated["career_points"] = $validated["career_points"] ?? 0;
        $validated["world_championships"] =
            $validated["world_championships"] ?? 0;

        $driver->update($validated);

        return redirect()
            ->route("admin.f1.drivers.index")
            ->with("success", "Driver updated successfully.");
    }

    public function driversShow(Driver $driver)
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

        return view("admin.f1.drivers.show", compact("driver", "stats"));
    }

    public function driversDestroy(Driver $driver)
    {
        $driver->delete();
        return redirect()
            ->route("admin.f1.drivers.index")
            ->with("success", "Driver deleted successfully.");
    }

    // Teams CRUD
    public function teamsIndex()
    {
        $teams = Team::withCount("drivers")->orderBy("name")->paginate(15);
        return view("admin.f1.teams.index", compact("teams"));
    }

    public function teamsCreate()
    {
        return view("admin.f1.teams.create");
    }

    public function teamsStore(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255|unique:teams,name",
            "full_name" => "required|string|max:255",
            "country" => "required|string|max:100",
            "headquarters" => "nullable|string|max:255",
            "founded_year" =>
                "required|integer|digits:4|min:1900|max:" . date("Y"),
            "team_chief" => "required|string|max:255",
            "code" => "nullable|string|max:3",
            "technical_chief" => "nullable|string|max:255",
            "chassis" => "nullable|string|max:255",
            "power_unit" => "nullable|string|max:255",
            "description" => "nullable|string|max:5000",
            "logo" => "nullable|string|max:255",
            "car_image" => "nullable|string|max:255",
            "disbanded_year" => "nullable|integer|digits:4|min:1900",
            "world_championships" => "nullable|integer|min:0|max:10",
            "race_wins" => "nullable|integer|min:0|max:10000",
            "pole_positions" => "nullable|integer|min:0|max:10000",
            "fastest_laps" => "nullable|integer|min:0|max:10000",
            "podiums" => "nullable|integer|min:0|max:10000",
            "is_active" => "boolean",
        ]);

        $validated["founded_year"] = Carbon::createFromFormat(
            "Y",
            $validated["founded_year"],
        )->startOfYear();

        // Convert disbanded_year if provided
        if (!empty($validated["disbanded_year"])) {
            $validated["disbanded_year"] = Carbon::createFromFormat(
                "Y",
                $validated["disbanded_year"],
            )->startOfYear();
        }

        // Generate code from name if not provided
        if (empty($validated["code"])) {
            $validated["code"] = strtoupper(substr($validated["name"], 0, 3));
        }

        // Set defaults for statistics
        $validated["world_championships"] =
            $validated["world_championships"] ?? 0;
        $validated["race_wins"] = $validated["race_wins"] ?? 0;
        $validated["pole_positions"] = $validated["pole_positions"] ?? 0;
        $validated["fastest_laps"] = $validated["fastest_laps"] ?? 0;
        $validated["podiums"] = $validated["podiums"] ?? 0;

        Team::create($validated);

        return redirect()
            ->route("admin.f1.teams.index")
            ->with("success", "Team created successfully.");
    }

    public function teamsEdit(Team $team)
    {
        return view("admin.f1.teams.edit", compact("team"));
    }

    public function teamsUpdate(Request $request, Team $team)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255|unique:teams,name," . $team->id,
            "full_name" => "required|string|max:255",
            "country" => "required|string|max:100",
            "headquarters" => "nullable|string|max:255",
            "founded_year" =>
                "required|integer|digits:4|min:1900|max:" . date("Y"),
            "team_chief" => "required|string|max:255",
            "code" => "nullable|string|max:3",
            "technical_chief" => "nullable|string|max:255",
            "chassis" => "nullable|string|max:255",
            "power_unit" => "nullable|string|max:255",
            "description" => "nullable|string|max:5000",
            "logo" => "nullable|string|max:255",
            "car_image" => "nullable|string|max:255",
            "disbanded_year" => "nullable|integer|digits:4|min:1900",
            "world_championships" => "nullable|integer|min:0|max:10",
            "race_wins" => "nullable|integer|min:0|max:10000",
            "pole_positions" => "nullable|integer|min:0|max:10000",
            "fastest_laps" => "nullable|integer|min:0|max:10000",
            "podiums" => "nullable|integer|min:0|max:10000",
            "is_active" => "boolean",
        ]);

        $validated["founded_year"] = Carbon::createFromFormat(
            "Y",
            $validated["founded_year"],
        )->startOfYear();

        // Convert disbanded_year if provided
        if (!empty($validated["disbanded_year"])) {
            $validated["disbanded_year"] = Carbon::createFromFormat(
                "Y",
                $validated["disbanded_year"],
            )->startOfYear();
        }

        // Generate code from name if not provided
        if (empty($validated["code"])) {
            $validated["code"] = strtoupper(substr($validated["name"], 0, 3));
        }

        // Set defaults for statistics
        $validated["world_championships"] =
            $validated["world_championships"] ?? 0;
        $validated["race_wins"] = $validated["race_wins"] ?? 0;
        $validated["pole_positions"] = $validated["pole_positions"] ?? 0;
        $validated["fastest_laps"] = $validated["fastest_laps"] ?? 0;
        $validated["podiums"] = $validated["podiums"] ?? 0;

        $team->update($validated);

        return redirect()
            ->route("admin.f1.teams.index")
            ->with("success", "Team updated successfully.");
    }

    public function teamsDestroy(Team $team)
    {
        $team->delete();
        return redirect()
            ->route("admin.f1.teams.index")
            ->with("success", "Team deleted successfully.");
    }

    // Circuits CRUD
    public function circuitsIndex()
    {
        $circuits = Circuit::orderBy("name")->paginate(15);
        return view("admin.f1.circuits.index", compact("circuits"));
    }

    public function circuitsCreate()
    {
        return view("admin.f1.circuits.create");
    }

    public function circuitsStore(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255|unique:circuits,name",
            "full_name" => "required|string|max:255",
            "country" => "required|string|max:100",
            "city" => "required|string|max:100",
            "length_km" => "required|numeric|min:1|max:20",
            "corners" => "required|integer|min:1|max:100",
            "address" => "nullable|string|max:255",
            "latitude" => "nullable|numeric|min:-90|max:90",
            "longitude" => "nullable|numeric|min:-180|max:180",
            "lap_record_seconds" => "nullable|numeric|min:0",
            "lap_record_driver" => "nullable|string|max:255",
            "lap_record_year" => "nullable|integer|min:1950|max:" . date("Y"),
            "drs_zones" => "nullable|integer|min:0|max:10",
            "direction" => "required|string|max:50",
            "description" => "nullable|string|max:5000",
            "circuit_image" => "nullable|string|max:255",
            "layout_image" => "nullable|string|max:255",
            "first_grand_prix" => "required|integer|min:1950|max:" . date("Y"),
            "last_grand_prix" => "nullable|integer|min:1950",
            "races_held" => "nullable|integer|min:0",
            "is_active" => "boolean",
        ]);

        // Set defaults
        $validated["drs_zones"] = $validated["drs_zones"] ?? 0;
        $validated["races_held"] = $validated["races_held"] ?? 0;

        Circuit::create($validated);

        return redirect()
            ->route("admin.f1.circuits.index")
            ->with("success", "Circuit created successfully.");
    }

    public function circuitsEdit(Circuit $circuit)
    {
        return view("admin.f1.circuits.edit", compact("circuit"));
    }

    public function circuitsUpdate(Request $request, Circuit $circuit)
    {
        $validated = $request->validate([
            "name" =>
                "required|string|max:255|unique:circuits,name," . $circuit->id,
            "full_name" => "required|string|max:255",
            "country" => "required|string|max:100",
            "city" => "required|string|max:100",
            "length_km" => "required|numeric|min:1|max:20",
            "corners" => "required|integer|min:1|max:100",
            "address" => "nullable|string|max:255",
            "latitude" => "nullable|numeric|min:-90|max:90",
            "longitude" => "nullable|numeric|min:-180|max:180",
            "lap_record_seconds" => "nullable|numeric|min:0",
            "lap_record_driver" => "nullable|string|max:255",
            "lap_record_year" => "nullable|integer|min:1950|max:" . date("Y"),
            "drs_zones" => "nullable|integer|min:0|max:10",
            "direction" => "required|string|max:50",
            "description" => "nullable|string|max:5000",
            "circuit_image" => "nullable|string|max:255",
            "layout_image" => "nullable|string|max:255",
            "first_grand_prix" => "required|integer|min:1950|max:" . date("Y"),
            "last_grand_prix" => "nullable|integer|min:1950",
            "races_held" => "nullable|integer|min:0",
            "is_active" => "boolean",
        ]);

        // Set defaults
        $validated["drs_zones"] = $validated["drs_zones"] ?? 0;
        $validated["races_held"] = $validated["races_held"] ?? 0;

        $circuit->update($validated);

        return redirect()
            ->route("admin.f1.circuits.index")
            ->with("success", "Circuit updated successfully.");
    }

    public function circuitsDestroy(Circuit $circuit)
    {
        $circuit->delete();
        return redirect()
            ->route("admin.f1.circuits.index")
            ->with("success", "Circuit deleted successfully.");
    }

    // Seasons CRUD
    public function seasonsIndex()
    {
        $seasons = Season::with(["championDriver", "championTeam"])
            ->orderBy("year", "desc")
            ->paginate(15);
        return view("admin.f1.seasons.index", compact("seasons"));
    }

    public function seasonsCreate()
    {
        $drivers = Driver::orderBy("first_name")->get();
        $teams = Team::orderBy("name")->get();
        return view("admin.f1.seasons.create", compact("drivers", "teams"));
    }

    public function seasonsStore(Request $request)
    {
        $validated = $request->validate([
            "year" =>
                "required|integer|min:1950|max:" .
                (date("Y") + 1) .
                "|unique:seasons,year",
            "total_races" => "required|integer|min:1|max:30",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date",
            "completed_races" => "nullable|integer|min:0",
            "description" => "nullable|string|max:5000",
            "season_image" => "nullable|string|max:255",
            "champion_driver_id" => "nullable|exists:drivers,id",
            "champion_team_id" => "nullable|exists:teams,id",
            "is_active" => "boolean",
        ]);

        // Set defaults
        $validated["completed_races"] = $validated["completed_races"] ?? 0;

        Season::create($validated);

        return redirect()
            ->route("admin.f1.seasons.index")
            ->with("success", "Season created successfully.");
    }

    public function seasonsEdit(Season $season)
    {
        $drivers = Driver::orderBy("first_name")->get();
        $teams = Team::orderBy("name")->get();
        return view(
            "admin.f1.seasons.edit",
            compact("season", "drivers", "teams"),
        );
    }

    public function seasonsUpdate(Request $request, Season $season)
    {
        $validated = $request->validate([
            "year" =>
                "required|integer|min:1950|max:" .
                (date("Y") + 1) .
                "|unique:seasons,year," .
                $season->id,
            "total_races" => "required|integer|min:1|max:30",
            "start_date" => "required|date",
            "end_date" => "required|date|after_or_equal:start_date",
            "completed_races" => "nullable|integer|min:0",
            "description" => "nullable|string|max:5000",
            "season_image" => "nullable|string|max:255",
            "champion_driver_id" => "nullable|exists:drivers,id",
            "champion_team_id" => "nullable|exists:teams,id",
            "is_active" => "boolean",
        ]);

        // Set defaults
        $validated["completed_races"] = $validated["completed_races"] ?? 0;

        $season->update($validated);

        return redirect()
            ->route("admin.f1.seasons.index")
            ->with("success", "Season updated successfully.");
    }

    public function seasonsDestroy(Season $season)
    {
        $season->delete();
        return redirect()
            ->route("admin.f1.seasons.index")
            ->with("success", "Season deleted successfully.");
    }

    // Races CRUD
    public function racesIndex()
    {
        $races = Race::with(["season", "circuit"])
            ->orderByDesc("race_date")
            ->paginate(15);
        return view("admin.f1.races.index", compact("races"));
    }

    public function racesCreate()
    {
        $seasons = Season::orderByDesc("year")->get();
        $circuits = Circuit::orderBy("name")->get();
        return view("admin.f1.races.create", compact("seasons", "circuits"));
    }

    public function racesStore(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "full_name" => "required|string|max:255",
            "official_name" => "nullable|string|max:255",
            "round_number" => "required|integer|min:1|max:25",
            "race_date" => "required|date",
            "race_time" => "nullable|date_format:H:i",
            "laps" => "required|integer|min:1|max:120",
            "race_distance_km" => "required|numeric|min:0|max:1000",
            "fastest_lap_time" => "nullable|string|max:50",
            "fastest_lap_driver_id" => "nullable|exists:drivers,id",
            "pole_position_time" => "nullable|string|max:50",
            "pole_position_driver_id" => "nullable|exists:drivers,id",
            "weather_conditions" => "nullable|string|max:255",
            "race_report" => "nullable|string",
            "race_image" => "nullable|string|max:255",
            "season_id" => "required|exists:seasons,id",
            "circuit_id" => "required|exists:circuits,id",
            "is_completed" => "boolean",
            "is_cancelled" => "boolean",
            "is_active" => "boolean",
        ]);

        $validated["is_completed"] = $request->boolean("is_completed");
        $validated["is_cancelled"] = $request->boolean("is_cancelled");
        $validated["is_active"] = $request->boolean("is_active");

        Race::create($validated);

        return redirect()
            ->route("admin.f1.races.index")
            ->with("success", "Race created successfully.");
    }

    public function racesEdit(Race $race)
    {
        $seasons = Season::orderByDesc("year")->get();
        $circuits = Circuit::orderBy("name")->get();
        $raceResults = $race
            ->raceResults()
            ->with(["driver", "team"])
            ->orderBy("position")
            ->get();
        return view(
            "admin.f1.races.edit",
            compact("race", "seasons", "circuits", "raceResults"),
        );
    }

    public function racesUpdate(Request $request, Race $race)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "full_name" => "required|string|max:255",
            "official_name" => "nullable|string|max:255",
            "round_number" => "required|integer|min:1|max:25",
            "race_date" => "required|date",
            "race_time" => "nullable|date_format:H:i",
            "laps" => "required|integer|min:1|max:120",
            "race_distance_km" => "required|numeric|min:0|max:1000",
            "fastest_lap_time" => "nullable|string|max:50",
            "fastest_lap_driver_id" => "nullable|exists:drivers,id",
            "pole_position_time" => "nullable|string|max:50",
            "pole_position_driver_id" => "nullable|exists:drivers,id",
            "weather_conditions" => "nullable|string|max:255",
            "race_report" => "nullable|string",
            "race_image" => "nullable|string|max:255",
            "season_id" => "required|exists:seasons,id",
            "circuit_id" => "required|exists:circuits,id",
            "is_completed" => "boolean",
            "is_cancelled" => "boolean",
            "is_active" => "boolean",
        ]);

        $validated["is_completed"] = $request->boolean("is_completed");
        $validated["is_cancelled"] = $request->boolean("is_cancelled");
        $validated["is_active"] = $request->boolean("is_active");

        $race->update($validated);

        return redirect()
            ->route("admin.f1.races.index")
            ->with("success", "Race updated successfully.");
    }

    public function racesDestroy(Race $race)
    {
        $race->delete();
        return redirect()
            ->route("admin.f1.races.index")
            ->with("success", "Race deleted successfully.");
    }

    public function raceResultsCreate(Race $race)
    {
        $drivers = Driver::orderBy("last_name")->get();
        $teams = Team::orderBy("name")->get();

        return view(
            "admin.f1.races.results.create",
            compact("race", "drivers", "teams"),
        );
    }

    public function raceResultsStore(Request $request, Race $race)
    {
        $validated = $request->validate([
            "position" => "required|integer|min:1|max:99",
            "position_text" => "nullable|string|max:10",
            "grid_position" => "required|integer|min:1|max:99",
            "laps_completed" => "required|integer|min:0|max:999",
            "race_time" => [
                "nullable",
                'regex:/^([01]\\d|2[0-3]):[0-5]\\d(:[0-5]\\d)?$/',
            ],
            "time_gap" => "nullable|string|max:20",
            "interval" => "nullable|string|max:20",
            "points" => "required|integer|min:0|max:100",
            "status" => "required|string|max:50",
            "fastest_lap" => "boolean",
            "fastest_lap_time" => "nullable|string|max:50",
            "average_speed" => "nullable|string|max:50",
            "notes" => "nullable|string",
            "driver_id" => "required|exists:drivers,id",
            "team_id" => "required|exists:teams,id",
        ]);

        $validated["fastest_lap"] = $request->boolean("fastest_lap");

        if (empty($validated["position_text"])) {
            $validated["position_text"] =
                $validated["status"] === "Finished"
                    ? (string) $validated["position"]
                    : $validated["status"];
        }

        $validated["race_id"] = $race->id;

        RaceResult::create($validated);

        return redirect()
            ->route("admin.f1.races.edit", $race)
            ->with("success", "Race result added successfully.");
    }

    public function raceResultsEdit(RaceResult $raceResult)
    {
        $drivers = Driver::orderBy("last_name")->get();
        $teams = Team::orderBy("name")->get();

        return view(
            "admin.f1.races.results.edit",
            compact("raceResult", "drivers", "teams"),
        );
    }

    public function raceResultsUpdate(Request $request, RaceResult $raceResult)
    {
        $validated = $request->validate([
            "position" => "required|integer|min:1|max:99",
            "position_text" => "nullable|string|max:10",
            "grid_position" => "required|integer|min:1|max:99",
            "laps_completed" => "required|integer|min:0|max:999",
            "race_time" => [
                "nullable",
                'regex:/^([01]\\d|2[0-3]):[0-5]\\d(:[0-5]\\d)?$/',
            ],
            "time_gap" => "nullable|string|max:20",
            "interval" => "nullable|string|max:20",
            "points" => "required|integer|min:0|max:100",
            "status" => "required|string|max:50",
            "fastest_lap" => "boolean",
            "fastest_lap_time" => "nullable|string|max:50",
            "average_speed" => "nullable|string|max:50",
            "notes" => "nullable|string",
            "driver_id" => "required|exists:drivers,id",
            "team_id" => "required|exists:teams,id",
        ]);

        $validated["fastest_lap"] = $request->boolean("fastest_lap");

        if (empty($validated["position_text"])) {
            $validated["position_text"] =
                $validated["status"] === "Finished"
                    ? (string) $validated["position"]
                    : $validated["status"];
        }

        $raceResult->update($validated);

        return redirect()
            ->route("admin.f1.races.edit", $raceResult->race)
            ->with("success", "Race result updated successfully.");
    }

    public function raceResultsDestroy(RaceResult $raceResult)
    {
        $race = $raceResult->race;
        $raceResult->delete();

        return redirect()
            ->route("admin.f1.races.edit", $race)
            ->with("success", "Race result deleted successfully.");
    }
}
