<?php

use Illuminate\Support\Facades\Route;
use App\Models\Appointment;
use App\Http\Controllers\AppointmentController;


Route::get('/customer/appoint/', [AppointmentController::class,'index'])->name('appointments.index');
//create,read,update,destroy
