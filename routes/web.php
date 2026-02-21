<?php

use Illuminate\Support\Facades\Route;
use App\Models\Appointment;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ServiceController;

//メニュー(service)画面表示
Route::get('/services',[ServiceController::class,'index'])->name('services.index');
Route::get('/customer/appoint/{service}', [AppointmentController::class,'index'])->name('appointments.index');
//create,read,update,destroy
