<?php

use App\Services\SaiServices;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;



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
    Route::post('/sai', function (Request $request) {
        $saiServices = new SaiServices($request);
        return $saiServices();
    })->name('sai.send')->middleware('auth');
}else{
    Route::post('/sai', function (Request $request) {
        $saiServices = new SaiServices($request);
        return $saiServices();
    })->name('sai.send');
}

