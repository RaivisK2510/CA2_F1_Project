<?php

namespace App\Http\Controllers;

use App\Models\Circuit;
use App\Models\Driver;
use App\Models\Post;
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
            'posts' => Post::count(),
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
}
