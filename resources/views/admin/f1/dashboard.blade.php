@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">F1 Data Management Dashboard</h4>
                    <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Admin
                    </a>
                </div>

                <div class="card-body">
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Drivers</h5>
                                    <h2>{{ $stats['total_drivers'] }}</h2>
                                    <a href="{{ route('admin.f1.drivers.index') }}" class="btn btn-light btn-sm mt-2">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Teams</h5>
                                    <h2>{{ $stats['total_teams'] }}</h2>
                                    <a href="{{ route('admin.f1.teams.index') }}" class="btn btn-light btn-sm mt-2">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Circuits</h5>
                                    <h2>{{ $stats['total_circuits'] }}</h2>
                                    <a href="{{ route('admin.f1.circuits.index') }}" class="btn btn-light btn-sm mt-2">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Seasons</h5>
                                    <h2>{{ $stats['total_seasons'] }}</h2>
                                    <a href="{{ route('admin.f1.seasons.index') }}" class="btn btn-light btn-sm mt-2">Manage</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Stats -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Races</h5>
                                    <h3 class="text-primary">{{ $stats['total_races'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Race Results</h5>
                                    <h3 class="text-primary">{{ $stats['total_results'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Quick Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 mb-2">
                                    <a href="{{ route('admin.f1.drivers.create') }}" class="btn btn-primary btn-block">
                                        <i class="fas fa-plus"></i> Add Driver
                                    </a>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <a href="{{ route('admin.f1.teams.create') }}" class="btn btn-success btn-block">
                                        <i class="fas fa-plus"></i> Add Team
                                    </a>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <a href="{{ route('admin.f1.circuits.create') }}" class="btn btn-info btn-block">
                                        <i class="fas fa-plus"></i> Add Circuit
                                    </a>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <a href="{{ route('admin.f1.seasons.create') }}" class="btn btn-warning btn-block">
                                        <i class="fas fa-plus"></i> Add Season
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
