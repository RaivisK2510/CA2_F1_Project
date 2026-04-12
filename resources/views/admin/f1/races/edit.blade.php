@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Race: {{ $race->name }}</h4>
                    <a href="{{ route('admin.f1.races.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Races
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.races.update', $race) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Race Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $race->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                           id="full_name" name="full_name" value="{{ old('full_name', $race->full_name) }}" required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="official_name" class="form-label">Official Name</label>
                                    <input type="text" class="form-control @error('official_name') is-invalid @enderror"
                                           id="official_name" name="official_name" value="{{ old('official_name', $race->official_name) }}">
                                    @error('official_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="round_number" class="form-label">Round</label>
                                    <input type="number" class="form-control @error('round_number') is-invalid @enderror"
                                           id="round_number" name="round_number" value="{{ old('round_number', $race->round_number) }}" min="1" max="25" required>
                                    @error('round_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="race_date" class="form-label">Race Date</label>
                                    <input type="date" class="form-control @error('race_date') is-invalid @enderror"
                                           id="race_date" name="race_date" value="{{ old('race_date', $race->race_date?->format('Y-m-d')) }}" required>
                                    @error('race_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="race_time" class="form-label">Race Time</label>
                                    <input type="time" class="form-control @error('race_time') is-invalid @enderror"
                                           id="race_time" name="race_time" value="{{ old('race_time', $race->race_time?->format('H:i')) }}">
                                    @error('race_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="laps" class="form-label">Laps</label>
                                    <input type="number" class="form-control @error('laps') is-invalid @enderror"
                                           id="laps" name="laps" value="{{ old('laps', $race->laps) }}" min="1" required>
                                    @error('laps')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="race_distance_km" class="form-label">Distance (km)</label>
                                    <input type="number" step="0.1" class="form-control @error('race_distance_km') is-invalid @enderror"
                                           id="race_distance_km" name="race_distance_km" value="{{ old('race_distance_km', $race->race_distance_km) }}" min="0" required>
                                    @error('race_distance_km')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="season_id" class="form-label">Season</label>
                                    <select class="form-select @error('season_id') is-invalid @enderror" id="season_id" name="season_id" required>
                                        <option value="">Choose season</option>
                                        @foreach($seasons as $season)
                                            <option value="{{ $season->id }}" {{ old('season_id', $race->season_id) == $season->id ? 'selected' : '' }}>
                                                {{ $season->year }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('season_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="circuit_id" class="form-label">Circuit</label>
                                    <select class="form-select @error('circuit_id') is-invalid @enderror" id="circuit_id" name="circuit_id" required>
                                        <option value="">Choose circuit</option>
                                        @foreach($circuits as $circuit)
                                            <option value="{{ $circuit->id }}" {{ old('circuit_id', $race->circuit_id) == $circuit->id ? 'selected' : '' }}>
                                                {{ $circuit->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('circuit_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="weather_conditions" class="form-label">Weather</label>
                                    <input type="text" class="form-control @error('weather_conditions') is-invalid @enderror"
                                           id="weather_conditions" name="weather_conditions" value="{{ old('weather_conditions', $race->weather_conditions) }}">
                                    @error('weather_conditions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="race_report" class="form-label">Race Report</label>
                                    <textarea class="form-control @error('race_report') is-invalid @enderror" id="race_report" name="race_report" rows="3">{{ old('race_report', $race->race_report) }}</textarea>
                                    @error('race_report')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input @error('is_completed') is-invalid @enderror" type="checkbox" id="is_completed" name="is_completed" value="1" {{ old('is_completed', $race->is_completed) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_completed">Completed</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input @error('is_cancelled') is-invalid @enderror" type="checkbox" id="is_cancelled" name="is_cancelled" value="1" {{ old('is_cancelled', $race->is_cancelled) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_cancelled">Cancelled</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input @error('is_active') is-invalid @enderror" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $race->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Active</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mb-4">
                            <a href="{{ route('admin.f1.races.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Race</button>
                        </div>
                    </form>

                    <div class="card mt-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Race Results</h5>
                            <a href="{{ route('admin.f1.races.results.create', $race) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-plus"></i> Add Result
                            </a>
                        </div>
                        <div class="card-body">
                            @if($raceResults->isEmpty())
                                <p class="text-muted">No results have been recorded for this race yet.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-sm table-striped">
                                        <thead>
                                            <tr>
                                                <th>Position</th>
                                                <th>Driver</th>
                                                <th>Team</th>
                                                <th>Status</th>
                                                <th>Points</th>
                                                <th>Fastest Lap</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($raceResults as $result)
                                                <tr>
                                                    <td>{{ $result->position_display }}</td>
                                                    <td>{{ optional($result->driver)->name ?? 'Unknown' }}</td>
                                                    <td>{{ optional($result->team)->name ?? 'Unknown' }}</td>
                                                    <td>{{ $result->status }}</td>
                                                    <td>{{ $result->points }}</td>
                                                    <td>{{ $result->fastest_lap ? 'Yes' : 'No' }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.f1.race_results.edit', $result) }}" class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('admin.f1.race_results.destroy', $result) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this result?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
