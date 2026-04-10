@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manage Circuits</h4>
                    <div>
                        <a href="{{ route('admin.f1.dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                        <a href="{{ route('admin.f1.circuits.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Add Circuit
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
                                        <td>{{ $circuit->first_grand_prix_year }}</td>
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
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.f1.circuits.destroy', $circuit) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this circuit?')">
                                                        <i class="fas fa-trash"></i>
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
                        {{ $circuits->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
