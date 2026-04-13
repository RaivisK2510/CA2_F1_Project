@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Add New Team</h4>
                    <a href="{{ route('admin.f1.teams.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Teams
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.teams.store') }}" method="POST">
                        @csrf

                        <!-- Basic Information Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Basic Information</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Team Name (Short) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name') }}" placeholder="e.g., Mercedes" required>
                                        <small class="form-text text-muted">Short name for common reference</small>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label">Full Team Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                               id="full_name" name="full_name" value="{{ old('full_name') }}" placeholder="e.g., Mercedes-AMG Petronas F1 Team" required>
                                        <small class="form-text text-muted">Official full team name</small>
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
                                               id="code" name="code" value="{{ old('code') }}" maxlength="3" placeholder="Auto-generated (e.g., MER)">
                                        <small class="form-text text-muted">3-letter code (leave blank to auto-generate)</small>
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror"
                                               id="country" name="country" value="{{ old('country') }}" placeholder="e.g., Germany" required>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="headquarters" class="form-label">Headquarters</label>
                                        <input type="text" class="form-control @error('headquarters') is-invalid @enderror"
                                               id="headquarters" name="headquarters" value="{{ old('headquarters') }}" placeholder="e.g., Brackley, England">
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
                                               id="team_chief" name="team_chief" value="{{ old('team_chief') }}" placeholder="e.g., Toto Wolff" required>
                                        @error('team_chief')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="technical_chief" class="form-label">Technical Director</label>
                                        <input type="text" class="form-control @error('technical_chief') is-invalid @enderror"
                                               id="technical_chief" name="technical_chief" value="{{ old('technical_chief') }}" placeholder="e.g., Mike Elliott">
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
                                               id="chassis" name="chassis" value="{{ old('chassis') }}" placeholder="e.g., Mercedes W14">
                                        <small class="form-text text-muted">Car chassis designation</small>
                                        @error('chassis')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="power_unit" class="form-label">Power Unit (Engine)</label>
                                        <input type="text" class="form-control @error('power_unit') is-invalid @enderror"
                                               id="power_unit" name="power_unit" value="{{ old('power_unit') }}" placeholder="e.g., Mercedes-AMG F1 PU106D">
                                        <small class="form-text text-muted">Engine/Power unit specification</small>
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
                                               id="logo" name="logo" value="{{ old('logo') }}" placeholder="https://example.com/logo.png">
                                        <small class="form-text text-muted">URL to team logo image</small>
                                        @error('logo')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="car_image" class="form-label">Car Image URL</label>
                                        <input type="text" class="form-control @error('car_image') is-invalid @enderror"
                                               id="car_image" name="car_image" value="{{ old('car_image') }}" placeholder="https://example.com/car.jpg">
                                        <small class="form-text text-muted">URL to car/livery image</small>
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
                                               id="founded_year" name="founded_year" value="{{ old('founded_year') }}"
                                               min="1900" max="{{ date('Y') }}" placeholder="1954" required>
                                        <small class="form-text text-muted">Year team was founded</small>
                                        @error('founded_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="disbanded_year" class="form-label">Disbanded Year</label>
                                        <input type="number" class="form-control @error('disbanded_year') is-invalid @enderror"
                                               id="disbanded_year" name="disbanded_year" value="{{ old('disbanded_year') }}"
                                               min="1900" placeholder="Leave blank if still active">
                                        <small class="form-text text-muted">Year team ceased operations (if applicable)</small>
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
                                                  id="description" name="description" rows="4"
                                                  placeholder="Enter team history, achievements, and notable information...">{{ old('description') }}</textarea>
                                        <small class="form-text text-muted">Maximum 5000 characters</small>
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
                                               id="world_championships" name="world_championships" value="{{ old('world_championships', 0) }}"
                                               min="0" max="10" placeholder="0">
                                        @error('world_championships')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="race_wins" class="form-label">Race Wins</label>
                                        <input type="number" class="form-control @error('race_wins') is-invalid @enderror"
                                               id="race_wins" name="race_wins" value="{{ old('race_wins', 0) }}"
                                               min="0" max="10000" placeholder="0">
                                        @error('race_wins')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="pole_positions" class="form-label">Pole Positions</label>
                                        <input type="number" class="form-control @error('pole_positions') is-invalid @enderror"
                                               id="pole_positions" name="pole_positions" value="{{ old('pole_positions', 0) }}"
                                               min="0" max="10000" placeholder="0">
                                        @error('pole_positions')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="fastest_laps" class="form-label">Fastest Laps</label>
                                        <input type="number" class="form-control @error('fastest_laps') is-invalid @enderror"
                                               id="fastest_laps" name="fastest_laps" value="{{ old('fastest_laps', 0) }}"
                                               min="0" max="10000" placeholder="0">
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
                                               id="podiums" name="podiums" value="{{ old('podiums', 0) }}"
                                               min="0" max="10000" placeholder="0">
                                        @error('podiums')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check mt-4">
                                            <input class="form-check-input @error('is_active') is-invalid @enderror"
                                                   type="checkbox" id="is_active" name="is_active" value="1" checked>
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
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.f1.teams.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-circle"></i> Create Team
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
