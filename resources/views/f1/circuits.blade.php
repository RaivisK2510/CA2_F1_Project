@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">🏁 F1 Circuits</h1>
            <p class="text-muted">Explore the world's most iconic Formula 1 race tracks</p>
        </div>
        <a href="{{ route('f1.dashboard') }}" class="btn btn-secondary">← Back to Dashboard</a>
    </div>

    <div class="row g-4">
        @forelse($circuits as $circuit)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-success text-white">
                        <h5 class="card-title mb-0">{{ $circuit->name }}</h5>
                        <small>{{ $circuit->full_name }}</small>
                    </div>
                    <div class="card-body">
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-primary">🌍</div>
                                    <div class="small text-muted">Country</div>
                                    <div class="fw-bold">{{ $circuit->country }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-info">🏙️</div>
                                    <div class="small text-muted">City</div>
                                    <div class="fw-bold">{{ $circuit->city }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-secondary">📏</div>
                                    <div class="small text-muted">Length</div>
                                    <div class="fw-bold">{{ $circuit->length_km }} km</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-warning">🔄</div>
                                    <div class="small text-muted">Corners</div>
                                    <div class="fw-bold">{{ $circuit->corners }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-2">Circuit Information</h6>
                            <div class="row g-2 text-sm">
                                <div class="col-6">
                                    <div class="text-muted">🏁 First GP</div>
                                    <div class="fw-semibold">{{ $circuit->first_grand_prix }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">🏆 Races Held</div>
                                    <div class="fw-semibold">{{ $circuit->races_held }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">🔄 Direction</div>
                                    <div class="fw-semibold">{{ $circuit->direction }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">🚀 DRS Zones</div>
                                    <div class="fw-semibold">{{ $circuit->drs_zones }}</div>
                                </div>
                            </div>

                            @if($circuit->lap_record_driver)
                                <div class="mt-3 p-2 bg-warning bg-opacity-10 rounded">
                                    <div class="text-muted small mb-1">🏃‍♂️ Lap Record</div>
                                    <div class="fw-semibold small">
                                        {{ $circuit->lap_record_time }} by {{ $circuit->lap_record_driver }} ({{ $circuit->lap_record_year }})
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-geo-alt-x fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No circuits found</h4>
                    <p class="text-muted">There are currently no circuits in the database.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
