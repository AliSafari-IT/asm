<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\GeneralInfo\AboutController;
use App\Http\Controllers\GeneralInfo\ContactController;
use App\Http\Controllers\GeneralInfo\PrivacyController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\KeywordController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TagController;
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

    // Define a route for confirmation
    Route::get('/{tableName}/delete/{modelId}', function ($tableName, $modelId) {
        $routeTo = \strtolower($tableName) . '.destroy';
        return view($routeTo, ['tableName' => $tableName, 'modelId' => $modelId]);
    })->name('delete.confirmation');

    // Define a resource route for roles
    Route::resource('roles', RoleController::class);
    // Define a resource route for permissions
    Route::resource('permissions', PermissionController::class);
    // Posts
    Route::resource('posts', PostController::class);
    // Categories
    Route::resource('categories', CategoryController::class);
    // Tags
    Route::resource('tags', TagController::class);
    // Settings
    Route::resource('settings', SettingController::class);
    // Comments
    Route::resource('comments', CommentController::class);
    // Articles
    Route::resource('articles', ArticleController::class);
    // Images
    Route::resource('images', ImageController::class);
    // Videos
    Route::resource('videos', VideoController::class);
    // Files
    Route::resource('files', FileController::class);
    // Keywords
    Route::resource('keywords', KeywordController::class);

});

// Define a route for the About, Contact, and Privacy pages
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/privacy', [PrivacyController::class, 'index'])->name('privacy');

require __DIR__ . '/auth.php';
