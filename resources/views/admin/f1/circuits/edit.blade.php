@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Circuit: {{ $circuit->name }}</h4>
                    <a href="{{ route('admin.f1.circuits.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to Circuits
                    </a>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.f1.circuits.update', $circuit) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Basic Information Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Basic Information</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Circuit Name (Short) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                               id="name" name="name" value="{{ old('name', $circuit->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="full_name" class="form-label">Full Circuit Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                               id="full_name" name="full_name" value="{{ old('full_name', $circuit->full_name) }}" required>
                                        @error('full_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Location Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Location</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('country') is-invalid @enderror"
                                               id="country" name="country" value="{{ old('country', $circuit->country) }}" required>
                                        @error('country')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                                               id="city" name="city" value="{{ old('city', $circuit->city) }}" required>
                                        @error('city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Full Address</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror"
                                               id="address" name="address" value="{{ old('address', $circuit->address) }}">
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="latitude" class="form-label">Latitude</label>
                                        <input type="number" step="0.00000001" class="form-control @error('latitude') is-invalid @enderror"
                                               id="latitude" name="latitude" value="{{ old('latitude', $circuit->latitude) }}" min="-90" max="90">
                                        <small class="form-text text-muted">Decimal degrees (-90 to 90)</small>
                                        @error('latitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="longitude" class="form-label">Longitude</label>
                                        <input type="number" step="0.00000001" class="form-control @error('longitude') is-invalid @enderror"
                                               id="longitude" name="longitude" value="{{ old('longitude', $circuit->longitude) }}" min="-180" max="180">
                                        <small class="form-text text-muted">Decimal degrees (-180 to 180)</small>
                                        @error('longitude')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Circuit Specifications Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Circuit Specifications</h5>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="length_km" class="form-label">Track Length (km) <span class="text-danger">*</span></label>
                                        <input type="number" step="0.001" class="form-control @error('length_km') is-invalid @enderror"
                                               id="length_km" name="length_km" value="{{ old('length_km', $circuit->length_km) }}" min="1" max="20" required>
                                        @error('length_km')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="corners" class="form-label">Number of Corners <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('corners') is-invalid @enderror"
                                               id="corners" name="corners" value="{{ old('corners', $circuit->corners) }}" min="1" max="100" required>
                                        @error('corners')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="drs_zones" class="form-label">DRS Zones</label>
                                        <input type="number" class="form-control @error('drs_zones') is-invalid @enderror"
                                               id="drs_zones" name="drs_zones" value="{{ old('drs_zones', $circuit->drs_zones ?? 0) }}" min="0" max="10">
                                        <small class="form-text text-muted">Number of DRS zones on the circuit</small>
                                        @error('drs_zones')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="direction" class="form-label">Track Direction</label>
                                        <select class="form-select @error('direction') is-invalid @enderror"
                                                id="direction" name="direction">
                                            <option value="">-- Select direction --</option>
                                            <option value="Clockwise" {{ old('direction', $circuit->direction) == 'Clockwise' ? 'selected' : '' }}>Clockwise</option>
                                            <option value="Counter-clockwise" {{ old('direction', $circuit->direction) == 'Counter-clockwise' ? 'selected' : '' }}>Counter-clockwise</option>
                                        </select>
                                        @error('direction')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="races_held" class="form-label">Races Held</label>
                                        <input type="number" class="form-control @error('races_held') is-invalid @enderror"
                                               id="races_held" name="races_held" value="{{ old('races_held', $circuit->races_held ?? 0) }}" min="0">
                                        <small class="form-text text-muted">Total number of Grand Prix races held</small>
                                        @error('races_held')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Lap Record Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Lap Record</h5>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lap_record_seconds" class="form-label">Lap Record Time (seconds)</label>
                                        <input type="number" step="0.001" class="form-control @error('lap_record_seconds') is-invalid @enderror"
                                               id="lap_record_seconds" name="lap_record_seconds" value="{{ old('lap_record_seconds', $circuit->lap_record_seconds) }}" min="0">
                                        <small class="form-text text-muted">Total seconds for fastest lap</small>
                                        @error('lap_record_seconds')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lap_record_driver" class="form-label">Record Holder</label>
                                        <input type="text" class="form-control @error('lap_record_driver') is-invalid @enderror"
                                               id="lap_record_driver" name="lap_record_driver" value="{{ old('lap_record_driver', $circuit->lap_record_driver) }}">
                                        @error('lap_record_driver')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="lap_record_year" class="form-label">Record Year</label>
                                        <input type="number" class="form-control @error('lap_record_year') is-invalid @enderror"
                                               id="lap_record_year" name="lap_record_year" value="{{ old('lap_record_year', $circuit->lap_record_year) }}" min="1950" max="{{ date('Y') }}">
                                        <small class="form-text text-muted">Year the record was set</small>
                                        @error('lap_record_year')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- History Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Grand Prix History</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="first_grand_prix" class="form-label">First Grand Prix Year <span class="text-danger">*</span></label>
                                        <input type="number" class="form-control @error('first_grand_prix') is-invalid @enderror"
                                               id="first_grand_prix" name="first_grand_prix" value="{{ old('first_grand_prix', $circuit->first_grand_prix) }}" min="1950" max="{{ date('Y') }}" required>
                                        @error('first_grand_prix')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="last_grand_prix" class="form-label">Last Grand Prix Year</label>
                                        <input type="number" class="form-control @error('last_grand_prix') is-invalid @enderror"
                                               id="last_grand_prix" name="last_grand_prix" value="{{ old('last_grand_prix', $circuit->last_grand_prix) }}" min="1950">
                                        <small class="form-text text-muted">Year of last Grand Prix (if circuit is no longer used)</small>
                                        @error('last_grand_prix')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Description & Media Section -->
                        <div class="mb-4">
                            <h5 class="text-muted border-bottom pb-2">Description & Media</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="circuit_image" class="form-label">Circuit Image URL</label>
                                        <input type="text" class="form-control @error('circuit_image') is-invalid @enderror"
                                               id="circuit_image" name="circuit_image" value="{{ old('circuit_image', $circuit->circuit_image) }}">
                                        <small class="form-text text-muted">URL to circuit/venue image</small>
                                        @error('circuit_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="layout_image" class="form-label">Track Layout Image URL</label>
                                        <input type="text" class="form-control @error('layout_image') is-invalid @enderror"
                                               id="layout_image" name="layout_image" value="{{ old('layout_image', $circuit->layout_image) }}">
                                        <small class="form-text text-muted">URL to circuit layout/map image</small>
                                        @error('layout_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Circuit Description</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror"
                                                  id="description" name="description" rows="4">{{ old('description', $circuit->description) }}</textarea>
                                        <small class="form-text text-muted">Maximum 5000 characters</small>
                                        @error('description')
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
                                       {{ old('is_active', $circuit->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active Circuit
                                </label>
                                @error('is_active')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.f1.circuits.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update Circuit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
