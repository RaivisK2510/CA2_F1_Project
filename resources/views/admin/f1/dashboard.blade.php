@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">F1 Data Management Dashboard</h4>
                    <a href="{{ route('admin.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Admin
                    </a>
                </div>

                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white rounded-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Drivers</h5>
                                    <h2>{{ $stats['total_drivers'] }}</h2>
                                    <a href="{{ route('admin.f1.drivers.index') }}" class="btn btn-light btn-sm mt-2">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white rounded-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Teams</h5>
                                    <h2>{{ $stats['total_teams'] }}</h2>
                                    <a href="{{ route('admin.f1.teams.index') }}" class="btn btn-light btn-sm mt-2">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white rounded-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Circuits</h5>
                                    <h2>{{ $stats['total_circuits'] }}</h2>
                                    <a href="{{ route('admin.f1.circuits.index') }}" class="btn btn-light btn-sm mt-2">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white rounded-4 shadow-sm">
                                <div class="card-body">
                                    <h5 class="card-title">Seasons</h5>
                                    <h2>{{ $stats['total_seasons'] }}</h2>
                                    <a href="{{ route('admin.f1.seasons.index') }}" class="btn btn-light btn-sm mt-2">Manage</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Data Sections -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card rounded-4 overflow-hidden shadow-sm">
                                <div class="card-header bg-primary text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Latest Drivers</h5>
                                        <a href="{{ route('admin.f1.drivers.index') }}" class="btn btn-light btn-sm">Manage Drivers</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if(isset($latestDrivers) && $latestDrivers->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($latestDrivers->take(3) as $driver)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
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
                                <div class="card-header bg-success text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Latest Teams</h5>
                                        <a href="{{ route('admin.f1.teams.index') }}" class="btn btn-light btn-sm">Manage Teams</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if(isset($latestTeams) && $latestTeams->count() > 0)
                                        <div class="list-group list-group-flush">
                                            @foreach($latestTeams->take(3) as $team)
                                                <div class="list-group-item d-flex justify-content-between align-items-center">
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
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card rounded-4 overflow-hidden shadow-sm">
                                <div class="card-header bg-info text-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Circuits</h5>
                                        <a href="{{ route('admin.f1.circuits.index') }}" class="btn btn-light btn-sm">Manage Circuits</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <h3 class="text-info">{{ $stats['total_circuits'] }}</h3>
                                        <p class="text-muted">Total circuits in database</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card rounded-4 overflow-hidden shadow-sm">
                                <div class="card-header bg-warning text-dark">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Seasons</h5>
                                        <a href="{{ route('admin.f1.seasons.index') }}" class="btn btn-light btn-sm">Manage Seasons</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <h3 class="text-warning">{{ $stats['total_seasons'] }}</h3>
                                        <p class="text-muted">Total seasons in database</p>
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <a href="{{ route('admin.f1.drivers.create') }}" class="btn btn-primary btn-block w-100">
                                        <i class="bi bi-plus"></i> Add Driver
                                    </a>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <a href="{{ route('admin.f1.teams.create') }}" class="btn btn-success btn-block w-100">
                                        <i class="bi bi-plus"></i> Add Team
                                    </a>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <a href="{{ route('admin.f1.circuits.create') }}" class="btn btn-info btn-block w-100">
                                        <i class="bi bi-plus"></i> Add Circuit
                                    </a>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <a href="{{ route('admin.f1.seasons.create') }}" class="btn btn-warning btn-block w-100">
                                        <i class="bi bi-plus"></i> Add Season
                                    </a>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <a href="{{ route('admin.f1.races.index') }}" class="btn btn-danger btn-block w-100">
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
</style>
@endsection
