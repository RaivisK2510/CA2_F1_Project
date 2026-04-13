@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Formula 1 Races</h4>
                    <a href="{{ route('f1.dashboard') }}" class="btn btn-secondary">
                        Back to F1 Dashboard
                    </a>
                </div>

                <div class="card-body">
                    @if($races->isEmpty())
                        <p class="text-muted">No races have been scheduled yet.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Race</th>
                                        <th>Circuit</th>
                                        <th>Season</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Winner</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($races as $race)
                                        <tr>
                                            <td>
                                        <a href="{{ route('f1.race.show', $race) }}" class="text-decoration-none">
                                            {{ $race->name }}
                                        </a>
                                    </td>
                                            <td>{{ optional($race->circuit)->name ?? 'Unknown' }}</td>
                                            <td>{{ optional($race->season)->year ?? 'Unknown' }}</td>
                                            <td>{{ optional($race->race_date)->format('M d, Y') }}</td>
                                            <td>{{ $race->status }}</td>
                                            <td>
                                                @php
                                                    $winner = $race->raceResults->firstWhere('position', 1);
                                                @endphp
                                                {{ optional($winner?->driver)->full_name ?? 'TBD' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
.race-name:hover {
    background: linear-gradient(135deg, #ff0000 0%, #cc0000 100%) !important;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255, 0, 0, 0.6);
}
</style>

@endsection
