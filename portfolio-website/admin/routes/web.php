<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PhotoController;

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


Route::get('/Login',[AdminController::class,'logInIndex']);
Route::post('/onLogin',[AdminController::class,'onLogin']);
Route::get('/LogOut',[AdminController::class,'onLogOut']);

Route::middleware(['logInCheck'])->group(function () {
    Route::get('/',[HomeController::class,'HomeIndex']);
Route::get('/visitor',[VisitorController::class,'VisitorIndex']);
Route::get('/service',[ServiceController::class,'ServiceIndex']);
Route::get('/getServiceData',[ServiceController::class,'getServiceData']);
Route::post('/serviceDelete',[ServiceController::class,'serviceDelete']);
Route::post('/serviceDetails',[ServiceController::class,'getServiceDetails']);
Route::post('/serviceUpdate',[ServiceController::class,'serviceUpdate']);
Route::post('/serviceAdd',[ServiceController::class,'serviceAdd']);


Route::get('/courses',[CoursesController::class,'CoursesIndex']);
Route::get('/getCourseData',[CoursesController::class,'getCoursesData']);
Route::post('/courseDelete',[CoursesController::class,'CoursesDelete']);
Route::post('/courseDetails',[CoursesController::class,'getCoursesDetails']);
Route::post('/courseUpdate',[CoursesController::class,'courseUpdate']);
Route::post('/courseAdd',[CoursesController::class,'courseAdd']);


Route::get('/project',[projectController::class,'projectIndex']);
Route::get('/getProjectData',[projectController::class,'getProjectData']);
Route::post('/projectDelete',[projectController::class,'projectDelete']);
Route::post('/projectDetails',[projectController::class,'getProjectDetails']);
Route::post('/projectUpdate',[projectController::class,'projectUpdate']);
Route::post('/projectAdd',[projectController::class,'projectAdd']);


Route::get('/contact',[ContactController::class,'contactIndex']);
Route::get('/getContactData',[ContactController::class,'getContactData']);
Route::post('/contactDelete',[ContactController::class,'contactDelete']);


Route::get('/blog',[BlogController::class,'blogIndex']);
Route::get('/getBlogData',[BlogController::class,'getBlogData']);
Route::post('/blogDelete',[BlogController::class,'blogDelete']);
Route::post('/blogDetails',[BlogController::class,'getBlogDetails']);
Route::post('/blogUpdate',[BlogController::class,'blogUpdate']);
Route::post('/blogAdd',[BlogController::class,'blogAdd']);



Route::get('/review',[ReviewController::class,'reviewIndex']);
Route::get('/getReviewData',[ReviewController::class,'getReviewData']);
Route::post('/reviewDelete',[ReviewController::class,'reviewDelete']);
Route::post('/reviewDetails',[ReviewController::class,'getReviewDetails']);
Route::post('/reviewUpdate',[ReviewController::class,'reviewUpdate']);
Route::post('/reviewAdd',[ReviewController::class,'reviewAdd']);





Route::get('/photo',[PhotoController::class,'PhotoIndex']);
Route::post('/PhotoUpload',[PhotoController::class,'PhotoUpload']);
Route::get('/PhotoJSON', [PhotoController::class,'PhotoJSON']);
Route::get('/PhotoJSONByID/{id}', [PhotoController::class,'PhotoJSONByID']);
Route::post('/PhotoDelete', [PhotoController::class,'PhotoDelete']);

});
