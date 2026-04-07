@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">📅 F1 Seasons</h1>
            <p class="text-muted">Explore Formula 1 seasons, champions, and race statistics</p>
        </div>
        <a href="{{ route('f1.dashboard') }}" class="btn btn-secondary">← Back to Dashboard</a>
    </div>

    <div class="row g-4">
        @forelse($seasons as $season)
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-warning text-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0 fw-bold">{{ $season->year }}</h5>
                            @if($season->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Completed</span>
                            @endif
                        </div>
                        @if($season->description)
                            <small class="text-muted">{{ $season->description }}</small>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-primary">🏁</div>
                                    <div class="small text-muted">Total Races</div>
                                    <div class="fw-bold">{{ $season->total_races }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-success">✅</div>
                                    <div class="small text-muted">Completed</div>
                                    <div class="fw-bold">{{ $season->completed_races }}</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-info">📊</div>
                                    <div class="small text-muted">Progress</div>
                                    <div class="progress mt-1" style="height: 6px;">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $season->completion_percentage }}%" aria-valuenow="{{ $season->completion_percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="fw-bold small mt-1">{{ $season->completion_percentage }}%</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-2">Champions</h6>
                            <div class="row g-2 text-sm">
                                @if($season->championDriver)
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">👨‍🏎️</span>
                                            <div>
                                                <div class="text-muted small">Driver Champion</div>
                                                <div class="fw-semibold">{{ $season->championDriver->full_name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @if($season->championTeam)
                                    <div class="col-12">
                                        <div class="d-flex align-items-center">
                                            <span class="me-2">🏭</span>
                                            <div>
                                                <div class="text-muted small">Team Champion</div>
                                                <div class="fw-semibold">{{ $season->championTeam->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-12">
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">📅</span>
                                        <div>
                                            <div class="text-muted small">Season Dates</div>
                                            <div class="fw-semibold">{{ $season->start_date->format('M d, Y') }} - {{ $season->end_date->format('M d, Y') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-calendar-x fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No seasons found</h4>
                    <p class="text-muted">There are currently no seasons in the database.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
