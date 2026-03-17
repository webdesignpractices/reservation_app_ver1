<?php

namespace App\Http\Controllers;

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Session;
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

        $selectedServiceIds = session('selected.service_ids',[]);
        $selectedServices = Service::whereIn('id',$selectedServiceIds)->get();

        $selectedStaffId = session('selected.staff_id');
        $selectedStaff = Staff::findOrFail($selectedStaffId);

        return view('appointments.index',['timeLists' => $timeLists,
                'days' => $days,
                'prevWeek' => $prevWeek,
                'nextWeek' => $nextWeek,
                'selectedServices' => $selectedServices,
                'selectedStaff' => $selectedStaff,
                ]);
    }
    public function confirm(Request $request){
        $selectedServiceIds = session('selected.service_ids',[]);
        $selectedServices = Service::whereIn('id',$selectedServiceIds)->get();

        $selectedStaffId = session('selected.staff_id');
        $selectedStaff = Staff::findOrFail($selectedStaffId);

        $selectedDate = $request->query('date');//"2026-02-25"
        $selectedTime = $request->query('time');//"11:00"

        $startTime = Carbon::parse($selectedDate.''.$selectedTime);
        $totalDuration = $selectedServices->sum('duration_minutes');
        $endTime = $startTime->copy()->addMinutes($totalDuration);

        return view('appointments.confirm',[
            'selectedServices' => $selectedServices,
            'selectedStaff' => $selectedStaff,
            'date' => $selectedDate,
            'startTime' => $startTime->format('H:i'),
            'endTime' => $endTime->format('H:i'),
        ]);

    }

    public function postServise(Request $request){

        $validated = $request->validate(['service_ids' => 'required']);
        session(['selected.service_ids' => $validated['service_ids']]);
        //dd(session('selected.service_ids'));
        return redirect()->route('menu.staff.index');

    }
    public function postStaff(Request $request){
        $validated = $request->validate(['staff_id' => 'required']);
        session(['selected.staff_id' => $validated['staff_id']]);
        //dd(session('selected.staff_id'));
        return redirect()->route('appointments.index');

    }

    public function postDateTime(Request $request){
        $validated = $request->validate(['date' => 'required',
        'time' => 'required']);
        session(['selected.date_time' => $validated]);
        //dd(session('selected.date_time'));
        return redirect()->route('appointments.confirm');

    }

    public function create(Service $service,Staff $staff)
    {

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
