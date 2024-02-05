<?php

use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

//use Illuminate\Http\Request;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    dd('here');
//    return $request->user();

//    Route::middleware('auth:sanctum')
//        ->get('/user', function (Request $request) {
//
//            $user = auth()->user();
//
//            return $user->email;
//        });
//

//});
//Route::middleware('auth:sanctum')
//    ->get('/user', function (Request $request) {
//        $user = auth()->user();
//        return $user->email;
//    });

Route::middleware(['auth:sanctum', 'role'])->prefix('courses')->group(function () {
    Route::get('/', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/my_courses', [CourseController::class, 'my_courses']);
//    Route::apiResource('/', _CourseController::class);
    Route::get('/show/{id}', [CourseController::class, 'show'])->name('courses.show');

    Route::post('/create', [CourseController::class, 'create'])->name('courses.create');
    Route::put('/edit/{id}', [CourseController::class, 'edit'])->name('courses.edit');
    Route::delete('/delete/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
});

Route::middleware(['auth:sanctum', 'role'])->prefix('moderator')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('moderator.index');
    Route::get('/show/{id}', [UserController::class, 'show'])->name('moderator.show');
    Route::post('/create', [UserController::class, 'create'])->name('moderator.create');
    Route::put('/edit/{id}', [UserController::class, 'edit'])->name('moderator.edit');


    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('moderator.destroy');

});
