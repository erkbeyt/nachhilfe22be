<?php

use App\Http\Controllers\TutoringCommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TutoringController;
use App\Http\Controllers\TutoringDateController;
use App\Http\Controllers\AuthController;


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
//protected routes
Route::group(['middleware'=>['api','auth.jwt']], function(){
    Route::post('user',[UserController::class,'save']);
    Route::post('tutoring',[TutoringController::class,'save']);
    Route::post('tutoringcomment',[TutoringCommentController::class,'save']);
    Route::post('tutoringdate',[TutoringDateController::class,'save']);


    Route::put('user/{id}',[UserController::class,'update']);
    Route::put('tutoring/{id}',[TutoringController::class,'update']);
    Route::put('tutoringdate/{id}',[TutoringDateController::class,'update']);

    Route::delete('user/{id}', [UserController::class,'delete']);
    Route::delete('tutoring/{id}', [TutoringController::class,'delete']);

    Route::post('auth/logout',[AuthController::class,'logout']);
});

//auth test
Route::post('auth/login',[AuthController::class,'login']);

Route::get('users',[UserController::class,'index']);
Route::get('userbyid/{id}',[UserController::class,'indexById']);
Route::get('tutorings',[TutoringController::class,'index']);
Route::get('tutoringcomments',[TutoringCommentController::class,'index']);
Route::get('tutoringdates',[TutoringDateController::class,'index']);
Route::get('tutoringbyid/{id}',[TutoringController::class,'indexById']);
Route::get('indexbyuser/{id}',[TutoringController::class,'indexByUser']);
