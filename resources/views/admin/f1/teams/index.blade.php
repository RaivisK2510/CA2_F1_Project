@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manage Teams</h4>
                    <div>
                        <a href="{{ route('admin.index') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left"></i> Back to Admin
                        </a>
                        <a href="{{ route('admin.f1.teams.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add Team
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="d-none d-sm-table-cell">Full Name</th>
                                    <th class="d-none d-sm-table-cell">Country</th>
                                    <th class="d-none d-md-table-cell">Founded</th>
                                    <th class="d-none d-lg-table-cell">Team Chief</th>
                                    <th class="d-none d-sm-table-cell">Drivers</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teams as $team)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <strong>{{ $team->name }}</strong>
                                                <small class="d-sm-none text-muted">{{ $team->full_name }} | {{ $team->country }}</small>
                                            </div>
                                        </td>
                                        <td class="d-none d-sm-table-cell">{{ $team->full_name }}</td>
                                        <td class="d-none d-sm-table-cell">{{ $team->country }}</td>
                                        <td class="d-none d-md-table-cell">{{ $team->founded_year }}</td>
                                        <td class="d-none d-lg-table-cell">{{ $team->team_chief }}</td>
                                        <td class="d-none d-sm-table-cell">
                                            <span class="badge bg-info">{{ $team->drivers_count }}</span>
                                        </td>
                                        <td>
                                            @if($team->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.f1.teams.edit', $team) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.f1.teams.destroy', $team) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this team?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No teams found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $teams->links('vendor.pagination.bootstrap-5') }}
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
    border: none;
}
.card-header {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}
.list-group-item {
    background: transparent;
}
</style>
@endsection
