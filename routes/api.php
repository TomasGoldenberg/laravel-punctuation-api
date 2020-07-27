<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post("/regist", "RegisterController@register");

Route::post("/sanctum/token", "UserTokenController");
Route::resource("/products","ProductController");
Route::resource("/categories","CategoryController");


Route::post("/newsletter" ,"NewsLetterController@sendNews");
Route::post("/verification" ,"NewsLetterController@sendReminder");

Route::post("/products/{product}/rate",[ProductRatingController::class, "rate"]);
Route::post("/products/{product}/unrate",[ProductRatingController::class, "unrate"]);
