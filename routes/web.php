<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Add routes for user management

    Route::get('/users/create', function () {
        return view('users.create');
    });

    Route::get('/users', function () {
        return view('users.index');
    });

    Route::get('/users/{id}/edit', function ($id) {
        return view('users.edit', ['id' => $id]);
    });

    // Route::get('/users/{id}/details', [UserController::class, 'show'])->name('user.show');

    // Add routes for role management

    // Add routes for permission management

    // Add routes for setting management

});

// Define a resource route for users
Route::resource('users', UserController::class);

// Define a resource route for roles
Route::resource('roles', RoleController::class, [
    'show' => view('roles.show', ['role' => 'id']),
    'edit' => view('roles.edit', ['role' => 'id']),
    'create' => view('roles.create'),
    'destroy' => view('roles.destroy', ['role' => 'id']),
]);




// Define a resource route for permissions
Route::resource('permissions', PermissionController::class);
Route::get('/permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
//Route [permission.show]
Route::get('/permission/{id}/details', [PermissionController::class, 'show'])->name('permission.show');

// Define a route for confirmation
Route::get('/{modelType}/delete/{modelId}', function ($modelType, $modelId) {
    $routeTo = \strtolower($modelType) . 's.destroy';
    return view($routeTo, ['modelType' => $modelType, 'modelId' => $modelId]);
})->name('delete.confirmation');



require __DIR__ . '/auth.php';
