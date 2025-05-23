@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Manage Roles</h2>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Role Name</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
            <tr>
                <td>{{ $role->role_name }}</td>
                <td>{{ $role->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection