@extends('layouts.app')

@section('content')
@php
use App\Models\Driver;
@endphp
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">{{ $team->name }}</h1>
            <p class="text-muted">Complete team profile and performance statistics</p>
        </div>
        <div class="d-flex gap-2">
            @auth
                <button class="btn btn-warning favorite-btn"
                        id="favorite-btn-{{ $team->id }}"
                        data-model="team"
                        data-id="{{ $team->id }}"
                        data-favorited="{{ Auth::user()->hasFavorited($team) ? 'true' : 'false' }}"
                        onclick="toggleFavorite('team', {{ $team->id }})">
                    <i class="bi bi-star{{ Auth::user()->hasFavorited($team) ? '-fill' : '' }}"></i>
                    {{ Auth::user()->hasFavorited($team) ? 'Favorited' : 'Favorite' }}
                </button>
            @endauth
            <a href="{{ route('f1.teams') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Teams
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="bg-white text-primary rounded d-flex align-items-center justify-content-center fw-bold me-3" style="width: 60px; height: 60px;">
                            {{ $team->code }}
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $team->name }}</h5>
                            <small>{{ $team->full_name }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-3">
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
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">Race Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="display-4 fw-bold text-success">{{ $stats['total_races'] }}</div>
                        <div class="text-muted">Total Races</div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-danger">{{ $stats['wins'] }}</div>
                                <small class="text-muted">Wins</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-success">{{ $stats['podiums'] }}</div>
                                <small class="text-muted">Podiums</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-primary">{{ $stats['points'] }}</div>
                                <small class="text-muted">Points</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-info">{{ $stats['fastest_laps'] }}</div>
                                <small class="text-muted">Fastest Laps</small>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <div class="display-6 fw-bold text-warning">{{ $stats['drivers_count'] }}</div>
                        <div class="text-muted">Drivers</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Current Drivers -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="card-title mb-0">Current Drivers</h5>
        </div>
        <div class="card-body">
            @if($team->drivers->count() > 0)
                <div class="row g-3">
                    @foreach($team->drivers as $driver)
                        <div class="col-md-6">
                            <a href="{{ route('f1.driver.show', $driver) }}" class="text-decoration-none">
                                <div class="d-flex align-items-center p-3 bg-light rounded hover-shadow">
                                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px;">
                                        {{ $driver->code }}
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold text-dark">{{ $driver->full_name }}</div>
                                        <small class="text-muted">#{{ $driver->driver_number }} | {{ $driver->nationality }}</small>
                                        <div class="row g-1 mt-2">
                                            <div class="col-3">
                                                <small class="text-muted d-block">Wins</small>
                                                <span class="fw-bold text-danger">{{ $driver->wins }}</span>
                                            </div>
                                            <div class="col-3">
                                                <small class="text-muted d-block">Podiums</small>
                                                <span class="fw-bold text-success">{{ $driver->podiums }}</span>
                                            </div>
                                            <div class="col-3">
                                                <small class="text-muted d-block">Points</small>
                                                <span class="fw-bold text-primary">{{ $driver->career_points }}</span>
                                            </div>
                                            <div class="col-3">
                                                <small class="text-muted d-block">Champs</small>
                                                <span class="fw-bold text-warning">{{ $driver->world_championships }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted">No drivers currently assigned to this team.</p>
            @endif
        </div>
    </div>

    <!-- Race Results -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="card-title mb-0">Race Results</h5>
        </div>
        <div class="card-body">
            @if($team->raceResults->count() > 0)
                @php
                    $groupedResults = $team->raceResults->sortByDesc('race.race_date')->groupBy(function($result) {
                        return $result->race->id;
                    });
                @endphp

                @foreach($groupedResults as $raceId => $results)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="mb-0 fw-bold">{{ $results->first()->race->name }}</h6>
                            <small class="text-muted">{{ optional($results->first()->race->season)->year ?? 'Unknown' }}</small>
                        </div>
                        <div class="row g-2">
                            @foreach($results->sortBy('position') as $result)
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-2 bg-light rounded">
                                        <div class="me-3">
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
                                            <span class="badge bg-{{ $positionBadge }} fs-6">
                                                {{ $positionText }}
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">{{ optional($result->driver)->full_name ?? 'Unknown Driver' }}</div>
                                            <small class="text-muted">{{ $result->points }} pts</small>
                                            @if($result->fastest_lap)
                                                <span class="badge bg-info ms-1">FL</span>
                                            @endif
                                            @if(!empty($result->status) && $result->status != 'Finished')
                                                <span class="badge bg-warning ms-1">{{ $result->status }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <i class="bi bi-flag fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No Race Results</h4>
                    <p class="text-muted">This team hasn't participated in any races yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

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
