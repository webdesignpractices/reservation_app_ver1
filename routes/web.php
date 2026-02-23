<?php

use Illuminate\Support\Facades\Route;
use App\Models\Appointment;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StaffController;

//メニュー(service)画面表示
Route::get('/menu/services',[ServiceController::class,'index'])->name('menu.services.index');
//スタッフの指名画面
Route::get('/menu/services/{service}',[StaffController::class,'index'])->name('menu.staff.index');
//予約日時選択画面
Route::get('/customer/appoint/{service}/{staff}', [AppointmentController::class,'index'])->name('appointments.index');

