<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\StoreDatetimeRequest;
use App\Models\Service;
use App\Models\User;
use App\Models\Staff;
use App\Models\Appointment;
use Carbon\Carbon;

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
    public function store(Request $request){

    $validated = $request->validate([

        'user_id'       => 'nullable|exists:users,id', // 会員ID（ゲストの場合はダミーIDやnull）
        'staff_id'      => 'required|exists:staff,id',
        'service_ids'   => 'required|array',
        'service_ids.*' => 'exists:services,id',
        'start_at'      => 'required|date',
        'memo'          => 'nullable|string',
    ]);


        $startAt = Carbon::parse($validated['start_at']);
        $totalDurationMinutes = Service::whereIn('id', $validated['service_ids'])->sum('duration_minutes');
        $endAt = $startAt->copy()->addMinutes((int)$totalDurationMinutes);
        $staff = Staff::find($validated['staff_id']);

        $appointment = Appointment::create([
            'user_id' => $validated['user_id'] ?? 999,
            'staff_id' => $validated['staff_id'],
            'staff_name' => $staff->name,
            'start_at' => $startAt,
            'end_at' => $endAt,
            'memo' => $validated['memo'] ?? null,
        ]);

        $appointment->services()->sync($validated['service_ids']);

        return redirect()->route('admin.calendar.index');
    }
}
