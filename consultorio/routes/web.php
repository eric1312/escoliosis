<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\CurveController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\AngleController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [PatientController::class, 'index']);
Route::resource('patients', PatientController::class);
Route::resource('curves', CurveController::class);
Route::resource('treatments', TreatmentController::class);
Route::get('/draw', [CurveController::class, 'draw'])->name('curves.draw');
Route::post('/curves/store', [CurveController::class, 'store'])->name('curves.store');
Route::post('/calculate-angle', [AngleController::class, 'calculateAngle']);