@extends('layouts.app')

@section('content')
<style>
body {
    background: url('/img/sitebg.gif') no-repeat center center fixed !important;
    background-size: cover !important;
    position: relative;
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
    background: rgba(0, 0, 0, 0.4);
    pointer-events: none;
}
.container.py-5 {
    position: relative;
    z-index: 1;
}
</style>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">Formula 1 Races</h1>
            <p class="text-muted">Browse races, view winners and race details</p>
        </div>
        <a href="{{ route('f1.dashboard') }}" class="btn btn-secondary">← Back to Dashboard</a>
    </div>

    <!-- Search & Sort (same styling as other index pages) -->
    <form method="GET" action="{{ route('f1.races') }}" class="row g-3 mb-4 align-items-center">
        <div class="col-md-6">
            <div class="input-group">
                <input
                    type="search"
                    name="q"
                    value="{{ $filters['q'] ?? '' }}"
                    class="form-control"
                    placeholder="Search races, circuit, season or winner..."
                    aria-label="Search races">
                <button class="btn btn-outline-secondary" type="submit" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-6 text-md-end">
            <div class="d-inline-flex align-items-center">
                <label for="sort" class="me-2 mb-0 text-muted">Sort by</label>

                <select id="sort" name="sort" class="form-select form-select-sm me-2" style="width:auto; display:inline-block;">
                    <option value="date" {{ ( $filters['sort'] ?? 'date') === 'date' ? 'selected' : '' }}>Date</option>
                    <option value="name" {{ ( $filters['sort'] ?? '') === 'name' ? 'selected' : '' }}>Race name</option>
                    <option value="season" {{ ( $filters['sort'] ?? '') === 'season' ? 'selected' : '' }}>Season</option>
                    <option value="circuit" {{ ( $filters['sort'] ?? '') === 'circuit' ? 'selected' : '' }}>Circuit</option>
                    <option value="status" {{ ( $filters['sort'] ?? '') === 'status' ? 'selected' : '' }}>Status</option>
                </select>

                <select id="dir" name="dir" class="form-select form-select-sm me-2" style="width:auto; display:inline-block;">
                    <option value="desc" {{ ( $filters['dir'] ?? 'desc') === 'desc' ? 'selected' : '' }}>Desc</option>
                    <option value="asc" {{ ( $filters['dir'] ?? '') === 'asc' ? 'selected' : '' }}>Asc</option>
                </select>

                <button class="btn btn-outline-secondary btn-sm" type="submit">Apply</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse($races as $race)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-shadow">
                    <a href="{{ route('f1.race.show', $race) }}" class="text-decoration-none">
                        <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5 class="card-title mb-0 text-white fw-bold">{{ $race->name }}</h5>
                                    @if($race->full_name)
                                        <small class="text-white-50">{{ $race->full_name }}</small>
                                    @endif
                                </div>
                                <div class="text-end">
                                    <div class="small text-white-50">
                                        {{ optional($race->race_date)->format('M d, Y') ?? 'TBD' }}
                                    </div>
                                    <div class="mt-1">
                                        <span class="badge bg-{{ $race->status === 'Completed' ? 'success' : ($race->status === 'Scheduled' ? 'primary' : 'secondary') }}">
                                            {{ $race->status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                    <div class="card-body">
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-info">Circuit</div>
                                    <div class="fw-bold">{{ optional($race->circuit)->name ?? 'Unknown' }}</div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-primary">Season</div>
                                    <div class="fw-bold">{{ optional($race->season)->year ?? 'Unknown' }}</div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-warning">Round</div>
                                    <div class="fw-bold">{{ $race->round_number ?? '-' }}</div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-danger">Laps</div>
                                    <div class="fw-bold">{{ $race->laps ?? '-' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <div class="small text-muted mb-2">Winner</div>
                            @php
                                $winner = $race->raceResults->firstWhere('position', 1);
                            @endphp
                            <div class="fw-semibold">
                                {{ optional($winner?->driver)->full_name ?? 'TBD' }}
                            </div>
                            <div class="small text-muted mt-2">
                                <a href="{{ route('f1.races') }}" class="text-decoration-none text-muted">View all races</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-flag-fill fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No races found</h4>
                    <p class="text-muted">There are currently no races in the database.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
.driver-header-hover:hover {
    background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 0, 0, 0.6);
}
.driver-header-hover:hover .bg-white {
    background: white !important;
    color: #ff0000 !important;
}
.hover-shadow:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
</style>
@endsection
