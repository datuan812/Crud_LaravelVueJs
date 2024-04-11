<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout']);


//Student
Route::get('/student/{id}', [StudentController::class, 'show']);

Route::get('/students', [StudentController::class, 'index']);

Route::get('/students/create', [StudentController::class, 'create']);

Route::post('/students', [StudentController::class, 'store']);

Route::get('/students/{id}/edit', [StudentController::class, 'edit']);

Route::put('/students/{id}', [StudentController::class, 'update']);

Route::delete('/students/{id}', [StudentController::class, 'destroy']);

Route::get('/students/search', [StudentController::class, 'searchByName']);

//Classes
Route::get('/class/{id}', [ClassController::class, 'show']);

Route::get('/classes', [ClassController::class, 'index']);

Route::get('/classes/create', [ClassController::class, 'create']);

Route::post('/classes', [ClassController::class, 'store']);

Route::get('/classes/{id}/edit', [ClassController::class, 'edit']);

Route::put('/classes/{id}', [ClassController::class, 'update']);

Route::delete('/classes/{id}', [ClassController::class, 'destroy']);

Route::get('/classes/search', [ClassController::class, 'searchByName']);

//Course
Route::get('/course/{id}', [CourseController::class, 'show']);

Route::get('/courses', [CourseController::class, 'index']);

Route::get('/courses/create', [CourseController::class, 'create']);

Route::post('/courses', [CourseController::class, 'store']);

Route::get('/courses/{id}/edit', [CourseController::class, 'edit']);

Route::put('/courses/{id}', [CourseController::class, 'update']);

Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

Route::get('/courses/search', [CourseController::class, 'searchByName']);
