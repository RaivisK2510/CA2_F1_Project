@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-4">
            @if($season->season_image)
                <img src="{{ $season->season_image }}" alt="{{ $season->year }} Season" class="rounded" style="max-width: 150px; height: auto; object-fit: contain;" onerror="this.style.display='none'">
            @endif
            <div>
                <h1 class="display-5 fw-bold mb-2">{{ $season->year }} Season</h1>
                <p class="text-muted">Complete season overview and race results</p>
            </div>
        </div>
        <div class="d-flex gap-2">
            @auth
                <button class="btn btn-warning favorite-btn"
                        id="favorite-btn-{{ $season->id }}"
                        data-model="season"
                        data-id="{{ $season->id }}"
                        data-favorited="{{ Auth::user()->hasFavorited($season) ? 'true' : 'false' }}"
                        onclick="toggleFavorite('season', {{ $season->id }})">
                    <i class="bi bi-star{{ Auth::user()->hasFavorited($season) ? '-fill' : '' }}"></i>
                    {{ Auth::user()->hasFavorited($season) ? 'Favorited' : 'Favorite' }}
                </button>
            @endauth
            <a href="{{ route('f1.seasons') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Seasons
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex align-items-center">
                        <div class="bg-dark text-white rounded d-flex align-items-center justify-content-center fw-bold me-3" style="width: 60px; height: 60px;">
                            {{ $season->year }}
                        </div>
                        <div>
                            <h5 class="card-title mb-0 fw-bold">{{ $season->year }} Formula 1 Season</h5>
                            <small>
                                @if($season->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Completed</span>
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
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
                    </div>

                    <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: {{ $stats['completion_pct'] }}%">
                            {{ $stats['completion_pct'] }}%
                        </div>
                    </div>

                    @if($season->championDriver)
                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-2">Champions</h6>
                            <div class="row g-2">
                                <div class="col-6">
                                    <a href="{{ route('f1.driver.show', $season->championDriver) }}" class="text-decoration-none">
                                        <div class="p-2 bg-light rounded">
                                            <div class="text-muted small">Driver's Champion</div>
                                            <div class="fw-bold">{{ $season->championDriver->full_name }}</div>
                                        </div>
                                    </a>
                                </div>
                                @if($season->championTeam)
                                    <div class="col-6">
                                        <a href="{{ route('f1.team.show', $season->championTeam) }}" class="text-decoration-none">
                                            <div class="p-2 bg-light rounded">
                                                <div class="text-muted small">Constructor's Champion</div>
                                                <div class="fw-bold">{{ $season->championTeam->name }}</div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if($season->description)
                        <div class="border-top pt-3 mt-3">
                            <h6 class="fw-bold mb-2">About</h6>
                            <p class="text-muted">{{ $season->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Season Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="display-4 fw-bold text-warning">{{ $stats['total_races'] }}</div>
                        <div class="text-muted">Total Races</div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-success">{{ $stats['completed_races'] }}</div>
                                <small class="text-muted">Completed</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-info">{{ $stats['completion_pct'] }}%</div>
                                <small class="text-muted">Progress</small>
                            </div>
                        </div>
                    </div>
                    @if($season->start_date)
                        <div class="mt-3 p-2 bg-light rounded text-center">
                            <div class="text-muted">Start Date</div>
                            <div class="fw-bold">{{ $season->start_date->format('M d, Y') }}</div>
                        </div>
                    @endif
                    @if($season->end_date)
                        <div class="mt-2 p-2 bg-light rounded text-center">
                            <div class="text-muted">End Date</div>
                            <div class="fw-bold">{{ $season->end_date->format('M d, Y') }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Races in this Season -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-danger text-white">
            <h5 class="card-title mb-0">Races</h5>
        </div>
        <div class="card-body">
            @if($season->races->count() > 0)
                @foreach($season->races->sortBy('round_number') as $race)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <a href="{{ route('f1.race.show', $race) }}" class="text-decoration-none">
                                <h6 class="mb-0 fw-bold">
                                    <span class="badge bg-secondary me-2">R{{ $race->round_number }}</span>
                                    {{ $race->name }}
                                </h6>
                            </a>
                            <div class="d-flex align-items-center gap-2">
                                <small class="text-muted">{{ $race->race_date ? $race->race_date->format('M d, Y') : 'TBD' }}</small>
                                <span class="badge bg-{{ $race->is_completed ? 'success' : 'warning' }}">{{ $race->status }}</span>
                            </div>
                        </div>
                        <div class="row g-2">
                            <div class="col-md-4">
                                <div class="p-2 bg-light rounded">
                                    <div class="text-muted small">Circuit</div>
                                    <div class="fw-bold small">{{ optional($race->circuit)->name ?? 'TBD' }}</div>
                                </div>
                            </div>
                            @if($race->raceResults->count() > 0)
                                @foreach($race->raceResults->sortBy('position')->take(3) as $result)
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center p-2 bg-light rounded">
                                            <span class="badge bg-{{ $result->position == 1 ? 'warning' : ($result->position <= 3 ? 'success' : 'secondary') }} me-2">
                                                P{{ $result->position }}
                                            </span>
                                            <div>
                                                <div class="fw-bold small">{{ optional($result->driver)->full_name ?? 'Unknown' }}</div>
                                                <small class="text-muted">{{ $result->points }} pts</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No Races</h4>
                    <p class="text-muted">No races have been scheduled for this season.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
body {
    background: url('/img/sitebg.gif') no-repeat center center fixed;
    background-size: cover;
}
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 0;
    pointer-events: none;
}
.container.py-5 {
    position: relative;
    z-index: 1;
    background-color: rgba(255, 255, 255, 0.85);
    border-radius: 12px;
    padding-top: 2rem !important;
    padding-bottom: 2rem !important;
    margin-top: 1rem;
    margin-bottom: 1rem;
}
</style>

<script>
    function toggleFavorite(model, id) {
        const btn = document.getElementById(`favorite-btn-${id}`);

        // Prevent multiple rapid clicks
        if (btn.disabled) return;
        btn.disabled = true;

        fetch(`/favorites/${model}/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const icon = btn.querySelector('i');
                const isFavorited = data.is_favorited;

                // Update button appearance
                if (isFavorited) {
                    icon.className = 'bi bi-star-fill';
                    btn.textContent = '';
                    btn.appendChild(icon);
                    btn.appendChild(document.createTextNode(' Favorited'));
                } else {
                    icon.className = 'bi bi-star';
                    btn.textContent = '';
                    btn.appendChild(icon);
                    btn.appendChild(document.createTextNode(' Favorite'));
                }
            } else {
                alert('Error: ' + (data.message || 'Failed to update favorite'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to update favorite. Please try again.');
        })
        .finally(() => {
            btn.disabled = false;
        });
    }
</script>
@endsection
