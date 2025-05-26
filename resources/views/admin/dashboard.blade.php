@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Dashboard</h1>
    <p class="text-muted">Welcome, <strong>{{ Auth::user()->name }}</strong>! You are logged in as an admin.</p>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="mt-4">Registered Users</h2>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="{{ $user->active ? 'text-success' : 'text-danger' }}">
                            {{ $user->active ? 'Active' : 'Deactivated' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.edit-permissions', $user->id) }}" class="btn btn-primary btn-sm">Assign Permissions</a>
                        <form action="{{ route('admin.deactivate-user', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-warning btn-sm" {{ !$user->active ? 'disabled' : '' }}>
                                Deactivate
                            </button>
                        </form>
                        <a href="{{ route('admin.user-tasks', $user->id) }}" class="btn btn-info btn-sm">View Tasks</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection