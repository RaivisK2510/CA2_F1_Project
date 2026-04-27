@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Team: {{ $team->name }}</h4>
                    <a href="{{ route('admin.f1.teams.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Teams
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.teams.update', $team) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Basic Information</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Team Name (Short) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name', $team->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label">Full Team Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                               id="full_name" name="full_name" value="{{ old('full_name', $team->full_name) }}" required>
                                        @error('full_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Team Code</label>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror"
                                               id="code" name="code" value="{{ old('code', $team->code) }}" maxlength="3">
                                        <small class="text-muted">3-letter code (auto-generated from name if empty)</small>
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror"
                                               id="country" name="country" value="{{ old('country', $team->country) }}" required>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="headquarters" class="form-label">Headquarters</label>
                                        <input type="text" class="form-control @error('headquarters') is-invalid @enderror"
                                               id="headquarters" name="headquarters" value="{{ old('headquarters', $team->headquarters) }}">
                                        @error('headquarters')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Team Leadership Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Team Leadership</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="team_chief" class="form-label">Team Principal <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('team_chief') is-invalid @enderror"
                                               id="team_chief" name="team_chief" value="{{ old('team_chief', $team->team_chief) }}" required>
                                        @error('team_chief')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="technical_chief" class="form-label">Technical Director</label>
                                        <input type="text" class="form-control @error('technical_chief') is-invalid @enderror"
                                               id="technical_chief" name="technical_chief" value="{{ old('technical_chief', $team->technical_chief) }}">
                                        @error('technical_chief')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Specifications Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Technical Specifications</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="chassis" class="form-label">Chassis</label>
                                        <input type="text" class="form-control @error('chassis') is-invalid @enderror"
                                               id="chassis" name="chassis" value="{{ old('chassis', $team->chassis) }}">
                                        @error('chassis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="power_unit" class="form-label">Power Unit (Engine)</label>
                                        <input type="text" class="form-control @error('power_unit') is-invalid @enderror"
                                               id="power_unit" name="power_unit" value="{{ old('power_unit', $team->power_unit) }}">
                                        @error('power_unit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Media & Images Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Media & Images</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="logo" class="form-label">Team Logo URL</label>
                                        <input type="text" class="form-control @error('logo') is-invalid @enderror"
                                               id="logo" name="logo" value="{{ old('logo', $team->logo) }}">
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="car_image" class="form-label">Car Image URL</label>
                                        <input type="text" class="form-control @error('car_image') is-invalid @enderror"
                                               id="car_image" name="car_image" value="{{ old('car_image', $team->car_image) }}">
                                        @error('car_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- History Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">History</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="founded_year" class="form-label">Founded Year <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('founded_year') is-invalid @enderror"
                                               id="founded_year" name="founded_year" value="{{ old('founded_year', $team->founded_year ? $team->founded_year->format('Y') : '') }}"
                                               min="1900" max="{{ date('Y') }}" required>
                                        @error('founded_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="disbanded_year" class="form-label">Disbanded Year</label>
                                        <input type="number" class="form-control @error('disbanded_year') is-invalid @enderror"
                                               id="disbanded_year" name="disbanded_year" value="{{ old('disbanded_year', $team->disbanded_year ? $team->disbanded_year->format('Y') : '') }}"
                                               min="1900" placeholder="Leave blank if still active">
                                        @error('disbanded_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Description</h5>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Team Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description" name="description" rows="4">{{ old('description', $team->description) }}</textarea>
                                        <small class="text-muted">Maximum 5000 characters</small>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Career Statistics Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Career Statistics</h5>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="world_championships" class="form-label">World Championships</label>
                                        <input type="number" class="form-control @error('world_championships') is-invalid @enderror"
                                               id="world_championships" name="world_championships" value="{{ old('world_championships', $team->world_championships ?? 0) }}"
                                               min="0" max="10">
                                        @error('world_championships')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="race_wins" class="form-label">Race Wins</label>
                                        <input type="number" class="form-control @error('race_wins') is-invalid @enderror"
                                               id="race_wins" name="race_wins" value="{{ old('race_wins', $team->race_wins ?? 0) }}"
                                               min="0" max="10000">
                                        @error('race_wins')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="pole_positions" class="form-label">Pole Positions</label>
                                        <input type="number" class="form-control @error('pole_positions') is-invalid @enderror"
                                               id="pole_positions" name="pole_positions" value="{{ old('pole_positions', $team->pole_positions ?? 0) }}"
                                               min="0" max="10000">
                                        @error('pole_positions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="fastest_laps" class="form-label">Fastest Laps</label>
                                        <input type="number" class="form-control @error('fastest_laps') is-invalid @enderror"
                                               id="fastest_laps" name="fastest_laps" value="{{ old('fastest_laps', $team->fastest_laps ?? 0) }}"
                                               min="0" max="10000">
                                        @error('fastest_laps')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="podiums" class="form-label">Podium Finishes</label>
                                        <input type="number" class="form-control @error('podiums') is-invalid @enderror"
                                               id="podiums" name="podiums" value="{{ old('podiums', $team->podiums ?? 0) }}"
                                               min="0" max="10000">
                                        @error('podiums')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check mt-4">
                                            <input class="form-check-input @error('is_active') is-invalid @enderror"
                                                   type="checkbox" id="is_active" name="is_active" value="1"
                                                   {{ old('is_active', $team->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">
                                                Active Team
                                            </label>
                                            @error('is_active')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2 flex-wrap">
                            <a href="{{ route('admin.f1.teams.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Team
                            </button>
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
