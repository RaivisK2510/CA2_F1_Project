@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="display-5 fw-bold mb-2">🏭 F1 Teams</h1>
            <p class="text-muted">Complete list of Formula 1 teams and their performance statistics</p>
        </div>
        <a href="{{ route('f1.dashboard') }}" class="btn btn-secondary">← Back to Dashboard</a>
    </div>

    <div class="row g-4">
        @forelse($teams as $team)
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <div class="bg-white text-primary rounded d-flex align-items-center justify-content-center fw-bold me-3" style="width: 50px; height: 50px;">
                                {{ $team->code }}
                            </div>
                            <div>
                                <h5 class="card-title mb-0">{{ $team->name }}</h5>
                                <small>{{ $team->full_name }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-2 mb-4">
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-warning">🏆</div>
                                    <div class="small text-muted">Championships</div>
                                    <div class="fw-bold">{{ $team->world_championships }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-danger">🏁</div>
                                    <div class="small text-muted">Wins</div>
                                    <div class="fw-bold">{{ $team->race_wins }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-secondary">🥈</div>
                                    <div class="small text-muted">Podiums</div>
                                    <div class="fw-bold">{{ $team->podiums }}</div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 bg-light rounded text-center">
                                    <div class="fw-bold text-info">🚀</div>
                                    <div class="small text-muted">Pole Positions</div>
                                    <div class="fw-bold">{{ $team->pole_positions }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <h6 class="fw-bold mb-2">Team Details</h6>
                            <div class="row g-2 text-sm">
                                <div class="col-6">
                                    <div class="text-muted">🌍 Country</div>
                                    <div class="fw-semibold">{{ $team->country }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">🏢 Headquarters</div>
                                    <div class="fw-semibold">{{ $team->headquarters }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">👨‍💼 Team Chief</div>
                                    <div class="fw-semibold">{{ $team->team_chief }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">🔧 Technical Chief</div>
                                    <div class="fw-semibold">{{ $team->technical_chief }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">🏎️ Chassis</div>
                                    <div class="fw-semibold">{{ $team->chassis }}</div>
                                </div>
                                <div class="col-6">
                                    <div class="text-muted">⚡ Power Unit</div>
                                    <div class="fw-semibold">{{ $team->power_unit }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="bi bi-building-x fs-1 text-muted"></i>
                    <h4 class="mt-3 text-muted">No teams found</h4>
                    <p class="text-muted">There are currently no teams in the database.</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
