@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Manage Races</h4>
                    <div>
                        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Back to Admin
                        </a>
                        <a href="{{ route('admin.f1.races.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus"></i> Add Race
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
                                    <th>Circuit</th>
                                    <th>Season</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($races as $race)
                                    <tr>
                                        <td>{{ $race->name }}</td>
                                        <td>{{ optional($race->circuit)->name ?? 'Unknown' }}</td>
                                        <td>{{ optional($race->season)->year ?? 'Unknown' }}</td>
                                        <td>{{ optional($race->race_date)->format('M d, Y') }}</td>
                                        <td>{{ $race->status }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.f1.races.edit', $race) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.f1.races.destroy', $race) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this race?')">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No races found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center">
                        {{ $races->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
