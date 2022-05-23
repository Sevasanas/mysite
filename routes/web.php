<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController as AdminController;

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

Auth::routes();
Route::get('/', [IndexController::class, 'index'])->name('home');


Route::name('news.')
    ->prefix('news')
    ->group(function(){
        Route::get('/', [NewsController::class, 'index'])->name('index');
        Route::get('/{id}', [NewsController::class, 'show'])->name('one');
    });

Route::name('admin.')
    ->prefix('admin')
    ->group(function(){
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/test', [AdminController::class, 'test'])->name('test');
        Route::get('/test_1', [AdminController::class, 'test_1'])->name('test_1');
    });

    Route::name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/test1', [AdminController::class, 'test1'])->name('test1');
        Route::get('/test2', [AdminController::class, 'test2'])->name('test2');
        Route::match(['get', 'post'],'/create', [AdminController::class, 'create'])->name('create');
    });
    Route::view('/about', 'about')->name('about');