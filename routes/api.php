<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;

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


Route::get('students', [StudentController::class, 'index']);
Route::get('students/all', [StudentController::class, 'allStudents']);
Route::delete('students/{student}', [StudentController::class, 'destroy']);
Route::delete('students/mass-destroy/{students}', [StudentController::class, 'massDestroy']);
Route::get('students/export/{students}', [StudentController::class, 'export']);

Route::get('classes', [ClassesController::class, 'index']);

Route::get('sections', [SectionController::class, 'index']);