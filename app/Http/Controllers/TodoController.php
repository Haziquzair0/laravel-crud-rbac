<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $todos = Todo::where('user_id', $userId)->get();

        return view('todo.index', ['todos' => $todos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $user = Auth::user();

    // Debugging: Check the class of the $user object
    if (!$user instanceof \App\Models\User) {
        dd('Auth::user() is not an instance of User. Actual class: ' . get_class($user));
    }

    // Check if the user has the 'Create' permission
    if (!$user->hasPermission('Create')) {
        return redirect('todo')->with('error', 'You do not have permission to create a To-Do.');
    }

    return view('todo.add');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,completed',
        ]);

        $userId = Auth::id();
        $input = $request->only(['title', 'description', 'status']);
        $input['user_id'] = $userId;

        $todo = Todo::create($input);

        return $todo
            ? redirect('todo')->with('success', 'Todo successfully added.')
            : redirect('todo')->with('error', 'Oops, something went wrong. Todo not saved.');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $userId = Auth::id();
        $todo = Todo::where(['user_id' => $userId, 'id' => $id])->first();

        if (!$todo) {
            return redirect('todo')->with('error', 'Todo not found.');
        }

        return view('todo.show', ['todo' => $todo]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $user = Auth::user();

    if (!$user->hasPermission('Update')) {
        return redirect('todo')->with('error', 'You do not have permission to edit a To-Do.');
    }

    $userId = Auth::id();
    $todo = Todo::where(['user_id' => $userId, 'id' => $id])->first();

    if (!$todo) {
        return redirect('todo')->with('error', 'Todo not found.');
    }

    return view('todo.edit', ['todo' => $todo]);
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
{
    $user = Auth::user();

    if (!$user->hasPermission('Update')) {
        return redirect('todo')->with('error', 'You do not have permission to update a To-Do.');
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'status' => 'required|in:pending,completed',
    ]);

    $userId = Auth::id();
    $todo = Todo::where(['user_id' => $userId, 'id' => $id])->first();

    if (!$todo) {
        return redirect('todo')->with('error', 'Todo not found.');
    }

    $input = $request->only(['title', 'description', 'status']);
    $updated = $todo->update($input);

    return $updated
        ? redirect('todo')->with('success', 'Todo successfully updated.')
        : redirect('todo')->with('error', 'Oops, something went wrong. Todo not updated.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $user = Auth::user();

    if (!$user->hasPermission('Delete')) {
        return redirect('todo')->with('error', 'You do not have permission to delete a To-Do.');
    }

    $userId = Auth::id();
    $todo = Todo::where(['user_id' => $userId, 'id' => $id])->first();

    if (!$todo) {
        return redirect('todo')->with('error', 'Todo not found.');
    }

    $deleted = $todo->delete();

    return $deleted
        ? redirect('todo')->with('success', 'Todo deleted successfully.')
        : redirect('todo')->with('error', 'Oops, something went wrong. Todo not deleted.');
}
}