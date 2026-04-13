@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manage Drivers</h4>
                    <div>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Admin
                        </a>
                        <a href="{{ route('admin.f1.drivers.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add Driver
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
                                    <th>Code</th>
                                    <th>Number</th>
                                    <th>Nationality</th>
                                    <th>Team</th>
                                    <th>Date of Birth</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($drivers as $driver)
                                    <tr>
                                        <td><a>{{ $driver->first_name }} {{ $driver->last_name }}</a></td>
                                        <td><span class="badge bg-secondary">{{ $driver->code }}</span></td>
                                        <td>{{ $driver->number }}</td>
                                        <td>{{ $driver->nationality }}</td>
                                        <td>
                                            @if($driver->team)
                                                {{ $driver->team->name }}
                                            @else
                                                <span class="text-muted">No Team</span>
                                            @endif
                                        </td>
                                        <td>{{ optional($driver->date_of_birth)->format('M d, Y') ?? 'Unknown' }}</td>
                                        <td>
                                            @if($driver->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">

                                                <a href="{{ route('admin.f1.drivers.edit', $driver) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.f1.drivers.destroy', $driver) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this driver?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No drivers found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $drivers->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
