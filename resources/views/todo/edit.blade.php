@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Todo</h1>

    <form action="{{ route('todo.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $todo->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $todo->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="pending" {{ $todo->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $todo->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Todo</button>
    </form>
</div>
@endsection