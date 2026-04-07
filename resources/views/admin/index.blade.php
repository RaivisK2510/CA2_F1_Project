@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-lg-10">
            <h1 class="display-5">Admin Dashboard</h1>
            <p class="text-muted">Only users with administrator permissions can view and manage this page.</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text display-6 mb-0">{{ $counts['users'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">Posts</h5>
                    <p class="card-text display-6 mb-0">{{ $counts['posts'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">Races</h5>
                    <p class="card-text display-6 mb-0">{{ $counts['races'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">Teams</h5>
                    <p class="card-text display-6 mb-0">{{ $counts['teams'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-3">
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">Drivers</h5>
                    <p class="card-text display-6 mb-0">{{ $counts['drivers'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">Circuits</h5>
                    <p class="card-text display-6 mb-0">{{ $counts['circuits'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">Seasons</h5>
                    <p class="card-text display-6 mb-0">{{ $counts['seasons'] }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title">Results</h5>
                    <p class="card-text display-6 mb-0">{{ $counts['results'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Quick actions</h3>
                    <p class="text-muted">Use these links to access database sections and manage records.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Manage Users</a>
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-primary">Manage Posts</a>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-secondary">View Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
