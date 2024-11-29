<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
//take the uri and callback function invoked when routing is requested by using the uri
Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts',[PostController::class, 'index']) -> name('posts.index'); //shortcut


//static routes before dynamic routes
Route::get('/posts/create', [PostController::class,'create']) -> name('posts.create'); //shortcut

Route::post('/posts', [PostController::class, 'store']) -> name('posts.store'); //shortcut

Route::get('/posts/{post}',[PostController::class,'show']) -> name('posts.show'); //another shortcut

Route::get('/posts/{post}/edit',[PostController::class,'edit']) -> name('posts.edit'); //another shortcut

Route::put('/posts/{post}', [PostController::class, 'update']) -> name('posts.update'); //another shortcut

Route::delete('/posts/{post}', [PostController::class,'destroy']) -> name('posts.destroy'); //another shortcut