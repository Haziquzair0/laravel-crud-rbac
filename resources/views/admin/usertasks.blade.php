@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tasks for {{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
<p>Role: {{ optional($user->role)->role_name ?? 'No Role Assigned' }}</p>    <h2>To-Do Tasks</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->todos as $todo)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>{{ $todo->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection