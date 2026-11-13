<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\User;
use App\Models\Staff;

class AdminCreateReservationController extends Controller
{
    public function create(Request $request){

        $date = $request->input('date');
        $time = $request->input('time');

        $services = Service::all();
        $users = User::all();
        $staff_s = Staff::all();

        return view('admin.reservation.create_reservation',[
            'date' => $date, 
            'time' => $time,
            'services' => $services,
            'users' => $users,
            'staff_s' => $staff_s,
            ]);
    }
}
