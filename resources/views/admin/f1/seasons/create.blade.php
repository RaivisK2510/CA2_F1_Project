@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Add New Season</h4>
                    <a href="{{ route('admin.f1.seasons.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Seasons
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.seasons.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Season Year</label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                           id="year" name="year" value="{{ old('year') }}" 
                                           min="1950" max="{{ date('Y') + 1 }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="races_count" class="form-label">Number of Races</label>
                                    <input type="number" class="form-control @error('races_count') is-invalid @enderror" 
                                           id="races_count" name="races_count" value="{{ old('races_count') }}" 
                                           min="1" max="30" required>
                                    @error('races_count')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input @error('is_active') is-invalid @enderror" 
                                               type="checkbox" id="is_active" name="is_active" value="1" checked>
                                        <label class="form-check-label" for="is_active">
                                            Active Season
                                        </label>
                                    </div>
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
                                            <option value="{{ $driver->id }}" {{ old('champion_driver_id') == $driver->id ? 'selected' : '' }}>
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
                                            <option value="{{ $team->id }}" {{ old('champion_team_id') == $team->id ? 'selected' : '' }}>
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
                            <button type="submit" class="btn btn-primary">Create Season</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
