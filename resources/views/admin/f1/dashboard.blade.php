@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white header-flex">
                    <h4 class="mb-0">F1 Data Management Dashboard</h4>
                    <a href="{{ route('admin.index') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-arrow-left"></i> Back to Admin
                    </a>
                </div>

                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row row-cols-2 row-cols-md-4 g-2 g-md-3 mb-4">
                        <div class="col">
                            <div class="card bg-primary text-white rounded-4 shadow-sm h-100">
                                <div class="card-body p-3 p-md-3">
                                    <h5 class="card-title fs-6 fs-md-5 mb-1">Drivers</h5>
                                    <h2 class="stats-value">{{ $stats['total_drivers'] }}</h2>
                                    <a href="{{ route('admin.f1.drivers.index') }}" class="btn btn-light btn-sm mt-2 w-100 w-md-auto">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success text-white rounded-4 shadow-sm h-100">
                                <div class="card-body p-3 p-md-3">
                                    <h5 class="card-title fs-6 fs-md-5 mb-1">Teams</h5>
                                    <h2 class="stats-value">{{ $stats['total_teams'] }}</h2>
                                    <a href="{{ route('admin.f1.teams.index') }}" class="btn btn-light btn-sm mt-2 w-100 w-md-auto">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-info text-white rounded-4 shadow-sm h-100">
                                <div class="card-body p-3 p-md-3">
                                    <h5 class="card-title fs-6 fs-md-5 mb-1">Circuits</h5>
                                    <h2 class="stats-value">{{ $stats['total_circuits'] }}</h2>
                                    <a href="{{ route('admin.f1.circuits.index') }}" class="btn btn-light btn-sm mt-2 w-100 w-md-auto">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-warning text-white rounded-4 shadow-sm h-100">
                                <div class="card-body p-3 p-md-3">
                                    <h5 class="card-title fs-6 fs-md-5 mb-1">Seasons</h5>
                                    <h2 class="stats-value">{{ $stats['total_seasons'] }}</h2>
                                    <a href="{{ route('admin.f1.seasons.index') }}" class="btn btn-light btn-sm mt-2 w-100 w-md-auto">Manage</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Data Sections -->
                    <div class="row g-2 g-md-3 mb-4">
                        <div class="col-md-6">
                            <div class="card rounded-4 overflow-hidden shadow-sm">
                                <div class="card-header bg-primary text-white header-flex">
                                    <h5 class="mb-0">Latest Drivers</h5>
                                    <a href="{{ route('admin.f1.drivers.index') }}" class="btn btn-light btn-sm w-100 w-md-auto">Manage</a>
                                </div>
                                <div class="card-body p-3 p-md-3">
                                    @if(isset($latestDrivers) && $latestDrivers->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($latestDrivers->take(3) as $driver)
                                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <div>
                                                        <strong>{{ $driver->full_name }}</strong>
                                                        <br><small class="text-muted">#{{ $driver->driver_number }} | {{ $driver->nationality }}</small>
                                                    </div>
                                                    <span class="badge bg-danger">{{ $driver->code }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="text-center mt-2">
                                            <small class="text-muted">{{ $stats['total_drivers'] }} total drivers</small>
                                        </div>
                                    @else
                                        <p class="text-muted text-center">No drivers found</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card rounded-4 overflow-hidden shadow-sm">
                                <div class="card-header bg-success text-white header-flex">
                                    <h5 class="mb-0">Latest Teams</h5>
                                    <a href="{{ route('admin.f1.teams.index') }}" class="btn btn-light btn-sm w-100 w-md-auto">Manage</a>
                                </div>
                                <div class="card-body p-3 p-md-3">
                                    @if(isset($latestTeams) && $latestTeams->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($latestTeams->take(3) as $team)
                                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                    <div>
                                                        <strong>{{ $team->name }}</strong>
                                                        <br><small class="text-muted">{{ $team->country }}</small>
                                                    </div>
                                                    <span class="badge bg-info">{{ $team->code }}</span>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="text-center mt-2">
                                            <small class="text-muted">{{ $stats['total_teams'] }} total teams</small>
                                        </div>
                                    @else
                                        <p class="text-muted text-center">No teams found</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card rounded-4 overflow-hidden shadow-sm">
                                <div class="card-header bg-info text-white header-flex">
                                    <h5 class="mb-0">Circuits</h5>
                                    <a href="{{ route('admin.f1.circuits.index') }}" class="btn btn-light btn-sm w-100 w-md-auto">Manage</a>
                                </div>
                                <div class="card-body p-3 p-md-3">
                                    <div class="text-center">
                                        <h3 class="text-info h3-responsive">{{ $stats['total_circuits'] }}</h3>
                                        <p class="text-muted small">Total circuits in database</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card rounded-4 overflow-hidden shadow-sm">
                                <div class="card-header bg-warning text-dark header-flex">
                                    <h5 class="mb-0">Seasons</h5>
                                    <a href="{{ route('admin.f1.seasons.index') }}" class="btn btn-light btn-sm w-100 w-md-auto">Manage</a>
                                </div>
                                <div class="card-body p-3 p-md-3">
                                    <div class="text-center">
                                        <h3 class="text-warning h3-responsive">{{ $stats['total_seasons'] }}</h3>
                                        <p class="text-muted small">Total seasons in database</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card rounded-4 overflow-hidden shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body p-3 p-md-3">
                            <div class="row g-2">
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('admin.f1.drivers.create') }}" class="btn btn-primary w-100 btn-sm">
                                        <i class="bi bi-plus"></i> Add Driver
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('admin.f1.teams.create') }}" class="btn btn-success w-100 btn-sm">
                                        <i class="bi bi-plus"></i> Add Team
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('admin.f1.circuits.create') }}" class="btn btn-info w-100 btn-sm">
                                        <i class="bi bi-plus"></i> Add Circuit
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('admin.f1.seasons.create') }}" class="btn btn-warning w-100 btn-sm">
                                        <i class="bi bi-plus"></i> Add Season
                                    </a>
                                </div>
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('admin.f1.races.index') }}" class="btn btn-danger w-100 btn-sm">
                                        <i class="bi bi-flag-checkered"></i> Manage Races
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background: url('/img/sitebg.gif') no-repeat center center fixed !important;
    background-size: cover !important;
}
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 0;
    background: rgba(0, 0, 0, 0.5);
    pointer-events: none;
}
.container {
    position: relative;
    z-index: 1;
}
.card {
    background: rgba(255, 255, 255, 0.95);
    border: none;
}
.card-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}
.list-group-item {
    background: transparent;
}

/* === Responsive tweaks === */

/* Card header — stack on mobile */
.header-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.5rem;
}

/* Stat number sizing */
.stats-value {
    font-size: 1.5rem;
}

/* Responsive h3 inside cards */
.h3-responsive {
    font-size: 1.5rem;
}

@media (min-width: 576px) {
    .header-flex .btn {
        width: auto !important;
    }
}

@media (max-width: 575.98px) {
    .header-flex .btn {
        width: 100% !important;
    }
    .w-md-auto {
        width: 100% !important;
    }
}

@media (min-width: 576px) {
    .stats-value {
        font-size: 2rem;
    }
    .h3-responsive {
        font-size: 1.75rem;
    }
    .w-md-auto {
        width: auto !important;
    }
}
</style>
@endsection
