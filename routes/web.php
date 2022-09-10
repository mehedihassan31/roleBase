<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |



Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login', [AuthController::class,'login']);

Auth::routes();

Route::middleware(['auth','role'])->group(function() {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/product', ProductsController::class);
Route::get('/products',[ProductsController::class,'getData']);

});

