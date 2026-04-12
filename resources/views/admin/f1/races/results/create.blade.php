@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Add Result for {{ $race->name }}</h4>
                    <a href="{{ route('admin.f1.races.edit', $race) }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Race
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.races.results.store', $race) }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Finishing Position</label>
                                    <input type="number" class="form-control @error('position') is-invalid @enderror"
                                           id="position" name="position" value="{{ old('position') }}" min="1" max="99" required>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="grid_position" class="form-label">Grid Position</label>
                                    <input type="number" class="form-control @error('grid_position') is-invalid @enderror"
                                           id="grid_position" name="grid_position" value="{{ old('grid_position') }}" min="1" max="99" required>
                                    @error('grid_position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="laps_completed" class="form-label">Laps Completed</label>
                                    <input type="number" class="form-control @error('laps_completed') is-invalid @enderror"
                                           id="laps_completed" name="laps_completed" value="{{ old('laps_completed') }}" min="0" max="999" required>
                                    @error('laps_completed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="points" class="form-label">Points</label>
                                    <input type="number" class="form-control @error('points') is-invalid @enderror"
                                           id="points" name="points" value="{{ old('points') }}" min="0" max="100" required>
                                    @error('points')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="driver_id" class="form-label">Driver</label>
                                    <select class="form-select @error('driver_id') is-invalid @enderror" id="driver_id" name="driver_id" required>
                                        <option value="">Select driver</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
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
                                    <label for="team_id" class="form-label">Team</label>
                                    <select class="form-select @error('team_id') is-invalid @enderror" id="team_id" name="team_id" required>
                                        <option value="">Select team</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}" {{ old('team_id') == $team->id ? 'selected' : '' }}>
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
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="">Select status</option>
                                        <option value="Finished" {{ old('status') === 'Finished' ? 'selected' : '' }}>Finished</option>
                                        <option value="DNF" {{ old('status') === 'DNF' ? 'selected' : '' }}>DNF</option>
                                        <option value="DNS" {{ old('status') === 'DNS' ? 'selected' : '' }}>DNS</option>
                                        <option value="DSQ" {{ old('status') === 'DSQ' ? 'selected' : '' }}>DSQ</option>
                                        <option value="Retired" {{ old('status') === 'Retired' ? 'selected' : '' }}>Retired</option>
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
                                    <label for="position_text" class="form-label">Position Text</label>
                                    <input type="text" class="form-control @error('position_text') is-invalid @enderror"
                                           id="position_text" name="position_text" value="{{ old('position_text') }}">
                                    @error('position_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="race_time" class="form-label">Race Time</label>
                                    <input type="time" step="1" class="form-control @error('race_time') is-invalid @enderror"
                                           id="race_time" name="race_time" value="{{ old('race_time') }}">
                                    @error('race_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="time_gap" class="form-label">Time Gap</label>
                                    <input type="text" class="form-control @error('time_gap') is-invalid @enderror"
                                           id="time_gap" name="time_gap" value="{{ old('time_gap') }}">
                                    @error('time_gap')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="interval" class="form-label">Interval</label>
                                    <input type="text" class="form-control @error('interval') is-invalid @enderror"
                                           id="interval" name="interval" value="{{ old('interval') }}">
                                    @error('interval')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="fastest_lap" class="form-label">Fastest Lap</label>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input @error('fastest_lap') is-invalid @enderror" type="checkbox" id="fastest_lap" name="fastest_lap" value="1" {{ old('fastest_lap') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="fastest_lap">Yes</label>
                                    </div>
                                    @error('fastest_lap')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="fastest_lap_time" class="form-label">Fastest Lap Time</label>
                                    <input type="text" class="form-control @error('fastest_lap_time') is-invalid @enderror"
                                           id="fastest_lap_time" name="fastest_lap_time" value="{{ old('fastest_lap_time') }}" placeholder="e.g. 1:24.567">
                                    @error('fastest_lap_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="average_speed" class="form-label">Average Speed</label>
                                    <input type="text" class="form-control @error('average_speed') is-invalid @enderror"
                                           id="average_speed" name="average_speed" value="{{ old('average_speed') }}" placeholder="e.g. 215.8 km/h">
                                    @error('average_speed')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.f1.races.edit', $race) }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Result</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
