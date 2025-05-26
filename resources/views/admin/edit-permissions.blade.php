@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Permissions for {{ $user->name }}</h1>

    <form action="{{ route('admin.permissions.update', $user->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="permissions">Select Permissions:</label>
            @foreach ($permissions as $permission)
    <div>
        <input type="checkbox" name="permissions[]" value="{{ $permission->permission_id }}"
            {{ $user->role->permissions->contains($permission) ? 'checked' : '' }}>
        {{ $permission->description }}
    </div>
@endforeach
        </div>
        <button type="submit" class="btn btn-primary">Update Permissions</button>
    </form>
</div>
@endsection