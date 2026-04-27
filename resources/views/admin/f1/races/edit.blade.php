@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Race: {{ $race->name }}</h4>
                    <a href="{{ route('admin.f1.races.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Races
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.races.update', $race) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Race Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name', $race->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                           id="full_name" name="full_name" value="{{ old('full_name', $race->full_name) }}" required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="official_name" class="form-label">Official Name (Optional)</label>
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
                                    <label for="round_number" class="form-label">Round <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('round_number') is-invalid @enderror"
                                           id="round_number" name="round_number" value="{{ old('round_number', $race->round_number) }}" min="1" max="25" required>
                                    @error('round_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="race_date" class="form-label">Race Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('race_date') is-invalid @enderror"
                                           id="race_date" name="race_date" value="{{ old('race_date', $race->race_date?->format('Y-m-d')) }}" required>
                                    @error('race_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="race_time" class="form-label">Race Time (Optional)</label>
                                    <input type="time" class="form-control @error('race_time') is-invalid @enderror"
                                           id="race_time" name="race_time" value="{{ old('race_time', $race->race_time?->format('H:i')) }}">
                                    @error('race_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="laps" class="form-label">Laps <span class="text-danger">*</span></label>
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
                                    <label for="race_distance_km" class="form-label">Distance (km) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.1" class="form-control @error('race_distance_km') is-invalid @enderror"
                                           id="race_distance_km" name="race_distance_km" value="{{ old('race_distance_km', $race->race_distance_km) }}" min="0" required>
                                    @error('race_distance_km')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="season_id" class="form-label">Season <span class="text-danger">*</span></label>
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
                                    <label for="circuit_id" class="form-label">Circuit <span class="text-danger">*</span></label>
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
                                    <label for="weather_conditions" class="form-label">Weather (Optional)</label>
                                    <input type="text" class="form-control @error('weather_conditions') is-invalid @enderror"
                                           id="weather_conditions" name="weather_conditions" value="{{ old('weather_conditions', $race->weather_conditions) }}">
                                    @error('weather_conditions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="race_report" class="form-label">Race Report (Optional)</label>
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

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="fastest_lap_time" class="form-label">Fastest Lap Time (Optional)</label>
                                    <input type="text" class="form-control @error('fastest_lap_time') is-invalid @enderror"
                                           id="fastest_lap_time" name="fastest_lap_time" value="{{ old('fastest_lap_time', $race->fastest_lap_time) }}" placeholder="e.g. 1:24.567">
                                    @error('fastest_lap_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="fastest_lap_driver_id" class="form-label">Fastest Lap Driver (Optional)</label>
                                    <select class="form-select @error('fastest_lap_driver_id') is-invalid @enderror" id="fastest_lap_driver_id" name="fastest_lap_driver_id">
                                        <option value="">Select driver</option>
                                        @foreach($seasons as $season)
                                            @foreach($season->drivers ?? [] as $driver)
                                                <option value="{{ $driver->id }}" {{ old('fastest_lap_driver_id', $race->fastest_lap_driver_id) == $driver->id ? 'selected' : '' }}>
                                                    {{ $driver->name }} ({{ $driver->code }})
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('fastest_lap_driver_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="pole_position_time" class="form-label">Pole Position Time (Optional)</label>
                                    <input type="text" class="form-control @error('pole_position_time') is-invalid @enderror"
                                           id="pole_position_time" name="pole_position_time" value="{{ old('pole_position_time', $race->pole_position_time) }}" placeholder="e.g. 1:23.456">
                                    @error('pole_position_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="pole_position_driver_id" class="form-label">Pole Position Driver (Optional)</label>
                                    <select class="form-select @error('pole_position_driver_id') is-invalid @enderror" id="pole_position_driver_id" name="pole_position_driver_id">
                                        <option value="">Select driver</option>
                                        @foreach($seasons as $season)
                                            @foreach($season->drivers ?? [] as $driver)
                                                <option value="{{ $driver->id }}" {{ old('pole_position_driver_id', $race->pole_position_driver_id) == $driver->id ? 'selected' : '' }}>
                                                    {{ $driver->name }} ({{ $driver->code }})
                                                </option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('pole_position_driver_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="race_image" class="form-label">Race Image URL (Optional)</label>
                                    <input type="text" class="form-control @error('race_image') is-invalid @enderror"
                                           id="race_image" name="race_image" value="{{ old('race_image', $race->race_image) }}" placeholder="https://example.com/image.jpg">
                                    @error('race_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mb-4 flex-wrap">
                            <a href="{{ route('admin.f1.races.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Race</button>
                        </div>
                    </form>

                    <div class="card mt-3 rounded-4 overflow-hidden shadow-sm">
                        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Race Results</h5>
                            <a href="{{ route('admin.f1.races.results.create', $race) }}" class="btn btn-success btn-sm">
                                <i class="bi bi-plus"></i> Add Result
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
                                                <th>Pos</th>
                                                <th>Driver</th>
                                                <th class="d-none d-sm-table-cell">Team</th>
                                                <th class="d-none d-sm-table-cell">Status</th>
                                                <th>Pts</th>
                                                <th class="d-none d-md-table-cell">Fastest Lap</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($raceResults as $result)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-column">
                                                            <span>{{ $result->position_display }}</span>
                                                            <small class="d-sm-none text-muted">{{ optional($result->driver)->name ?? 'Unknown' }}</small>
                                                        </div>
                                                    </td>
                                                    <td>{{ optional($result->driver)->name ?? 'Unknown' }}</td>
                                                    <td class="d-none d-sm-table-cell">{{ optional($result->team)->name ?? 'Unknown' }}</td>
                                                    <td class="d-none d-sm-table-cell">{{ $result->status }}</td>
                                                    <td>{{ $result->points }}</td>
                                                    <td class="d-none d-md-table-cell">{{ $result->fastest_lap ? 'Yes' : 'No' }}</td>
                                                    <td class="text-end">
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.f1.race_results.edit', $result) }}" class="btn btn-sm btn-outline-primary">
                                                                <i class="bi bi-pencil"></i>
                                                            </a>
                                                            <form action="{{ route('admin.f1.race_results.destroy', $result) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this result?')">
                                                                    <i class="bi bi-trash"></i>
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

<style>
body {
    background: url('/img/sitebg.gif') no-repeat center center fixed !important;
    background-size: cover !important;
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
.container {
    position: relative;
    z-index: 1;
}
.card {
    background: rgba(255, 255, 255, 0.95);
    border: none;
}
.card-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}
.list-group-item {
    background: transparent;
}
</style>
@endsection
