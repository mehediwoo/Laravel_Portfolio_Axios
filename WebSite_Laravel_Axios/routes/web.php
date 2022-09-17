<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\TurmsController;
use App\Http\Controllers\ContactController;

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

Route::get('/',[HomeController::class,'index']);
Route::post('/contact',[HomeController::class,'SendContactForm']);

Route::get('/course',[CourseController::class,'index']);
Route::get('/project',[ProjectController::class,'index']);
Route::get('/policy',[PolicyController::class,'index']);
Route::get('/turms',[TurmsController::class,'index']);
Route::get('/contact',[ContactController::class,'index']);

 