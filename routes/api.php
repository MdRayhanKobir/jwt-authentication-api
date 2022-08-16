<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
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

// all api route
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

Route::group(['middleware'=>['api']],function(){

     Route::get('/profile',[UserController::class,'profile']);
     Route::get('/logout',[UserController::class,'logout']);

    //  course all route api
    Route::post('/course-ebrollment',[CourseController::class,'courseEnrollment']);
    Route::get('/totalCourse',[CourseController::class,'totalCourse']);
    Route::get('/delete/{id}',[CourseController::class,'delete']);


});



















Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

