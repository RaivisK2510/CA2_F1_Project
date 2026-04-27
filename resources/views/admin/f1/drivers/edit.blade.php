@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Driver: {{ $driver->name }}</h4>
                    <a href="{{ route('admin.f1.drivers.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Drivers
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.drivers.update', $driver) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Basic Information</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                               id="first_name" name="first_name" value="{{ old('first_name', $driver->first_name) }}" placeholder="e.g., Lewis" required>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                               id="last_name" name="last_name" value="{{ old('last_name', $driver->last_name) }}" placeholder="e.g., Hamilton" required>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Driver Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                               id="code" name="code" value="{{ old('code', $driver->code) }}" maxlength="3" placeholder="HAM" required>
                                        <small class="text-muted">3-letter code (e.g., HAM)</small>
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="driver_number" class="form-label">Driver Number <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('driver_number') is-invalid @enderror"
                                               id="driver_number" name="driver_number" value="{{ old('driver_number', $driver->driver_number) }}" min="1" max="99" placeholder="44" required>
                                        @error('driver_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="nationality" class="form-label">Nationality <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('nationality') is-invalid @enderror"
                                               id="nationality" name="nationality" value="{{ old('nationality', $driver->nationality) }}" placeholder="British" required>
                                        @error('nationality')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror"
                                               id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $driver->date_of_birth->format('Y-m-d')) }}" required>
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="place_of_birth" class="form-label">Place of Birth</label>
                                        <input type="text" class="form-control @error('place_of_birth') is-invalid @enderror"
                                               id="place_of_birth" name="place_of_birth" value="{{ old('place_of_birth', $driver->place_of_birth) }}" placeholder="(Optional)">
                                        <small class="text-muted">If not provided, nationality will be used</small>
                                        @error('place_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Physical Information Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Physical Information</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="height_cm" class="form-label">Height (cm)</label>
                                        <input type="number" class="form-control @error('height_cm') is-invalid @enderror"
                                               id="height_cm" name="height_cm" value="{{ old('height_cm', $driver->height_cm) }}" min="100" max="250" placeholder="180">
                                        @error('height_cm')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="weight_kg" class="form-label">Weight (kg)</label>
                                        <input type="number" class="form-control @error('weight_kg') is-invalid @enderror"
                                               id="weight_kg" name="weight_kg" value="{{ old('weight_kg', $driver->weight_kg) }}" min="40" max="150" placeholder="73">
                                        @error('weight_kg')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Career Information Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Career Information</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="debut_year" class="form-label">Debut Year</label>
                                        <input type="number" class="form-control @error('debut_year') is-invalid @enderror"
                                               id="debut_year" name="debut_year" value="{{ old('debut_year', $driver->debut_year ? $driver->debut_year->format('Y') : '') }}" min="1950" max="{{ date('Y') }}" placeholder="2007">
                                        <small class="text-muted">Year only (YYYY)</small>
                                        @error('debut_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="retirement_year" class="form-label">Retirement Year</label>
                                        <input type="number" class="form-control @error('retirement_year') is-invalid @enderror"
                                               id="retirement_year" name="retirement_year" value="{{ old('retirement_year', $driver->retirement_year ? $driver->retirement_year->format('Y') : '') }}" min="1950" max="{{ date('Y') }}" placeholder="Leave blank if active">
                                        <small class="text-muted">Year only (YYYY)</small>
                                        @error('retirement_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="team_id" class="form-label">Current Team</label>
                                        <select class="form-select @error('team_id') is-invalid @enderror"
                                                id="team_id" name="team_id">
                                            <option value="">-- Select a team --</option>
                                            @foreach($teams as $team)
                                                <option value="{{ $team->id }}" {{ old('team_id', $driver->team_id) == $team->id ? 'selected' : '' }}>
                                                    {{ $team->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('team_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="profile_image" class="form-label">Profile Image URL</label>
                                        <input type="text" class="form-control @error('profile_image') is-invalid @enderror"
                                               id="profile_image" name="profile_image" value="{{ old('profile_image', $driver->profile_image) }}" placeholder="URL to profile image">
                                        @error('profile_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Biography</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror"
                                          id="bio" name="bio" rows="4" placeholder="Driver biography and achievements...">{{ old('bio', $driver->bio) }}</textarea>
                                <small class="text-muted">Maximum 5000 characters</small>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Career Statistics Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Career Statistics</h5>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="wins" class="form-label">Race Wins</label>
                                        <input type="number" class="form-control @error('wins') is-invalid @enderror"
                                               id="wins" name="wins" value="{{ old('wins', $driver->wins ?? 0) }}" min="0" max="10000">
                                        @error('wins')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="podiums" class="form-label">Podiums</label>
                                        <input type="number" class="form-control @error('podiums') is-invalid @enderror"
                                               id="podiums" name="podiums" value="{{ old('podiums', $driver->podiums ?? 0) }}" min="0" max="10000">
                                        @error('podiums')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="pole_positions" class="form-label">Pole Positions</label>
                                        <input type="number" class="form-control @error('pole_positions') is-invalid @enderror"
                                               id="pole_positions" name="pole_positions" value="{{ old('pole_positions', $driver->pole_positions ?? 0) }}" min="0" max="10000">
                                        @error('pole_positions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="fastest_laps" class="form-label">Fastest Laps</label>
                                        <input type="number" class="form-control @error('fastest_laps') is-invalid @enderror"
                                               id="fastest_laps" name="fastest_laps" value="{{ old('fastest_laps', $driver->fastest_laps ?? 0) }}" min="0" max="10000">
                                        @error('fastest_laps')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="career_points" class="form-label">Career Points</label>
                                        <input type="number" class="form-control @error('career_points') is-invalid @enderror"
                                               id="career_points" name="career_points" value="{{ old('career_points', $driver->career_points ?? 0) }}" min="0" max="100000">
                                        @error('career_points')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="world_championships" class="form-label">World Championships</label>
                                        <input type="number" class="form-control @error('world_championships') is-invalid @enderror"
                                               id="world_championships" name="world_championships" value="{{ old('world_championships', $driver->world_championships ?? 0) }}" min="0" max="10">
                                        @error('world_championships')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Status</h5>

                            <div class="form-check">
                                <input class="form-check-input @error('is_active') is-invalid @enderror"
                                       type="checkbox" id="is_active" name="is_active" value="1"
                                       {{ old('is_active', $driver->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active Driver
                                </label>
                                @error('is_active')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2 flex-wrap">
                            <a href="{{ route('admin.f1.drivers.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Driver</button>
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
