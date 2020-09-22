<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

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
    return view('welcome');
});

Auth::routes();

/* 
* Guest Routes
*/
Route::get('guest/home', [HomeController::class, 'index'])->name('home');
Route::get('guest/posts/{id}', [PostController::class, 'guestPost']);
/* 
* Author Routes
*/
Route::middleware(['is_author'])->group(function () 
{
    Route::prefix('author')->group(function () {
    
        Route::get('/post/search/{keyword}',[PostController::class, 'search']);
        Route::get('home', [HomeController::class, 'authorHome'])->name('author.home');
        Route::post('posts/restore/{id}', [PostController::class, 'restore'])->name('restore');
        Route::get('posts/view-trashed', [PostController::class, 'viewTrashed']);
        Route::resource('posts', PostController::class);
    });

});