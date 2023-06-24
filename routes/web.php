<?php

use App\Http\Controllers\AggregateController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserAggregateController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::view('/', 'welcome');
Route::get('/search', [SearchController::class, 'show'])->name('search');
Route::post('/search', [SearchController::class, 'search'])->name('search');
Route::get('/list', ListController::class);
Route::get('/aggregations', AggregateController::class);


Route::get('/item-search', [UserController::class, 'show'])->name('item-search');
Route::post('/item-search', [UserController::class, 'search'])->name('item-search');
Route::get('/item-list', UserListController::class);
Route::get('/item-aggregations', UserAggregateController::class);
