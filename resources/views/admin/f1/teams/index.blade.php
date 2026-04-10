@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manage Teams</h4>
                    <div>
                        <a href="{{ route('admin.f1.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                        <a href="{{ route('admin.f1.teams.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Team
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
                                    <th>Full Name</th>
                                    <th>Country</th>
                                    <th>Founded</th>
                                    <th>Principal</th>
                                    <th>Drivers</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($teams as $team)
                                    <tr>
                                        <td><strong>{{ $team->name }}</strong></td>
                                        <td>{{ $team->full_name }}</td>
                                        <td>{{ $team->country }}</td>
                                        <td>{{ $team->founded_year }}</td>
                                        <td>{{ $team->principal }}</td>
                                        <td>
                                            <span class="badge bg-info">{{ $team->drivers_count }}</span>
                                        </td>
                                        <td>
                                            @if($team->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.f1.teams.edit', $team) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.f1.teams.destroy', $team) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this team?')">
                                                        <i class="fas fa-trash"></i>
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
                        {{ $teams->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
