<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ProductsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);

Route::middleware(['auth:api', 'role'])->group(function() {

    // List users
    Route::middleware(['scope:admin,moderator,basic'])->get('/users', function (Request $request) {

        return User::get();
    });

    // Add/Edit User
    Route::middleware(['scope:admin,moderator'])->post('/user', function(Request $request) {

        return User::create($request->all());
    });

    Route::middleware(['scope:admin,moderator'])->put('/user/{userId}', function(Request $request, $userId) {

    });


    Route::middleware(['scope:admin'])->get('/productdata',[ProductsController::class,'getProductData']);
});

