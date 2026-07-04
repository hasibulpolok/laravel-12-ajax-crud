<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('index');
});

Route::get('/',[StudentController::class,'index'])->name('student.index');
