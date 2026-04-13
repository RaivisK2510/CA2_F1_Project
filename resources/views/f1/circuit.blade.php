@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">{{ $circuit->name }}</h1>
            <p class="text-muted">{{ $circuit->full_name }}</p>
        </div>
        <div class="d-flex gap-2">
            @auth
                <button class="btn btn-warning favorite-btn"
                        id="favorite-btn-{{ $circuit->id }}"
                        data-model="circuit"
                        data-id="{{ $circuit->id }}"
                        data-favorited="{{ Auth::user()->hasFavorited($circuit) ? 'true' : 'false' }}"
                        onclick="toggleFavorite('circuit', {{ $circuit->id }})">
                    <i class="bi bi-star{{ Auth::user()->hasFavorited($circuit) ? '-fill' : '' }}"></i>
                    {{ Auth::user()->hasFavorited($circuit) ? 'Favorited' : 'Favorite' }}
                </button>
            @endauth
            <a href="{{ route('f1.circuits') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to Circuits
            </a>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded d-flex align-items-center justify-content-center fw-bold me-3" style="width: 60px; height: 60px;">
                            {{ substr($circuit->name, 0, 3) }}
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $circuit->name }}</h5>
                            <small>{{ $circuit->city }}, {{ $circuit->country }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-primary">Country</div>
                                <div class="fw-bold">{{ $circuit->country }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-info">City</div>
                                <div class="fw-bold">{{ $circuit->city }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-danger">Length</div>
                                <div class="fw-bold">{{ $circuit->length_km }} km</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-warning">Corners</div>
                                <div class="fw-bold">{{ $circuit->corners }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-success">DRS Zones</div>
                                <div class="fw-bold">{{ $circuit->drs_zones }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-secondary">Direction</div>
                                <div class="fw-bold">{{ $circuit->direction }}</div>
                            </div>
                        </div>
                    </div>

                    @if($circuit->lap_record_seconds)
                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-2">Lap Record</h6>
                            <div class="row g-2 text-sm">
                                <div class="col-4">
                                    <div class="text-muted">Time</div>
                                    <div class="fw-semibold">{{ $circuit->lap_record_time }}</div>
                                </div>
                                <div class="col-4">
                                    <div class="text-muted">Driver</div>
                                    <div class="fw-semibold">{{ $circuit->lap_record_driver ?? 'Unknown' }}</div>
                                </div>
                                <div class="col-4">
                                    <div class="text-muted">Year</div>
                                    <div class="fw-semibold">{{ $circuit->lap_record_year ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($circuit->description)
                        <div class="border-top pt-3 mt-3">
                            <h6 class="fw-bold mb-2">About</h6>
                            <p class="text-muted">{{ $circuit->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Circuit Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="display-4 fw-bold text-success">{{ $stats['total_races'] }}</div>
                        <div class="text-muted">Total Races Held</div>
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
                                <div class="fw-bold text-info">{{ $circuit->races_held ?? 0 }}</div>
                                <small class="text-muted">Races Held</small>
                            </div>
                        </div>
                    </div>
                    @if($circuit->first_grand_prix)
                        <div class="mt-3 p-2 bg-light rounded text-center">
                            <div class="text-muted">First Grand Prix</div>
                            <div class="fw-bold">{{ $circuit->first_grand_prix }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Races at this Circuit -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-warning text-white">
            <h5 class="card-title mb-0">Races at this Circuit</h5>
        </div>
        <div class="card-body">
            @if($circuit->races->count() > 0)
                @foreach($circuit->races->sortByDesc('race_date') as $race)
                    <div class="border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <a href="{{ route('f1.race.show', $race) }}" class="text-decoration-none">
                                <h6 class="mb-0 fw-bold">{{ $race->name }}</h6>
                            </a>
                            <small class="text-muted">{{ optional($race->season)->year ?? 'Unknown' }} | {{ $race->race_date ? $race->race_date->format('M d, Y') : 'TBD' }}</small>
                        </div>
                        @if($race->raceResults->count() > 0)
                            <div class="row g-2">
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
                            </div>
                        @else
                            <p class="text-muted mb-0">No results available</p>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="text-center py-5">
                    <i class="bi bi-flag fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No Races</h4>
                    <p class="text-muted">No races have been held at this circuit yet.</p>
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
