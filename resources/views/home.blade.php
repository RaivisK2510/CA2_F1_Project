@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="bg-black text-white py-5" style="background: linear-gradient(135deg, #000000 0%, #230000 100%);">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-3 fw-bold mb-4">F1 Stats Hub</h1>
                <p class="lead mb-4 text-secondary">Your command center for Formula 1 results, drivers, teams, and race history.</p>
                <p class="fs-5 mb-4 text-secondary">Explore the latest F1 dashboards, manage race data, and follow every circuit in a sleek black and red interface.</p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('f1.races') }}" class="btn btn-lg px-4" style="background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%); border: none; color: white;">View Races</a>
                    <a href="{{ route('f1.drivers') }}" class="btn btn-lg px-4" style="background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%); border: none; color: white;">Drivers</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5 my-5">
    <div class="row text-center mb-5">
        <div class="col-lg-8 mx-auto">
            <h2 class="display-5 fw-bold mb-3 text-white">Race Data Designed for F1 Fans</h2>
            <p class="lead text-secondary">Track driver standings, team performance, circuits, and complete race results in one dashboard.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-3">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-speedometer2 fs-1" style="color: #ff0000;"></i>
                    </div>
                    <h3 class="h4 mb-3">Live Race Stats</h3>
                    <p class="text-secondary">Stay on top of every race with up-to-date results, positions, and status details.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-3">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-people-fill fs-1" style="color: #ff0000;"></i>
                    </div>
                    <h3 class="h4 mb-3">Driver Profiles</h3>
                    <p class="text-secondary">Explore driver bios, nationality, teams, and career results with fast access.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm rounded-3">
                <div class="card-body text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-flag-fill fs-1" style="color: #ff0000;"></i>
                    </div>
                    <h3 class="h4 mb-3">Circuit Coverage</h3>
                    <p class="text-secondary">Discover every track, first Grand Prix, distance, and racing history at a glance.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-dark py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <h2 class="display-6 fw-bold mb-4">Built for Formula 1 Data Management</h2>
                <p class="lead text-secondary mb-4">Easy admin controls for races, results, teams, drivers, circuits, and seasons — all in one unified interface.</p>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #ff0000;"></i><strong>Admin race management</strong> with results and standings.</li>
                    <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #ff0000;"></i><strong>Driver and team dashboards</strong> updated in real time.</li>
                    <li class="mb-3"><i class="bi bi-check-circle-fill me-2" style="color: #ff0000;"></i><strong>Fast navigation</strong> between seasons, circuits, and stats.</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="rounded-4 overflow-hidden shadow-sm" style="background: #111; padding: 2rem;">
                    <div class="mb-4">
                        <span class="badge text-white px-3 py-2" style="background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%);">Live</span>
                    </div>
                    <div class="row g-3 text-white">
                        <div class="col-6">
                            <div class="p-3 bg-black rounded-3">
                                <p class="mb-1 text-secondary">Upcoming Races</p>
                                <h3 class="mb-0">12</h3>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-black rounded-3">
                                <p class="mb-1 text-secondary">Active Teams</p>
                                <h3 class="mb-0">10</h3>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-black rounded-3">
                                <p class="mb-1 text-secondary">Drivers</p>
                                <h3 class="mb-0">22</h3>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-black rounded-3">
                                <p class="mb-1 text-secondary">Circuits</p>
                                <h3 class="mb-0">18</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
