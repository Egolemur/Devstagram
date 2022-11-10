<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\RegisterController;

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

Route::get('/', function () {
    return view('main');
});

Route::get('/sign-up', [RegisterController::class, 'index'])->name('register');
Route::post('/sign-up', [RegisterController::class, 'store']); 

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/{user:username}/posts/{post}', [CommentController::class, 'store'])->name('comment.store');

Route::post('/images', [ImageController::class, 'store'])->name('images.store');

// Like a las fotos
Route::post('/posts/{post}/like', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/dislike', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

// Ver quien ha dado like a las publicaciones
Route::post('/posts/{post}/like/view', [LikeController::class, 'index'])->name('posts.likes.index');

// Rutas para el perfil
Route::get('{user:username}/edit-profile', [PerfilController::class, 'index'])->name('profile.index');
Route::post('{user:username}/edit-profile', [PerfilController::class, 'store'])->name('profile.store');

// Srguir a otros usuarios
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');