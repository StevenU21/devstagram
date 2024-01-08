<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Cache\Store;
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

Route::get('/', HomeController::class)->name('home');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogOutController::class, 'store'])->name('logout');

// Rutas para el perfil
Route::get('/profile', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/profile', [PerfilController::class, 'store'])->name('perfil.store');


Route::post('/images', [ImageController::class, 'store'])->name('images.store');
Route::post('/posts/create', [PostController::class, 'create'])->name('post.create');
Route::post('/posts', [PostController::class, 'store'])->name('post.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');

// Followers
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

// Posts
Route::get('/{user:username}', [PostController::class, 'index'])->name('post.index');
Route::post('/{user:username}/post/{post}', [CommentController::class, 'store'])->name('comments.store');
Route::get('/{user:username}/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

