@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">👨‍🏎️ F1 Drivers</h1>
            <p class="text-muted">Complete list of Formula 1 drivers and their career statistics</p>
        </div>
        <a href="{{ route('f1.dashboard') }}" class="btn btn-secondary">← Back to Dashboard</a>
    </div>

    <div class="row g-4">
        @forelse($drivers as $driver)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-shadow">
                    <div class="card-header bg-danger text-white">
                        <div class="d-flex align-items-center">
                            <div class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center fw-bold me-3" style="width: 40px; height: 40px;">
                                {{ $driver->code }}
                            </div>
                            <div>
                                <h5 class="card-title mb-0">{{ $driver->full_name }}</h5>
                                <small>#{{ $driver->driver_number }} | {{ $driver->nationality }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-warning">🏆</div>
                                    <div class="small text-muted">Championships</div>
                                    <div class="fw-bold">{{ $driver->world_championships }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-danger">🏁</div>
                                    <div class="small text-muted">Wins</div>
                                    <div class="fw-bold">{{ $driver->wins }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-secondary">🥈</div>
                                    <div class="small text-muted">Podiums</div>
                                    <div class="fw-bold">{{ $driver->podiums }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-primary">📊</div>
                                    <div class="small text-muted">Points</div>
                                    <div class="fw-bold">{{ $driver->career_points }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center text-muted small">
                            🎂 {{ $driver->date_of_birth->format('M j, Y') }} | 🏁 Debut: {{ $driver->debut_year->format('Y') }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-person-x fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No drivers found</h4>
                    <p class="text-muted">There are currently no drivers in the database.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
