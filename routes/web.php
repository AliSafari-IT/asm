<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralInfo\AboutController;

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

Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['guest', ''])->name('welcome');

Route::middleware('guest')->group(function () { // Use the "guest" middleware to ensure the user is not authenticated

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    });

    Route::get('/forgot-password', function () {
        return view('auth.passwords.email');
    });

    Route::get('/reset-password', function () {
        return view('auth.passwords.reset');
    });

    Route::get('/verify-email', function () {
        return view('auth.verify');
    });

    Route::get('/', function () {
        return view('welcome');

    })->name('welcome');

});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('home');

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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

});


Route::get('/about', [AboutController::class, 'index'])->name('about');
require __DIR__ . '/auth.php';
