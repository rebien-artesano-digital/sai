<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SaiController;

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


if(config('Sai.auth')){
    Route::get('/sai', [SaiController::class,'index'])->name('sai.index')->middleware('auth');
    Route::get('/sai/history',[SaiController::class,'history'])->name('sai.history')->middleware('auth');
    Route::post('/sai/send', [SaiController::class,'send'])->name('sai.send')->middleware('auth');
}else{
    Route::get('/sai', [SaiController::class,'index'])->name('sai.index');
    Route::get('/sai/history',[SaiController::class,'history'])->name('sai.history');
    Route::post('/sai/send', [SaiController::class,'send'])->name('sai.send');
}

