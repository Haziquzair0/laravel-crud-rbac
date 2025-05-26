@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Task for {{ $user->name }}</h1>

    <form action="{{ route('admin.user-todo.store', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Create Task</button>
    </form>
</div>
@endsection