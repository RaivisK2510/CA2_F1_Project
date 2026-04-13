@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Driver Profile: {{ $driver->full_name }}</h4>
                    <div>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Admin
                        </a>
                        <a href="{{ route('admin.f1.drivers.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-list"></i> All Drivers
                        </a>
                        <a href="{{ route('admin.f1.drivers.edit', $driver) }}" class="btn btn-primary">
                            <i class="bi bi-pencil"></i> Edit Driver
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <!-- Driver Basic Info -->
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center mb-3">
                                <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 80px; height: 80px; font-size: 1.5rem;">
                                    {{ $driver->code }}
                                </div>
                                <div>
                                    <h2 class="mb-1">{{ $driver->full_name }}</h2>
                                    <p class="text-muted mb-0">#{{ $driver->driver_number }} | {{ $driver->nationality }}</p>
                                    @if($driver->team)
                                        <p class="mb-0"><strong>Team:</strong> {{ $driver->team->name }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-end">
                                @if($driver->is_active)
                                    <span class="badge bg-success fs-6">Active</span>
                                @else
                                    <span class="badge bg-secondary fs-6">Inactive</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Career Statistics -->
                    <div class="row mb-4">
                        <div class="col-12">
                            <h5 class="mb-3">Career Statistics</h5>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['total_races'] }}</h4>
                                    <small>Races</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['wins'] }}</h4>
                                    <small>Wins</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['podiums'] }}</h4>
                                    <small>Podiums</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['points'] }}</h4>
                                    <small>Points</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card bg-secondary text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $stats['fastest_laps'] }}</h4>
                                    <small>Fastest Laps</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-dark text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $driver->world_championships }}</h4>
                                    <small>World Championships</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body text-center">
                                    <h4>{{ $driver->pole_positions }}</h4>
                                    <small>Pole Positions</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Personal Information -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5 class="mb-3">Personal Information</h5>
                            <table class="table table-striped">
                                <tr>
                                    <td><strong>Date of Birth:</strong></td>
                                    <td>{{ optional($driver->date_of_birth)->format('M d, Y') ?? 'Unknown' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Place of Birth:</strong></td>
                                    <td>{{ $driver->place_of_birth ?? 'Unknown' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nationality:</strong></td>
                                    <td>{{ $driver->nationality }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Height:</strong></td>
                                    <td>{{ $driver->height_cm }} cm</td>
                                </tr>
                                <tr>
                                    <td><strong>Weight:</strong></td>
                                    <td>{{ $driver->weight_kg }} kg</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5 class="mb-3">Career Information</h5>
                            <table class="table table-striped">
                                <tr>
                                    <td><strong>Debut Year:</strong></td>
                                    <td>{{ optional($driver->debut_year)->format('Y') ?? 'Unknown' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Retirement Year:</strong></td>
                                    <td>{{ optional($driver->retirement_year)->format('Y') ?? 'Still Active' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status:</strong></td>
                                    <td>{{ $driver->is_active ? 'Active' : 'Retired' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Race Results -->
                    <div class="row">
                        <div class="col-12">
                            <h5 class="mb-3">Race Results</h5>
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
                                                <th>Status</th>
                                                <th>Fastest Lap</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($driver->raceResults->sortByDesc('race.race_date') as $result)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('admin.f1.races.edit', $result->race) }}" class="text-decoration-none">
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
                                                    <td>{{ $result->status }}</td>
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
                                <p class="text-muted">No race results found for this driver.</p>
                            @endif
                        </div>
                    </div>

                    @if($driver->bio)
                    <!-- Biography -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <h5 class="mb-3">Biography</h5>
                            <div class="card">
                                <div class="card-body">
                                    <p>{{ $driver->bio }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
