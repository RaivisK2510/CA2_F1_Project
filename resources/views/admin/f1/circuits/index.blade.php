@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-4 overflow-hidden shadow-sm">
                <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manage Circuits</h4>
                    <div>
                        <a href="{{ route('admin.index') }}" class="btn btn-light">
                            <i class="bi bi-arrow-left"></i> Back to Admin
                        </a>
                        <a href="{{ route('admin.f1.circuits.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add Circuit
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
                                    <th>City</th>
                                    <th>Length (km)</th>
                                    <th>Corners</th>
                                    <th>First GP</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($circuits as $circuit)
                                    <tr>
                                        <td><strong>{{ $circuit->name }}</strong></td>
                                        <td>{{ $circuit->full_name }}</td>
                                        <td>{{ $circuit->country }}</td>
                                        <td>{{ $circuit->city }}</td>
                                        <td>{{ $circuit->length_km }}</td>
                                        <td>{{ $circuit->corners }}</td>
                                        <td>{{ $circuit->first_grand_prix }}</td>
                                        <td>
                                            @if($circuit->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.f1.circuits.edit', $circuit) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.f1.circuits.destroy', $circuit) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this circuit?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No circuits found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $circuits->links('vendor.pagination.bootstrap-5') }}
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
