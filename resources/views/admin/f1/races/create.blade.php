@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Add New Race</h4>
                    <a href="{{ route('admin.f1.races.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Races
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.races.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Race Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                           id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="official_name" class="form-label">Official Name (Optional)</label>
                                    <input type="text" class="form-control @error('official_name') is-invalid @enderror"
                                           id="official_name" name="official_name" value="{{ old('official_name') }}">
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
                                           id="round_number" name="round_number" value="{{ old('round_number') }}" min="1" max="25" required>
                                    @error('round_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="race_date" class="form-label">Race Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('race_date') is-invalid @enderror"
                                           id="race_date" name="race_date" value="{{ old('race_date') }}" required>
                                    @error('race_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="race_time" class="form-label">Race Time (Optional)</label>
                                    <input type="time" class="form-control @error('race_time') is-invalid @enderror"
                                           id="race_time" name="race_time" value="{{ old('race_time') }}">
                                    @error('race_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="laps" class="form-label">Laps <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('laps') is-invalid @enderror"
                                           id="laps" name="laps" value="{{ old('laps') }}" min="1" required>
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
                                           id="race_distance_km" name="race_distance_km" value="{{ old('race_distance_km') }}" min="0" required>
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
                                            <option value="{{ $season->id }}" {{ old('season_id') == $season->id ? 'selected' : '' }}>
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
                                            <option value="{{ $circuit->id }}" {{ old('circuit_id') == $circuit->id ? 'selected' : '' }}>
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
                                           id="weather_conditions" name="weather_conditions" value="{{ old('weather_conditions') }}">
                                    @error('weather_conditions')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="race_report" class="form-label">Race Report (Optional)</label>
                                    <textarea class="form-control @error('race_report') is-invalid @enderror" id="race_report" name="race_report" rows="3">{{ old('race_report') }}</textarea>
                                    @error('race_report')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input @error('is_completed') is-invalid @enderror" type="checkbox" id="is_completed" name="is_completed" value="1" {{ old('is_completed') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_completed">Completed</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input @error('is_cancelled') is-invalid @enderror" type="checkbox" id="is_cancelled" name="is_cancelled" value="1" {{ old('is_cancelled') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_cancelled">Cancelled</label>
                                    </div>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input @error('is_active') is-invalid @enderror" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
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
                                           id="fastest_lap_time" name="fastest_lap_time" value="{{ old('fastest_lap_time') }}" placeholder="e.g. 1:24.567">
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
                                                <option value="{{ $driver->id }}" {{ old('fastest_lap_driver_id') == $driver->id ? 'selected' : '' }}>
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
                                           id="pole_position_time" name="pole_position_time" value="{{ old('pole_position_time') }}" placeholder="e.g. 1:23.456">
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
                                                <option value="{{ $driver->id }}" {{ old('pole_position_driver_id') == $driver->id ? 'selected' : '' }}>
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
                                           id="race_image" name="race_image" value="{{ old('race_image') }}" placeholder="https://example.com/image.jpg">
                                    @error('race_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 flex-wrap">
                            <a href="{{ route('admin.f1.races.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Race</button>
                        </div>
                    </form>
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
