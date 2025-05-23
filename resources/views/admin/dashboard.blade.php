@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Admin Dashboard</h2>
    <div class="mt-4">
        <!-- Add links to manage users and roles -->
        <a href="{{ route('admin.users') }}" class="btn btn-primary">Manage Users</a>
        <a href="{{ route('admin.roles') }}" class="btn btn-secondary">Manage Roles</a>
    </div>
</div>
@endsection