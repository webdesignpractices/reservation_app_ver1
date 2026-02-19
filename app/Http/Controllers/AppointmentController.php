<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AppointmentController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
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
        
        $prevWeek = $startDate->copy()->subWeek()->format('m/d');
        $nextvWeek = $startDate->copy()->addWeek()->format('m/d');

        return view('appointments.index',['timeLists' => $timeLists,
                'days' => $days,
                'prevWeek' => $prevWeek,
                'nextWeek' => $nextvWeek
                ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
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
