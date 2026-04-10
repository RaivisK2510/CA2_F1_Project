<?php

namespace App\Http\Controllers;

use App\Models\Circuit;
use App\Models\Driver;
use App\Models\Race;
use App\Models\RaceResult;
use App\Models\Season;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $counts = [
            'users' => User::count(),
            'drivers' => Driver::count(),
            'teams' => Team::count(),
            'circuits' => Circuit::count(),
            'races' => Race::count(),
            'seasons' => Season::count(),
            'results' => RaceResult::count(),
        ];

        return view('admin.index', compact('counts'));
    }

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own admin account.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User removed successfully.');
    }

    // F1 Dashboard
    public function f1Dashboard()
    {
        $stats = [
            'total_drivers' => Driver::count(),
            'total_teams' => Team::count(),
            'total_circuits' => Circuit::count(),
            'total_seasons' => Season::count(),
            'total_races' => Race::count(),
            'total_results' => RaceResult::count(),
        ];

        return view('admin.f1.dashboard', compact('stats'));
    }

    // Drivers CRUD
    public function driversIndex()
    {
        $drivers = Driver::with('team')->orderBy('first_name')->paginate(15);
        return view('admin.f1.drivers.index', compact('drivers'));
    }

    public function driversCreate()
    {
        $teams = Team::orderBy('name')->get();
        return view('admin.f1.drivers.create', compact('teams'));
    }

    public function driversStore(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'code' => 'required|string|max:3|unique:drivers,code',
            'driver_number' => 'required|integer|min:1|max:99|unique:drivers,driver_number',
            'nationality' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'team_id' => 'nullable|exists:teams,id',
            'is_active' => 'boolean',
        ]);

        Driver::create($validated);

        return redirect()->route('admin.f1.drivers.index')->with('success', 'Driver created successfully.');
    }

    public function driversEdit(Driver $driver)
    {
        $teams = Team::orderBy('name')->get();
        return view('admin.f1.drivers.edit', compact('driver', 'teams'));
    }

    public function driversUpdate(Request $request, Driver $driver)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'code' => 'required|string|max:3|unique:drivers,code,' . $driver->id,
            'driver_number' => 'required|integer|min:1|max:99|unique:drivers,driver_number,' . $driver->id,
            'nationality' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'team_id' => 'nullable|exists:teams,id',
            'is_active' => 'boolean',
        ]);

        $driver->update($validated);

        return redirect()->route('admin.f1.drivers.index')->with('success', 'Driver updated successfully.');
    }

    public function driversDestroy(Driver $driver)
    {
        $driver->delete();
        return redirect()->route('admin.f1.drivers.index')->with('success', 'Driver deleted successfully.');
    }

    // Teams CRUD
    public function teamsIndex()
    {
        $teams = Team::withCount('drivers')->orderBy('name')->paginate(15);
        return view('admin.f1.teams.index', compact('teams'));
    }

    public function teamsCreate()
    {
        return view('admin.f1.teams.create');
    }

    public function teamsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams,name',
            'full_name' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'founded_year' => 'required|date',
            'team_chief' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        Team::create($validated);

        return redirect()->route('admin.f1.teams.index')->with('success', 'Team created successfully.');
    }

    public function teamsEdit(Team $team)
    {
        return view('admin.f1.teams.edit', compact('team'));
    }

    public function teamsUpdate(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:teams,name,' . $team->id,
            'full_name' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'founded_year' => 'required|date',
            'team_chief' => 'required|string|max:255',
            'is_active' => 'boolean',
        ]);

        $team->update($validated);

        return redirect()->route('admin.f1.teams.index')->with('success', 'Team updated successfully.');
    }

    public function teamsDestroy(Team $team)
    {
        $team->delete();
        return redirect()->route('admin.f1.teams.index')->with('success', 'Team deleted successfully.');
    }

    // Circuits CRUD
    public function circuitsIndex()
    {
        $circuits = Circuit::orderBy('name')->paginate(15);
        return view('admin.f1.circuits.index', compact('circuits'));
    }

    public function circuitsCreate()
    {
        return view('admin.f1.circuits.create');
    }

    public function circuitsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:circuits,name',
            'full_name' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'length_km' => 'required|numeric|min:1|max:20',
            'corners' => 'required|integer|min:1|max:100',
            'lap_record' => 'nullable|string|max:50',
            'first_grand_prix_year' => 'required|integer|min:1950|max:' . date('Y'),
            'is_active' => 'boolean',
        ]);

        Circuit::create($validated);

        return redirect()->route('admin.f1.circuits.index')->with('success', 'Circuit created successfully.');
    }

    public function circuitsEdit(Circuit $circuit)
    {
        return view('admin.f1.circuits.edit', compact('circuit'));
    }

    public function circuitsUpdate(Request $request, Circuit $circuit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:circuits,name,' . $circuit->id,
            'full_name' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'length_km' => 'required|numeric|min:1|max:20',
            'corners' => 'required|integer|min:1|max:100',
            'lap_record' => 'nullable|string|max:50',
            'first_grand_prix_year' => 'required|integer|min:1950|max:' . date('Y'),
            'is_active' => 'boolean',
        ]);

        $circuit->update($validated);

        return redirect()->route('admin.f1.circuits.index')->with('success', 'Circuit updated successfully.');
    }

    public function circuitsDestroy(Circuit $circuit)
    {
        $circuit->delete();
        return redirect()->route('admin.f1.circuits.index')->with('success', 'Circuit deleted successfully.');
    }

    // Seasons CRUD
    public function seasonsIndex()
    {
        $seasons = Season::with(['championDriver', 'championTeam'])->orderBy('year', 'desc')->paginate(15);
        return view('admin.f1.seasons.index', compact('seasons'));
    }

    public function seasonsCreate()
    {
        $drivers = Driver::orderBy('first_name')->get();
        $teams = Team::orderBy('name')->get();
        return view('admin.f1.seasons.create', compact('drivers', 'teams'));
    }

    public function seasonsStore(Request $request)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1950|max:' . (date('Y') + 1) . '|unique:seasons,year',
            'races_count' => 'required|integer|min:1|max:30',
            'champion_driver_id' => 'nullable|exists:drivers,id',
            'champion_team_id' => 'nullable|exists:teams,id',
            'is_active' => 'boolean',
        ]);

        Season::create($validated);

        return redirect()->route('admin.f1.seasons.index')->with('success', 'Season created successfully.');
    }

    public function seasonsEdit(Season $season)
    {
        $drivers = Driver::orderBy('first_name')->get();
        $teams = Team::orderBy('name')->get();
        return view('admin.f1.seasons.edit', compact('season', 'drivers', 'teams'));
    }

    public function seasonsUpdate(Request $request, Season $season)
    {
        $validated = $request->validate([
            'year' => 'required|integer|min:1950|max:' . (date('Y') + 1) . '|unique:seasons,year,' . $season->id,
            'races_count' => 'required|integer|min:1|max:30',
            'champion_driver_id' => 'nullable|exists:drivers,id',
            'champion_team_id' => 'nullable|exists:teams,id',
            'is_active' => 'boolean',
        ]);

        $season->update($validated);

        return redirect()->route('admin.f1.seasons.index')->with('success', 'Season updated successfully.');
    }

    public function seasonsDestroy(Season $season)
    {
        $season->delete();
        return redirect()->route('admin.f1.seasons.index')->with('success', 'Season deleted successfully.');
    }
}
