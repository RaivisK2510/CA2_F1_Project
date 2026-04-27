@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">F1 Stats Hub</h1>
            <p class="text-muted">Welcome to the Formula 1 statistics dashboard</p>
        </div>
        <div class="d-none d-md-block">
            <img src="https://i.imgur.com/mf5yZBZ.png" alt="F1 Banner" style="max-width: 500px; height: auto; border-radius: 12px;" onerror="this.style.display='none'">
        </div>
    </div>

    <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-5 g-2 g-sm-3 g-lg-4 mb-4">
        <div class="col">
            <a href="{{ route('f1.drivers') }}" class="text-decoration-none d-block h-100">
                <div class="card border-0 shadow-sm h-100 dashboard-card-hover rounded-4 overflow-hidden">
                    <div class="card-body text-center d-flex flex-column align-items-center justify-content-center py-4">
                        <div class="mb-2">
                            <i class="bi bi-person stat-icon text-danger"></i>
                        </div>
                        <h5 class="card-title fs-6 mb-1">Drivers</h5>
                        <p class="fw-bold text-danger mb-0 stat-number">{{ $stats['total_drivers'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('f1.teams') }}" class="text-decoration-none d-block h-100">
                <div class="card border-0 shadow-sm h-100 dashboard-card-hover rounded-4 overflow-hidden">
                    <div class="card-body text-center d-flex flex-column align-items-center justify-content-center py-4">
                        <div class="mb-2">
                            <i class="bi bi-building stat-icon text-danger"></i>
                        </div>
                        <h5 class="card-title fs-6 mb-1">Teams</h5>
                        <p class="fw-bold text-danger mb-0 stat-number">{{ $stats['total_teams'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('f1.circuits') }}" class="text-decoration-none d-block h-100">
                <div class="card border-0 shadow-sm h-100 dashboard-card-hover rounded-4 overflow-hidden">
                    <div class="card-body text-center d-flex flex-column align-items-center justify-content-center py-4">
                        <div class="mb-2">
                            <i class="bi bi-geo-alt stat-icon text-success"></i>
                        </div>
                        <h5 class="card-title fs-6 mb-1">Circuits</h5>
                        <p class="fw-bold text-success mb-0 stat-number">{{ $stats['total_circuits'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('f1.seasons') }}" class="text-decoration-none d-block h-100">
                <div class="card border-0 shadow-sm h-100 dashboard-card-hover rounded-4 overflow-hidden">
                    <div class="card-body text-center d-flex flex-column align-items-center justify-content-center py-4">
                        <div class="mb-2">
                            <i class="bi bi-calendar stat-icon text-warning"></i>
                        </div>
                        <h5 class="card-title fs-6 mb-1">Seasons</h5>
                        <p class="fw-bold text-warning mb-0 stat-number">{{ $stats['total_seasons'] }}</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('f1.races') }}" class="text-decoration-none d-block h-100">
                <div class="card border-0 shadow-sm h-100 dashboard-card-hover rounded-4 overflow-hidden">
                    <div class="card-body text-center d-flex flex-column align-items-center justify-content-center py-4">
                        <div class="mb-2">
                            <i class="bi bi-flag stat-icon text-primary"></i>
                        </div>
                        <h5 class="card-title fs-6 mb-1">Races</h5>
                        <p class="fw-bold text-primary mb-0 stat-number">{{ $stats['total_races'] ?? \App\Models\Race::count() }}</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Latest Drivers</h5>
                </div>
                <div class="card-body">
                    @forelse($latestDrivers as $driver)
                        <a href="{{ route('f1.driver.show', $driver) }}" class="text-decoration-none">
                            <div class="d-flex align-items-center p-2 mb-2 bg-light rounded hover-shadow">
                                <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px;">
                                    {{ $driver->code }}
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-white">{{ $driver->full_name }}</div>
                                    <small class="text-white-50">#{{ $driver->driver_number }} | {{ $driver->nationality }}</small>
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
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Latest Teams</h5>
                </div>
                <div class="card-body">
                    @forelse($latestTeams as $team)
                        <a href="{{ route('f1.team.show', $team) }}" class="text-decoration-none">
                            <div class="d-flex align-items-center p-2 mb-2 bg-light rounded hover-shadow">
                                <div class="bg-white text-primary rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px;">
                                    {{ $team->code }}
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-white">{{ $team->name }}</div>
                                    <small class="text-white-50">{{ $team->country }}</small>
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
/* Responsive icon and number sizing */
.stat-icon {
    font-size: 1.5rem;
}
.stat-number {
    font-size: 1.5rem;
}
@media (min-width: 576px) {
    .stat-icon {
        font-size: 1.75rem;
    }
    .stat-number {
        font-size: 2rem;
    }
}
@media (min-width: 992px) {
    .stat-icon {
        font-size: 2rem;
    }
    .stat-number {
        font-size: 2.5rem;
    }
}

/* Keep hover styles */
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
.container.py-5 {
    position: relative;
    z-index: 1;
}
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
