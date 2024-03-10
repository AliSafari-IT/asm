<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;


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

Route::get('/permissions', function () {
    return view('permissions');
}) ->middleware(['auth', 'verified']) ->name('permissions');


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

    // Add routes for role management

    // Add routes for permission management

    // Add routes for setting management

});

    // Define a resource route for users
    Route::resource('users', UserController::class);

    // Define a resource route for roles
    Route::resource('roles', RoleController::class);

    // Define a resource route for permissions
    Route::resource('permissions', PermissionController::class);

require __DIR__ . '/auth.php';
