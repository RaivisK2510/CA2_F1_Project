@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Season: {{ $season->year }}</h4>
                    <a href="{{ route('admin.f1.seasons.index') }}" class="btn btn-light">
                        <i class="bi bi-arrow-left"></i> Back to Seasons
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.seasons.update', $season) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Season Year <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror"
                                           id="year" name="year" value="{{ old('year', $season->year) }}"
                                           min="1950" max="{{ date('Y') + 1 }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="total_races" class="form-label">Number of Races <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('total_races') is-invalid @enderror"
                                           id="total_races" name="total_races" value="{{ old('total_races', $season->total_races) }}"
                                           min="1" max="30" required>
                                    @error('total_races')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                           id="start_date" name="start_date" value="{{ old('start_date', $season->start_date?->format('Y-m-d')) }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                           id="end_date" name="end_date" value="{{ old('end_date', $season->end_date?->format('Y-m-d')) }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="completed_races" class="form-label">Completed Races (Optional)</label>
                                    <input type="number" class="form-control @error('completed_races') is-invalid @enderror"
                                           id="completed_races" name="completed_races" value="{{ old('completed_races', $season->completed_races) }}"
                                           min="0">
                                    @error('completed_races')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="season_image" class="form-label">Season Image URL (Optional)</label>
                                    <input type="text" class="form-control @error('season_image') is-invalid @enderror"
                                           id="season_image" name="season_image" value="{{ old('season_image', $season->season_image) }}"
                                           placeholder="https://example.com/image.jpg">
                                    @error('season_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input @error('is_active') is-invalid @enderror"
                                               type="checkbox" id="is_active" name="is_active" value="1"
                                               {{ old('is_active', $season->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active Season
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">Season Description (Optional)</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="3"
                                              placeholder="Enter season highlights, notable changes, etc.">{{ old('description', $season->description) }}</textarea>
                                    <small class="form-text text-muted">Maximum 5000 characters</small>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="champion_driver_id" class="form-label">Champion Driver (Optional)</label>
                                    <select class="form-select @error('champion_driver_id') is-invalid @enderror"
                                            id="champion_driver_id" name="champion_driver_id">
                                        <option value="">Select champion driver</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ old('champion_driver_id', $season->champion_driver_id) == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->name }} ({{ $driver->code }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('champion_driver_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="champion_team_id" class="form-label">Champion Team (Optional)</label>
                                    <select class="form-select @error('champion_team_id') is-invalid @enderror"
                                            id="champion_team_id" name="champion_team_id">
                                        <option value="">Select champion team</option>
                                        @foreach($teams as $team)
                                            <option value="{{ $team->id }}" {{ old('champion_team_id', $season->champion_team_id) == $team->id ? 'selected' : '' }}>
                                                {{ $team->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('champion_team_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.f1.seasons.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Season</button>
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
