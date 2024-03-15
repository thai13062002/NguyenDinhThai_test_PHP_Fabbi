<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StepController;
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

Route::get('/step1', [StepController::class, 'step1'])->name('step1');
Route::post('/step2', [StepController::class, 'step2'])->name('step2');
Route::any('/step3', [StepController::class, 'step3'])->name('step3');

Route::post('/step4', [StepController::class, 'step4'])->name('step4');
Route::post('/submit', [StepController::class, 'submit'])->name('submit');



