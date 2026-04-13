@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">F1 Teams</h1>
            <p class="text-muted">Complete list of Formula 1 teams and their performance statistics</p>
        </div>
        <a href="{{ route('f1.dashboard') }}" class="btn btn-secondary">← Back to Dashboard</a>
    </div>

    <form method="GET" action="{{ route('f1.teams') }}" class="row g-3 mb-4 align-items-center">
        <div class="col-md-6">
            <div class="input-group">
                <input
                    type="search"
                    name="q"
                    value="{{ $filters['q'] ?? '' }}"
                    class="form-control"
                    placeholder="Search teams, code or country..."
                    aria-label="Search teams">
                <button class="btn btn-outline-secondary" type="submit" aria-label="Search">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-6 text-md-end">
            <div class="d-inline-flex align-items-center">
                <label for="sort" class="me-2 mb-0 text-muted">Sort by</label>

                <select id="sort" name="sort" class="form-select form-select-sm me-2" style="width:auto; display:inline-block;">
                    <option value="name" {{ ( $filters['sort'] ?? 'name') === 'name' ? 'selected' : '' }}>Name</option>
                    <option value="wins" {{ ( $filters['sort'] ?? '') === 'wins' ? 'selected' : '' }}>Wins</option>
                    <option value="points" {{ ( $filters['sort'] ?? '') === 'points' ? 'selected' : '' }}>Points</option>
                    <option value="championships" {{ ( $filters['sort'] ?? '') === 'championships' ? 'selected' : '' }}>Championships</option>
                    <option value="country" {{ ( $filters['sort'] ?? '') === 'country' ? 'selected' : '' }}>Country</option>
                </select>

                <select id="dir" name="dir" class="form-select form-select-sm me-2" style="width:auto; display:inline-block;">
                    <option value="asc" {{ ( $filters['dir'] ?? 'asc') === 'asc' ? 'selected' : '' }}>Asc</option>
                    <option value="desc" {{ ( $filters['dir'] ?? '') === 'desc' ? 'selected' : '' }}>Desc</option>
                </select>

                <button class="btn btn-outline-secondary btn-sm" type="submit">Apply</button>
            </div>
        </div>
    </form>

    <div class="row g-4">
        @forelse($teams as $team)
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <a href="{{ route('f1.team.show', $team) }}" class="text-decoration-none">
                        <div class="card-header bg-gradient driver-header-hover" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); transition: all 0.3s ease; cursor: pointer;">
                            <div class="d-flex align-items-center">
                                <div class="bg-white text-primary rounded d-flex align-items-center justify-content-center fw-bold me-3" style="width: 50px; height: 50px;">
                                    {{ $team->code }}
                                </div>
                                <div>
                                    <h5 class="card-title mb-0 text-white fw-bold">{{ $team->name }}</h5>
                                    <small class="text-white-50">{{ $team->full_name }}</small>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="card-body">
                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-warning">Championships</div>
                                    <div class="fw-bold">{{ $team->world_championships }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-danger">Wins</div>
                                    <div class="fw-bold">{{ $team->race_wins }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-success">Podiums</div>
                                    <div class="fw-bold">{{ $team->podiums }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-info">Pole Positions</div>
                                    <div class="fw-bold">{{ $team->pole_positions }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-2">Team Details</h6>
                            <div class="row g-2 text-sm">
                                <div class="col-6">
                                    <div class="text-muted">Country</div>
                                    <div class="fw-semibold">{{ $team->country }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">Headquarters</div>
                                    <div class="fw-semibold">{{ $team->headquarters }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">Team Chief</div>
                                    <div class="fw-semibold">{{ $team->team_chief }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">Technical Chief</div>
                                    <div class="fw-semibold">{{ $team->technical_chief }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">Chassis</div>
                                    <div class="fw-semibold">{{ $team->chassis }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">Power Unit</div>
                                    <div class="fw-semibold">{{ $team->power_unit }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-building-x fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No teams found</h4>
                    <p class="text-muted">There are currently no teams in the database.</p>
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
.driver-header-hover:hover .bg-white.text-primary {
    background: white !important;
    color: #ff0000 !important;
}
</style>

@endsection
