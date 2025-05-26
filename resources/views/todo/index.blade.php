@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your To-Do List</h1>

    <!-- Display success or error messages -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Button to create a new task (visible only if the user has 'Create' permission) -->
    @if (Auth::user()->hasPermission('Create'))
        <a href="{{ route('todo.add') }}" class="btn btn-primary mb-3">New Task</a>
    @endif

    <!-- To-Do List Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($todos as $todo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>{{ ucfirst($todo->status) }}</td>
                    <td>
                        <!-- Edit button (visible only if the user has 'Update' permission) -->
                        @if (Auth::user()->hasPermission('Update'))
                            <a href="{{ route('todo.edit', $todo->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        @endif

                        <!-- Delete button (visible only if the user has 'Delete' permission) -->
                        @if (Auth::user()->hasPermission('Delete'))
                            <form action="{{ route('todo.delete', $todo->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No To-Do items found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection