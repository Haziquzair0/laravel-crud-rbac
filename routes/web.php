<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;

// Homepage route
Route::get('/', function () {
    if (Auth::check()) {
        $role = optional(Auth::user()->role)->role_name;

        if ($role === 'Admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role === 'User') {
            return redirect()->route('todo.index');
        }
    }

    return view('welcome'); // Redirect to the homepage (login/register page)
})->name('home');

// Authentication routes
Auth::routes();

// To-Do routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::resource('todo', TodoController::class);
    Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.add');
    Route::post('/todo/store', [TodoController::class, 'store'])->name('todo.store');
    Route::get('/todo/{id}/edit', [TodoController::class, 'edit'])->name('todo.edit');
    Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');
    Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');
});

// Profile routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes for authenticated users with admin role
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/user-tasks/{id}', [AdminController::class, 'userTasks'])->name('admin.user-tasks');
    Route::put('/admin/deactivate-user/{id}', [AdminController::class, 'deactivateUser'])->name('admin.deactivate-user');

    // Assign permissions to users
    Route::get('/admin/permissions/{id}', [AdminController::class, 'editPermissions'])->name('admin.edit-permissions');
    Route::post('/admin/permissions/{id}', [AdminController::class, 'updatePermissions'])->name('admin.permissions.update');

    // Manage user To-Do tasks
    Route::get('/admin/user-todos/{id}', [AdminController::class, 'userTodos'])->name('admin.user-todos');
    Route::get('/admin/user-todos/{id}/create', [AdminController::class, 'createUserTodo'])->name('admin.user-todo.create');
    Route::post('/admin/user-todos/{id}/store', [AdminController::class, 'storeUserTodo'])->name('admin.user-todo.store');
    Route::get('/admin/user-todos/{userId}/edit/{todoId}', [AdminController::class, 'editUserTodo'])->name('admin.user-todo.edit');
    Route::put('/admin/user-todos/{userId}/update/{todoId}', [AdminController::class, 'updateUserTodo'])->name('admin.user-todo.update');
    Route::delete('/admin/user-todos/{userId}/delete/{todoId}', [AdminController::class, 'deleteUserTodo'])->name('admin.user-todo.delete');
});