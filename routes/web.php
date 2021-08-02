<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/', function(){
    return view('index');
});

Auth::routes();

//clients
Route::get('/clients', [App\Http\Controllers\ClientsController::class, 'index'])->name('clients');
Route::get('/new-clients', [App\Http\Controllers\ClientsController::class, 'new'])->name('new-clients');
Route::post('/save-clients', [App\Http\Controllers\ClientsController::class, 'save'])->name('save-clients');

//products
Route::get('/products', [App\Http\Controllers\ProductsController::class, 'index'])->name('products');
Route::get('/new-products', [App\Http\Controllers\ProductsController::class, 'new'])->name('new-products');
Route::post('/save-products', [App\Http\Controllers\ProductsController::class, 'save'])->name('save-products');

//requests
Route::get('/requests', [App\Http\Controllers\RequestsController::class, 'index'])->name('requests');
Route::get('/new-requests', [App\Http\Controllers\RequestsController::class, 'new'])->name('new-requests');
Route::post('/save-requests', [App\Http\Controllers\RequestsController::class, 'save'])->name('save-requests');
Route::get('/show-requests/{number_request}', [App\Http\Controllers\RequestsController::class, 'show'])->where('number_request', '.*')->name('show-requests');