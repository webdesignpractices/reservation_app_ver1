<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;


class AdminCalendarController extends Controller
{
    public function index(Request $request){

        $baceDate = $request->input('date') 
        ? Carbon::parse($request->input('date')) 
        : Carbon::today();
        $startDate = $baceDate->copy()->startOfWeek(Carbon::MONDAY);

        $days = [];
        for($i = 0; $i<7; $i++){
            $days[] = $startDate->copy()->addDays($i);
        }
        $slots = CarbonPeriod::since('9:00')->minutes(30)->until('18:00');
        $timeLists = [];
        foreach($slots as $slot){
            $timeLists[] = $slot->format('H:i');
        }

        $prevWeek = $startDate->copy()->subWeek()->format('Y-m-d');
        $nextWeek = $startDate->copy()->addWeek()->format('Y-m-d');

        return view('admin.menu.calendar',[
            'days' => $days,
            //'slots' => $slots,
            'timeLists' => $timeLists,
            'prevWeek' => $prevWeek,
            'nextWeek' => $nextWeek,

        ]);
    }


}
