<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Staff;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AppointmentController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,Service $service,Staff $staff)
    {   
        $baseDate = Carbon::parse($request->query('date',today()));
        $startDate = $baseDate->copy()->startOfWeek(Carbon::MONDAY);
        
        $days = [];
        for($i = 0; $i < 7; $i++){
            $days[] = $startDate->copy()->addDays($i);
        }
        $slots = CarbonPeriod::since('9:00')->minutes(30)->until('18:00');
        $timeLists = [];
        foreach($slots as $slot){
            $timeLists[] = $slot->format('H:i');
        }
        
        $prevWeek = $startDate->copy()->subWeek()->format('Y-m-d');
        $nextWeek = $startDate->copy()->addWeek()->format('Y-m-d');

        return view('appointments.index',['timeLists' => $timeLists,
                'days' => $days,
                'prevWeek' => $prevWeek,
                'nextWeek' => $nextWeek,
                'service' => $service,
                'staff' => $staff
                ]);
    }
    public function confirm(Request $request,Service $service , Staff $staff){
        $selectedDate = $request->query('date');//"2026-02-25"
        $selectedTime = $request->query('time');//"11:00"

        $startTime = Carbon::parse($selectedDate.''.$selectedTime);
        $endTime = $startTime->copy()->addMinutes($service->duration_minutes);

        return view('appointments.confirm',[
            'service' => $service,
            'staff' => $staff,
            'date' => $selectedDate,
            'startTime' => $startTime->format('H:i'),
            'endTime' => $endTime->format('H:i'),
        ]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Service $service,Staff $staff)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
