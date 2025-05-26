@extends('layouts.app')

@section('content')
<div class="container">
    <h1>To-Do List for {{ $user->name }}</h1>
    <a href="{{ route('admin.user-todo.create', $user->id) }}" class="btn btn-primary mb-3">New Task</a>

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
            @foreach ($user->todos as $todo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>{{ ucfirst($todo->status) }}</td>
                    <td>
                        <a href="{{ route('admin.user-todo.edit', [$user->id, $todo->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.user-todo.delete', [$user->id, $todo->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection