<?php

use App\Http\Controllers\TutoringCommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TutoringController;
use App\Http\Controllers\TutoringDateController;

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

Route::get('users',[UserController::class,'index']);
Route::get('tutorings',[TutoringController::class,'index']);
Route::get('tutoringcomments',[TutoringCommentController::class,'index']);
Route::get('tutoringbyid/{id}',[TutoringController::class,'indexById']);

Route::post('user',[UserController::class,'save']);
Route::post('tutoring',[TutoringController::class,'save']);
Route::post('tutoringcomment',[TutoringCommentController::class,'save']);

Route::put('user/{id}',[UserController::class,'update']);
Route::put('tutoring/{id}',[TutoringController::class,'update']);
Route::put('tutoringdate/{id}',[TutoringDateController::class,'update']);

Route::delete('user/{id}', [UserController::class,'delete']);
Route::delete('tutoring/{id}', [TutoringController::class,'delete']);
