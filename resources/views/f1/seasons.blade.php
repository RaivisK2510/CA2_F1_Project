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
    background: rgba(0, 0, 0, 0.5);
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
            <h1 class="display-5 fw-bold mb-2">F1 Seasons</h1>
            <p class="text-muted">Explore Formula 1 seasons, champions, and race statistics</p>
        </div>
        <a href="{{ route('f1.dashboard') }}" class="btn btn-secondary">← Back to Dashboard</a>
    </div>

    <form method="GET" action="{{ route('f1.seasons') }}" class="row g-3 mb-4 align-items-center">
        <div class="col-md-6">
            <div class="input-group">
                <input
                    type="search"
                    name="q"
                    value="{{ $filters['q'] ?? '' }}"
                    class="form-control"
                    placeholder="Search seasons by year, champion or description..."
                    aria-label="Search seasons">
                <button class="btn btn-outline-secondary" type="submit" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-6 text-md-end">
            <div class="d-inline-flex align-items-center">
                <label for="sort" class="me-2 mb-0 text-muted">Sort by</label>

                <select id="sort" name="sort" class="form-select form-select-sm me-2" style="width:auto; display:inline-block;">
                    <option value="year" {{ ( $filters['sort'] ?? 'year') === 'year' ? 'selected' : '' }}>Year</option>
                    <option value="races" {{ ( $filters['sort'] ?? '') === 'races' ? 'selected' : '' }}>Total Races</option>
                    <option value="completed" {{ ( $filters['sort'] ?? '') === 'completed' ? 'selected' : '' }}>Completed Races</option>
                    <option value="active" {{ ( $filters['sort'] ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                </select>

                <select id="dir" name="dir" class="form-select form-select-sm me-2" style="width:auto; display:inline-block;">
                    <option value="asc" {{ ( $filters['dir'] ?? 'desc') === 'asc' ? 'selected' : '' }}>Asc</option>
                    <option value="desc" {{ ( $filters['dir'] ?? 'desc') === 'desc' ? 'selected' : '' }}>Desc</option>
                </select>

                <button class="btn btn-outline-secondary btn-sm" type="submit">Apply</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse($seasons as $season)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-shadow">
                    <a href="{{ route('f1.season.show', $season) }}" class="text-decoration-none">
                        <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0 text-white fw-bold">{{ $season->year }}</h5>
                                @if($season->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Completed</span>
                                @endif
                            </div>
                            @if($season->description)
                                <small class="text-white-50">{{ $season->description }}</small>
                            @endif
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-primary">Total Races</div>
                                    <div class="fw-bold">{{ $season->total_races }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-success">Completed</div>
                                    <div class="fw-bold">{{ $season->completed_races }}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-info">Progress</div>
                                    <div class="progress mt-1" style="height: 6px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $season->completion_percentage }}%" aria-valuenow="{{ $season->completion_percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="fw-bold small mt-1">{{ $season->completion_percentage }}%</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-2">Champions</h6>
                            <div class="row g-2 text-sm">
                                @if($season->championDriver)
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="text-muted small">Driver Champion</div>
                                                <div class="fw-semibold">{{ $season->championDriver->full_name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($season->championTeam)
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <div class="text-muted small">Team Champion</div>
                                                <div class="fw-semibold">{{ $season->championTeam->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <div class="text-muted small">Season Dates</div>
                                            <div class="fw-semibold">
                                                {{ optional($season->start_date)->format('M d, Y') ?? 'TBA' }}
                                                -
                                                {{ optional($season->end_date)->format('M d, Y') ?? 'TBA' }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No seasons found</h4>
                    <p class="text-muted">There are currently no seasons in the database.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
.driver-header-hover:hover, .team-header-hover:hover, .season-header-hover:hover {
    background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 0, 0, 0.6);
}
.driver-header-hover:hover .bg-white.text-primary,
.team-header-hover:hover .bg-white.text-primary,
.season-header-hover:hover .bg-white {
    background: white !important;
    color: #ff0000 !important;
}

.hover-shadow:hover {
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}
</style>

@endsection
