<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\StaffController;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\StoreDatetimeRequest;
use Illuminate\Support\Facades\Session;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Http\Controllers\Auth;
use App\Services\CalendarService;

class AdminCalendarController extends Controller
{
    public function index(Request $request ,CalendarService $calendarSevice){
        $calendarData = $calendarSevice->getCalendarSkeleton($request);
        $sessionData = $calendarSevice->getConditionsFromSession();
        $appointments = $calendarSevice->getAppointments(
        $calendarData['startDate'],
        $sessionData['selectedStaffId']);

        

        return view('appointments.index',[
            'timeLists' => $calendarData['timeLists'],
            'days' => $calendarData['days'],
            'prevWeek' => $calendarData['prevWeek'],
            'nextWeek' => $calendarData['nextWeek'],
            'isAdmin' => $calendarData['isAdmin'],
            'selectedServices' => $sessionData['selectedServices'],
            'selectedStaff' => $sessionData['selectedStaff'],
            'appointments' => $appointments,        
            ]);

    }


}
