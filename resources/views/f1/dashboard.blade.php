@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">F1 Stats Hub</h1>
            <p class="text-muted">Welcome to the Formula 1 statistics dashboard</p>
        </div>
    </div>

    <div class="stats-flex mb-4">
        <div class="col">
            <a href="{{ route('f1.drivers') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 dashboard-card-hover">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-person fs-1 text-danger"></i>
                        </div>
                        <h5 class="card-title">Drivers</h5>
                        <p class="display-4 fw-bold text-danger mb-0">{{ $stats['total_drivers'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('f1.teams') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 dashboard-card-hover">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-building fs-1 text-danger"></i>
                        </div>
                        <h5 class="card-title">Teams</h5>
                        <p class="display-4 fw-bold text-danger mb-0">{{ $stats['total_teams'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('f1.circuits') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 dashboard-card-hover">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-geo-alt fs-1 text-success"></i>
                        </div>
                        <h5 class="card-title">Circuits</h5>
                        <p class="display-4 fw-bold text-success mb-0">{{ $stats['total_circuits'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('f1.seasons') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 dashboard-card-hover">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-calendar fs-1 text-warning"></i>
                        </div>
                        <h5 class="card-title">Seasons</h5>
                        <p class="display-4 fw-bold text-warning mb-0">{{ $stats['total_seasons'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        <!-- New Races card -->
        <div class="col">
            <a href="{{ route('f1.races') }}" class="text-decoration-none">
                <div class="card border-0 shadow-sm h-100 dashboard-card-hover">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-flag fs-1 text-primary"></i>
                        </div>
                        <h5 class="card-title">Races</h5>
                        <!-- DEBUG: If total_races is missing from the controller, show 0 to avoid an empty card -->
                        <p class="display-4 fw-bold text-primary mb-0">{{ $stats['total_races'] ?? \App\Models\Race::count() }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-danger text-white">
                    <h5 class="card-title mb-0">Latest Drivers</h5>
                </div>
                <div class="card-body">
                    @forelse($latestDrivers as $driver)
                        <a href="{{ route('f1.driver.show', $driver) }}" class="text-decoration-none">
                            <div class="d-flex align-items-center p-2 mb-2 bg-light rounded hover-shadow">
                                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px;">
                                    {{ $driver->code }}
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-dark">{{ $driver->full_name }}</div>
                                    <small class="text-muted">#{{ $driver->driver_number }} | {{ $driver->nationality }}</small>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-muted">No drivers found.</p>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Latest Teams</h5>
                </div>
                <div class="card-body">
                    @forelse($latestTeams as $team)
                        <a href="{{ route('f1.team.show', $team) }}" class="text-decoration-none">
                            <div class="d-flex align-items-center p-2 mb-2 bg-light rounded hover-shadow">
                                <div class="bg-primary text-white rounded d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px;">
                                    {{ $team->code }}
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-dark">{{ $team->name }}</div>
                                    <small class="text-muted">{{ $team->country }}</small>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-muted">No teams found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Force top stat cards into a single responsive flex row on large screens so they fit cleanly */
.stats-flex {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;       /* default: allow wrapping on small screens */
    align-items: stretch;
    margin-left: -0.5rem;  /* small negative margins to counter card spacing if needed */
    margin-right: -0.5rem;
}
.stats-flex > .col {
    /* let each item take equal available space and shrink when necessary */
    flex: 1 1 0;
    min-width: 0; /* allow children to shrink below their content width */
    padding-left: 0.5rem;
    padding-right: 0.5rem;
}
.stats-flex .card {
    height: 100%;
    display: flex;
    flex-direction: column;
}

/* On large screens keep them on a single non-wrapping line and allow shrink-to-fit */
@media (min-width: 992px) {
    .stats-flex {
        flex-wrap: nowrap;
        justify-content: space-between;
    }
    .stats-flex > .col {
        flex: 1 1 0;
    }
}

/* Keep hover styles */
.dashboard-card-hover {
    transition: all 0.3s ease;
}
.dashboard-card-hover:hover {
    background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 0, 0, 0.6);
}
.hover-shadow:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
</style>
@endsection
