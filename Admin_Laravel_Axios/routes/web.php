<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;


//Admin Login managment
Route::get('/login',[LoginController::class,'login']);
Route::get('/logOut',[LoginController::class,'logOut']);
Route::post('/onlogin',[LoginController::class,'onlogin']);

// Dashboard Section Managment
Route::get('/',[HomeController::class,'index'])->middleware('loginCheck');

// Visitor Section Managment
Route::get('/visitor',[VisitorController::class,'visitor'])->middleware('loginCheck');
Route::get('/ip',[VisitorController::class,'ip'])->middleware('loginCheck');

// Service Section Managment

Route::get('/service',[ServiceController::class,'index'])->middleware('loginCheck');
Route::get('/getServiceData',[ServiceController::class,'getServiceData'])->middleware('loginCheck');
Route::post('/ServiceDelete',[ServiceController::class,'ServiceDelete'])->middleware('loginCheck');
Route::post('/ServiceDetails',[ServiceController::class,'getServiceDetails'])->middleware('loginCheck');
Route::post('/ServiceUpdate',[ServiceController::class,'ServiceUpdate'])->middleware('loginCheck');
Route::post('/ServiceAdd',[ServiceController::class,'ServiceAdd'])->middleware('loginCheck');

//Course Section Managment
Route::get('/course', [CourseController::class,'index'])->middleware('loginCheck');
Route::get('/getCourse', [CourseController::class,'CourseDetails'])->middleware('loginCheck');
Route::post('/delCourse', [CourseController::class,'CourseDelete'])->middleware('loginCheck');
Route::post('/CourseEdit', [CourseController::class,'CourseEdit'])->middleware('loginCheck');
Route::post('/CourseUpdate', [CourseController::class,'CourseUpdate'])->middleware('loginCheck');
Route::post('/CourseInsert', [CourseController::class,'CourseInsert'])->middleware('loginCheck');

//Project Section Managment
Route::get('/project', [ProjectController::class,'index'])->middleware('loginCheck');
Route::get('/getProject', [ProjectController::class,'GetProject'])->middleware('loginCheck');
Route::post('/DeleteProject', [ProjectController::class,'DeleteProject'])->middleware('loginCheck');
Route::post('/ProjectDetails', [ProjectController::class,'getProjectDetails'])->middleware('loginCheck');
Route::post('/ProjectUpdate', [ProjectController::class,'ProjectUpdate'])->middleware('loginCheck');
Route::post('/InsertProject', [ProjectController::class,'InsertProject'])->middleware('loginCheck');

//Contact Us Managment Syastem
Route::get('/contact',[ContactController::class,'index'])->middleware('loginCheck');
Route::post('/getContact',[ContactController::class,'getContact'])->middleware('loginCheck');
Route::post('/contactDelete',[ContactController::class,'contactDelete'])->middleware('loginCheck');

//Review Managment Systeam
Route::get('/review',[ReviewController::class,'index'])->middleware('loginCheck');
Route::get('/getData',[ReviewController::class,'GetData'])->middleware('loginCheck');
Route::post('/delData',[ReviewController::class,'DeleteData'])->middleware('loginCheck');

//Photo Managment Systeam
Route::get('/photo',[PhotoController::class,'index'])->middleware('loginCheck');
Route::post('/upPhoto',[PhotoController::class,'PhotoUpload'])->middleware('loginCheck');
Route::get('/getImg',[PhotoController::class,'GetPhoto'])->middleware('loginCheck');
Route::get('/loadMore/{id}',[PhotoController::class,'GetPhotoLoadMore'])->middleware('loginCheck');
