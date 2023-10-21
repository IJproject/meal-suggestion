<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', function() {
    return Inertia::render('Home');
})->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/user/home', [UserController::class, 'home'])->name('user.home');
    Route::get('/user/map', [UserController::class, 'map'])->name('user.map');
    Route::get('/user/random', [UserController::class, 'random'])->name('user.random');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/blog/{blog}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
    Route::put('/blog/{blog}', [BlogController::class, 'update'])->name('blog.update');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
