<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
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


Route::prefix('/auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::get('/', 'login')->name('login');
    Route::post('/', 'doLogin');
    Route::get('/register', 'register')->name('register');
    Route::post('/register', 'doRegister');
    Route::delete('/logout', 'logout')->name('logout');
});


Route::prefix('/blog')->name('blog.')->middleware('auth')->controller(PostController::class)->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store');
    Route::get('/{post}/edit', 'edit')->name('edit');
    Route::patch('/{post}/edit', 'update');
    Route::get('/{slug}-{post}', 'show')->where([
        'post' => '[0-9]+',
        'slug' => '[a-z0-9\-]+',
    ])->name('show');

    // Route::get('/{post}', 'show')->where([
    //     'post' => '[a-z0-9\-]+',
    // ])->name('show');

});