@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">{{ $race->name }}</h1>
            <p class="text-muted">{{ $race->full_name }}</p>
        </div>
        <div class="d-flex gap-2">
            @auth
                <button class="btn btn-warning favorite-btn"
                        id="favorite-btn-{{ $race->id }}"
                        data-model="race"
                        data-id="{{ $race->id }}"
                        data-favorited="{{ Auth::user()->hasFavorited($race) ? 'true' : 'false' }}"
                        onclick="toggleFavorite('race', {{ $race->id }})">
                    <i class="bi bi-star{{ Auth::user()->hasFavorited($race) ? '-fill' : '' }}"></i>
                    {{ Auth::user()->hasFavorited($race) ? 'Favorited' : 'Favorite' }}
                </button>
            @endauth
            <a href="{{ route('f1.races') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Races
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded d-flex align-items-center justify-content-center fw-bold me-3" style="width: 60px; height: 60px;">
                            R{{ $race->round_number }}
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $race->name }}</h5>
                            <small>{{ optional($race->circuit)->name ?? 'Unknown Circuit' }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-primary">Date</div>
                                <div class="fw-bold">{{ $race->race_date ? $race->race_date->format('M d, Y') : 'TBD' }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-info">Season</div>
                                <div class="fw-bold">
                                    @if($race->season)
                                        <a href="{{ route('f1.season.show', $race->season) }}" class="text-decoration-none text-white">{{ $race->season->year }}</a>
                                    @else
                                        Unknown
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-danger">Laps</div>
                                <div class="fw-bold">{{ $race->laps ?? 'TBD' }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-warning">Distance</div>
                                <div class="fw-bold">{{ $race->race_distance_km ? $race->race_distance_km . ' km' : 'TBD' }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-secondary">Status</div>
                                <div class="fw-bold">
                                    <span class="badge bg-{{ $race->is_completed ? 'success' : ($race->is_cancelled ? 'danger' : 'warning') }}">{{ $race->status }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-success">Circuit</div>
                                <div class="fw-bold">
                                    @if($race->circuit)
                                        <a href="{{ route('f1.circuit.show', $race->circuit) }}" class="text-decoration-none text-white">{{ $race->circuit->name }}</a>
                                    @else
                                        Unknown
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($race->weather_conditions)
                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-2">Weather Conditions</h6>
                            <p class="text-muted">{{ $race->weather_conditions }}</p>
                        </div>
                    @endif

                    @if($race->race_report)
                        <div class="border-top pt-3 mt-3">
                            <h6 class="fw-bold mb-2">Race Report</h6>
                            <p class="text-muted">{{ $race->race_report }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Key Info</h5>
                </div>
                <div class="card-body">
                    @if($race->polePositionDriver)
                        <div class="p-2 bg-light rounded mb-2">
                            <div class="text-muted small">Pole Position</div>
                            <a href="{{ route('f1.driver.show', $race->polePositionDriver) }}" class="text-decoration-none">
                                <div class="fw-bold">{{ $race->polePositionDriver->full_name }}</div>
                            </a>
                        </div>
                    @endif
                    @if($race->fastestLapDriver)
                        <div class="p-2 bg-light rounded mb-2">
                            <div class="text-muted small">Fastest Lap</div>
                            <a href="{{ route('f1.driver.show', $race->fastestLapDriver) }}" class="text-decoration-none">
                                <div class="fw-bold">{{ $race->fastestLapDriver->full_name }}</div>
                            </a>
                            @if($race->fastest_lap_time)
                                <small class="text-muted">{{ $race->fastest_lap_time }}</small>
                            @endif
                        </div>
                    @endif
                    @if($race->raceResults->count() > 0)
                        <div class="p-2 bg-light rounded">
                            <div class="text-muted small">Race Winner</div>
                            @php $winner = $race->raceResults->firstWhere('position', 1); @endphp
                            @if($winner && $winner->driver)
                                <a href="{{ route('f1.driver.show', $winner->driver) }}" class="text-decoration-none">
                                    <div class="fw-bold">{{ $winner->driver->full_name }}</div>
                                </a>
                                <small class="text-muted">{{ optional($winner->team)->name ?? '' }}</small>
                            @else
                                <div class="fw-bold">TBD</div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Race Results -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Race Results</h5>
        </div>
        <div class="card-body">
            @if($race->raceResults->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Pos</th>
                                <th>Driver</th>
                                <th>Team</th>
                                <th>Points</th>
                                <th>Fastest Lap</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($race->raceResults->sortBy('position') as $result)
                                <tr>
                                    <td>
                                        @php
                                            $positionBadge = 'secondary';
                                            $positionText = $result->position_text;
                                            if ($result->position == 1) {
                                                $positionBadge = 'warning';
                                            } elseif ($result->position <= 3) {
                                                $positionBadge = 'success';
                                            } elseif (empty($result->position_text) || $result->position_text == 'DNF' || $result->position_text == 'DNS' || $result->position_text == 'RET') {
                                                $positionBadge = 'danger';
                                                $positionText = 'DNF';
                                            }
                                        @endphp
                                        <span class="badge bg-{{ $positionBadge }}">{{ $positionText }}</span>
                                    </td>
                                    <td>
                                        @if($result->driver)
                                            <a href="{{ route('f1.driver.show', $result->driver) }}" class="text-decoration-none">
                                                {{ $result->driver->full_name }}
                                            </a>
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                    <td>
                                        @if($result->team)
                                            <a href="{{ route('f1.team.show', $result->team) }}" class="text-decoration-none">
                                                {{ $result->team->name }}
                                            </a>
                                        @else
                                            Unknown
                                        @endif
                                    </td>
                                    <td>{{ $result->points }}</td>
                                    <td>
                                        @if($result->fastest_lap)
                                            <span class="badge bg-info">FL</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-flag fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No Results</h4>
                    <p class="text-muted">Results for this race are not available yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>

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
