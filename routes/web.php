<?php

use App\Http\Controllers\BatchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutineController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;

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



Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get("/password/change", [PasswordController::class, 'password_change'])->name('password.change')->middleware('verified');
    Route::post("/password/change", [PasswordController::class, 'update_password'])->name('update.password')->middleware('verified');

    Route::resource("department", DepartmentController::class);



    Route::prefix("/batch")->name("batch.")->group(function () {
        Route::get("/bydept/{dept_id}", [BatchController::class, "byDept"])->name("bydept");
    });
    Route::resource("batch", BatchController::class);


    Route::prefix("/exam")->name("exam.")->group(function () {
        Route::get("/print/{exam}", [ExamController::class, "print"])->name("print");
    });
    Route::resource("exam", ExamController::class);

    Route::resource("routine", RoutineController::class);
    Route::resource("subject", SubjectController::class);
    Route::prefix("/subject")->name("subject.")->group(function () {
        Route::get("/bydept/{dept_id}", [SubjectController::class, "byDept"])->name("bydept");
    });
    Route::resource("teacher", TeacherController::class);
});

require __DIR__.'/auth.php';
