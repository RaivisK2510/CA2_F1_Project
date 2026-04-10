@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Circuit: {{ $circuit->name }}</h4>
                    <a href="{{ route('admin.f1.circuits.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Circuits
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.circuits.update', $circuit) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Circuit Name (Short)</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name', $circuit->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="full_name" class="form-label">Full Circuit Name</label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                           id="full_name" name="full_name" value="{{ old('full_name', $circuit->full_name) }}" required>
                                    @error('full_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control @error('country') is-invalid @enderror" 
                                           id="country" name="country" value="{{ old('country', $circuit->country) }}" required>
                                    @error('country')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                           id="city" name="city" value="{{ old('city', $circuit->city) }}" required>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="first_grand_prix_year" class="form-label">First Grand Prix Year</label>
                                    <input type="number" class="form-control @error('first_grand_prix_year') is-invalid @enderror" 
                                           id="first_grand_prix_year" name="first_grand_prix_year" value="{{ old('first_grand_prix_year', $circuit->first_grand_prix_year) }}" 
                                           min="1950" max="{{ date('Y') }}" required>
                                    @error('first_grand_prix_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="length_km" class="form-label">Length (km)</label>
                                    <input type="number" step="0.1" class="form-control @error('length_km') is-invalid @enderror" 
                                           id="length_km" name="length_km" value="{{ old('length_km', $circuit->length_km) }}" 
                                           min="1" max="20" required>
                                    @error('length_km')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="corners" class="form-label">Corners</label>
                                    <input type="number" class="form-control @error('corners') is-invalid @enderror" 
                                           id="corners" name="corners" value="{{ old('corners', $circuit->corners) }}" 
                                           min="1" max="100" required>
                                    @error('corners')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lap_record" class="form-label">Lap Record (Optional)</label>
                                    <input type="text" class="form-control @error('lap_record') is-invalid @enderror" 
                                           id="lap_record" name="lap_record" value="{{ old('lap_record', $circuit->lap_record) }}" 
                                           placeholder="e.g., 1:23.456">
                                    @error('lap_record')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input @error('is_active') is-invalid @enderror" 
                                               type="checkbox" id="is_active" name="is_active" value="1" 
                                               {{ old('is_active', $circuit->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Active Circuit
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.f1.circuits.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Circuit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
