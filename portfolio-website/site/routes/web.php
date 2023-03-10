<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;
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

Route::get('/',[HomeController::class,'HomeIndex'] );
Route::post('/contactSend',[HomeController::class,'contactSend'] );



Route::get('/project',[ProjectController::class,'projectIndex'] );
Route::get('/course',[CourseController::class,'courseIndex'] );
Route::get('/blog',[BlogController::class,'blogIndex'] );
Route::get('/contact',[ContactController::class,'contactIndex'] );

Route::get('/terms',function(){
	return view('terms');
});
Route::get('/policy',function(){
	return view('policy');
});

