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
                                            <td>{{ $race->name }}</td>
                                            <td>{{ optional($race->circuit)->name ?? 'Unknown' }}</td>
                                            <td>{{ optional($race->season)->year ?? 'Unknown' }}</td>
                                            <td>{{ optional($race->race_date)->format('M d, Y') }}</td>
                                            <td>{{ $race->status }}</td>
                                            <td>
                                                @php
                                                    $winner = $race->raceResults->firstWhere('position', 1);
                                                @endphp
                                                {{ optional($winner?->driver)->name ?? 'TBD' }}
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
@endsection
