@extends('layouts.app')
@section('content')
<div class="container">
  <br>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2>Add Todo</h2>
        </div>
        <div class="col-md-6">
            <div class="float-right">
                <a href="{{ route('todo.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <br>
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-error" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            @php
                $user = Auth::user();
                $role = \App\Models\UserRole::where('user_id', $user->id)->first();
                $canCreate = false;

                if ($role) {
                    // Check if the role has the "Create" permission
                    if (method_exists($role, 'permissions')) {
                        $canCreate = $role->permissions()->where('description', 'Create')->exists();
                    } else {
                        $canCreate = \App\Models\RolePermission::where('role_id', $role->role_id)
                            ->where('description', 'Create')->exists();
                    }
                }
            @endphp

            @if($canCreate)
                <form action="{{ route('todo.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="title">Title:</label>
                      <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                      <label for="description">Description:</label>
                      <textarea name="description" class="form-control" id="description" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Select todo status</label>
                        <select class="form-control" id="status" name="status" required>
                          <option value="pending">Pending</option>
                          <option value="completed">Completed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            @else
                <div class="alert alert-warning">You do not have permission to create a new To-Do.</div>
            @endif
        </div>
    </div>
</div>
@endsection