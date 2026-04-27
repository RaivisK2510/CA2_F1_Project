@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-10">
            <h1 class="display-5 fw-bold">Admin Dashboard</h1>
            <p class="text-muted">Only users with administrator permissions can view and manage this page.</p>
        </div>
    </div>

    <!-- Use Bootstrap row-cols so cards reliably wrap into 1/2/3 columns on xs/sm/md+ -->
    <div class="row row-cols-2 row-cols-md-3 g-2 g-md-4 mb-4">
        <div class="col">
            <div class="card shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="card-body d-flex flex-column p-3 p-md-3">
                    <h5 class="card-title fs-6 fs-md-5 mb-1">Users</h5>
                    <p class="card-text stats-count mb-0">{{ $counts['users'] }}</p>
                    <div class="mt-auto pt-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm w-100">Manage Users</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="card-body d-flex flex-column p-3 p-md-3">
                    <h5 class="card-title fs-6 fs-md-5 mb-1">Races</h5>
                    <p class="card-text stats-count mb-0">{{ $counts['races'] }}</p>
                    <div class="mt-auto pt-2">
                        <a href="{{ route('admin.f1.races.index') }}" class="btn btn-warning btn-sm w-100">Manage Races</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="card-body d-flex flex-column p-3 p-md-3">
                    <h5 class="card-title fs-6 fs-md-5 mb-1">Teams</h5>
                    <p class="card-text stats-count mb-0">{{ $counts['teams'] }}</p>
                    <div class="mt-auto pt-2">
                        <a href="{{ route('admin.f1.teams.index') }}" class="btn btn-info btn-sm w-100">Manage Teams</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="card-body d-flex flex-column p-3 p-md-3">
                    <h5 class="card-title fs-6 fs-md-5 mb-1">Circuits</h5>
                    <p class="card-text stats-count mb-0">{{ $counts['circuits'] }}</p>
                    <div class="mt-auto pt-2">
                        <a href="{{ route('admin.f1.circuits.index') }}" class="btn btn-success btn-sm w-100">Manage Circuits</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="card-body d-flex flex-column p-3 p-md-3">
                    <h5 class="card-title fs-6 fs-md-5 mb-1">Drivers</h5>
                    <p class="card-text stats-count mb-0">{{ $counts['drivers'] }}</p>
                    <div class="mt-auto pt-2">
                        <a href="{{ route('admin.f1.drivers.index') }}" class="btn btn-secondary btn-sm w-100">Manage Drivers</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card shadow-sm h-100 rounded-4 overflow-hidden">
                <div class="card-body d-flex flex-column p-3 p-md-3">
                    <h5 class="card-title fs-6 fs-md-5 mb-1">Seasons</h5>
                    <p class="card-text stats-count mb-0">{{ $counts['seasons'] }}</p>
                    <div class="mt-auto pt-2">
                        <a href="{{ route('admin.f1.seasons.index') }}" class="btn btn-warning btn-sm w-100">Manage Seasons</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
body {
    background: url('/img/sitebg.gif') no-repeat center center fixed !important;
    background-size: cover !important;
}
body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 0;
    background: rgba(0, 0, 0, 0.5);
    pointer-events: none;
}
.container {
    position: relative;
    z-index: 1;
}
.card {
    background: rgba(255, 255, 255, 0.95);
}
.card-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}
.list-group-item {
    background: transparent;
}

/* Responsive stat numbers */
.stats-count {
    font-size: 1.5rem;
    font-weight: 700;
}
@media (min-width: 576px) {
    .stats-count {
        font-size: 1.75rem;
    }
}
</style>
@endsection
