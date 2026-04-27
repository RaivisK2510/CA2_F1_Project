@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Result for {{ $raceResult->race->name }}</h4>
                    <a href="{{ route('admin.f1.races.edit', $raceResult->race) }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Race
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.race_results.update', $raceResult) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Finishing Position <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('position') is-invalid @enderror"
                                           id="position" name="position" value="{{ old('position', $raceResult->position) }}" min="1" max="99" required>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="grid_position" class="form-label">Grid Position <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('grid_position') is-invalid @enderror"
                                           id="grid_position" name="grid_position" value="{{ old('grid_position', $raceResult->grid_position) }}" min="1" max="99" required>
                                    @error('grid_position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="laps_completed" class="form-label">Laps Completed <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('laps_completed') is-invalid @enderror"
                                           id="laps_completed" name="laps_completed" value="{{ old('laps_completed', $raceResult->laps_completed) }}" min="0" max="999" required>
                                    @error('laps_completed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="points" class="form-label">Points <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('points') is-invalid @enderror"
                                           id="points" name="points" value="{{ old('points', $raceResult->points) }}" min="0" max="100" required>
                                    @error('points')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="driver_id" class="form-label">Driver <span class="text-danger">*</span></label>
                                    <select class="form-select @error('driver_id') is-invalid @enderror" id="driver_id" name="driver_id" required>
                                        <option value="">Select driver</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ old('driver_id', $raceResult->driver_id) == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->name }} ({{ $driver->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('driver_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="team_id" class="form-label">Team <span class="text-danger">*</span></label>
                                    <select class="form-select @error('team_id') is-invalid @enderror" id="team_id" name="team_id" required>
                                        <option value="">Select team</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}" {{ old('team_id', $raceResult->team_id) == $team->id ? 'selected' : '' }}>
                                                {{ $team->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('team_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="">Select status</option>
                                        <option value="Finished" {{ old('status', $raceResult->status) === 'Finished' ? 'selected' : '' }}>Finished</option>
                                        <option value="DNF" {{ old('status', $raceResult->status) === 'DNF' ? 'selected' : '' }}>DNF</option>
                                        <option value="DNS" {{ old('status', $raceResult->status) === 'DNS' ? 'selected' : '' }}>DNS</option>
                                        <option value="DSQ" {{ old('status', $raceResult->status) === 'DSQ' ? 'selected' : '' }}>DSQ</option>
                                        <option value="Retired" {{ old('status', $raceResult->status) === 'Retired' ? 'selected' : '' }}>Retired</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="position_text" class="form-label">Position Text (Optional)</label>
                                    <input type="text" class="form-control @error('position_text') is-invalid @enderror"
                                           id="position_text" name="position_text" value="{{ old('position_text', $raceResult->position_text) }}">
                                    @error('position_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="race_time" class="form-label">Race Time (Optional)</label>
                                    <input type="time" step="1" class="form-control @error('race_time') is-invalid @enderror"
                                           id="race_time" name="race_time" value="{{ old('race_time', $raceResult->race_time?->format('H:i:s')) }}">
                                    @error('race_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="time_gap" class="form-label">Time Gap (Optional)</label>
                                    <input type="text" class="form-control @error('time_gap') is-invalid @enderror"
                                           id="time_gap" name="time_gap" value="{{ old('time_gap', $raceResult->time_gap) }}">
                                    @error('time_gap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="interval" class="form-label">Interval (Optional)</label>
                                    <input type="text" class="form-control @error('interval') is-invalid @enderror"
                                           id="interval" name="interval" value="{{ old('interval', $raceResult->interval) }}">
                                    @error('interval')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="fastest_lap" class="form-label">Fastest Lap (Optional)</label>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input @error('fastest_lap') is-invalid @enderror" type="checkbox" id="fastest_lap" name="fastest_lap" value="1" {{ old('fastest_lap', $raceResult->fastest_lap) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="fastest_lap">Yes</label>
                                    </div>
                                    @error('fastest_lap')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="fastest_lap_time" class="form-label">Fastest Lap Time (Optional)</label>
                                    <input type="text" class="form-control @error('fastest_lap_time') is-invalid @enderror"
                                           id="fastest_lap_time" name="fastest_lap_time" value="{{ old('fastest_lap_time', $raceResult->fastest_lap_time) }}" placeholder="e.g. 1:24.567">
                                    @error('fastest_lap_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="average_speed" class="form-label">Average Speed (Optional)</label>
                                    <input type="text" class="form-control @error('average_speed') is-invalid @enderror"
                                           id="average_speed" name="average_speed" value="{{ old('average_speed', $raceResult->average_speed) }}" placeholder="e.g. 215.8 km/h">
                                    @error('average_speed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes (Optional)</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $raceResult->notes) }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.f1.races.edit', $raceResult->race) }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Result</button>
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
