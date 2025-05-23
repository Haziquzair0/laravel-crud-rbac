@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Manage Users</h2>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ optional($user->role)->role_name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection