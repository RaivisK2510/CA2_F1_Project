@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col">
            <h1 class="display-4 fw-bold text-center mb-4">🏎️ F1 Stats Hub Dashboard</h1>
            <p class="lead text-center text-muted">Your ultimate destination for Formula 1 statistics and race data</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-person fs-1 text-danger"></i>
                    </div>
                    <h5 class="card-title">Total Drivers</h5>
                    <p class="display-4 fw-bold text-danger mb-0">{{ $stats['total_drivers'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-building fs-1 text-primary"></i>
                    </div>
                    <h5 class="card-title">Total Teams</h5>
                    <p class="display-4 fw-bold text-primary mb-0">{{ $stats['total_teams'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-geo-alt fs-1 text-success"></i>
                    </div>
                    <h5 class="card-title">Total Circuits</h5>
                    <p class="display-4 fw-bold text-success mb-0">{{ $stats['total_circuits'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <i class="bi bi-calendar fs-1 text-warning"></i>
                    </div>
                    <h5 class="card-title">Total Seasons</h5>
                    <p class="display-4 fw-bold text-warning mb-0">{{ $stats['total_seasons'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Data -->
    <div class="row g-4 mb-5">
        <!-- Latest Drivers -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">🏁 Latest Drivers</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse($latestDrivers as $driver)
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <span class="badge bg-danger fs-6">{{ $driver->code }}</span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $driver->full_name }}</h6>
                                        <small class="text-muted">
                                            🏆 {{ $driver->world_championships }} Championships | 🏁 {{ $driver->wins }} Wins
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-person-x fs-1"></i>
                                <p class="mt-2">No drivers found</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Teams -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">🏭 Latest Teams</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @forelse($latestTeams as $team)
                            <div class="list-group-item border-0 px-0">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <span class="badge bg-primary fs-6">{{ $team->code }}</span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">{{ $team->name }}</h6>
                                        <small class="text-muted">
                                            🏁 {{ $team->race_wins }} Wins | 🏆 {{ $team->world_championships }} Championships
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4 text-muted">
                                <i class="bi bi-building-x fs-1"></i>
                                <p class="mt-2">No teams found</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Navigation -->
    <div class="row">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5 class="card-title mb-0">🔗 Quick Navigation</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('f1.drivers') }}" class="btn btn-danger btn-lg w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-person"></i>
                                <span>Drivers</span>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('f1.teams') }}" class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-building"></i>
                                <span>Teams</span>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('f1.circuits') }}" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-geo-alt"></i>
                                <span>Circuits</span>
                            </a>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('f1.seasons') }}" class="btn btn-warning btn-lg w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-calendar"></i>
                                <span>Seasons</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
</body>
</html>
