@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">{{ $driver->full_name }}</h1>
            <p class="text-muted">Complete driver profile and career statistics</p>
        </div>
        <a href="{{ route('f1.drivers') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to Drivers
        </a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-danger text-white">
                    <div class="d-flex align-items-center">
                        <div class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 60px; height: 60px;">
                            {{ $driver->code }}
                        </div>
                        <div>
                            <h5 class="card-title mb-0">{{ $driver->full_name }}</h5>
                            <small>#{{ $driver->driver_number }} | {{ $driver->nationality }}</small>
                            @if($driver->team)
                                <br><small>{{ $driver->team->name }}</small>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-warning">Championships</div>
                                <div class="fw-bold">{{ $driver->world_championships }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-danger">Wins</div>
                                <div class="fw-bold">{{ $driver->wins }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-success">Podiums</div>
                                <div class="fw-bold">{{ $driver->podiums }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded text-center">
                                <div class="fw-bold text-primary">Points</div>
                                <div class="fw-bold">{{ $driver->career_points }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="border-top pt-3">
                        <h6 class="fw-bold mb-2">Driver Details</h6>
                        <div class="row g-2 text-sm">
                            <div class="col-6">
                                <div class="text-muted">Date of Birth</div>
                                <div class="fw-semibold">{{ optional($driver->date_of_birth)->format('M d, Y') ?? 'Unknown' }}</div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted">Place of Birth</div>
                                <div class="fw-semibold">{{ $driver->place_of_birth ?? 'Unknown' }}</div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted">Debut Year</div>
                                <div class="fw-semibold">{{ optional($driver->debut_year)->format('Y') ?? 'Unknown' }}</div>
                            </div>
                            <div class="col-6">
                                <div class="text-muted">Status</div>
                                <div class="fw-semibold">{{ $driver->is_active ? 'Active' : 'Retired' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">Race Statistics</h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="display-4 fw-bold text-primary">{{ $stats['total_races'] }}</div>
                        <div class="text-muted">Total Races</div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="text-center p-2 bg-light rounded">
                                <div class="fw-bold text-warning">{{ $stats['wins'] }}</div>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Race Results -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="card-title mb-0">Race Results</h5>
        </div>
        <div class="card-body">
            @if($driver->raceResults->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Race</th>
                                <th>Season</th>
                                <th>Position</th>
                                <th>Team</th>
                                <th>Points</th>
                                <th>Fastest Lap</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($driver->raceResults->sortByDesc('race.race_date') as $result)
                                <tr>
                                    <td>
                                        <a href="{{ route('f1.races') }}" class="text-decoration-none">
                                            {{ $result->race->name }}
                                        </a>
                                    </td>
                                    <td>{{ optional($result->race->season)->year ?? 'Unknown' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $result->position == 1 ? 'warning' : ($result->position <= 3 ? 'success' : 'secondary') }}">
                                            {{ $result->position_text }}
                                        </span>
                                    </td>
                                    <td>{{ optional($result->team)->name ?? 'Unknown' }}</td>
                                    <td>{{ $result->points }}</td>
                                    <td>
                                        @if($result->fastest_lap)
                                            <span class="badge bg-info">Yes</span>
                                        @else
                                            <span class="text-muted">No</span>
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
                    <h4 class="mt-3 text-muted">No Race Results</h4>
                    <p class="text-muted">This driver hasn't participated in any races yet.</p>
                </div>
            @endif
        </div>
    </div>

    @if($driver->bio)
    <!-- Biography -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-info text-white">
            <h5 class="card-title mb-0">Biography</h5>
        </div>
        <div class="card-body">
            <p>{{ $driver->bio }}</p>
        </div>
    </div>
    @endif
</div>
@endsection
