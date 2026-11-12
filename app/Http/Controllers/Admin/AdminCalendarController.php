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
    public function index(Request $request ,CalendarService $calendarService){
        
        $isAdmin = auth()->check() && auth()->user()->is_admin;

        $skeleton = $calendarService->getCalendarSkeleton($request);
        $sessionData = $calendarService->getConditionsFromSession();
        $calendarData = $calendarService->getReservedData($isAdmin);
        $appointments = $calendarService->getAppointments(
        $skeleton['startDate'],
        $sessionData['selectedStaffId']);

    
        return view('admin.menu.calendar',[
            'timeLists' => $skeleton['timeLists'],
            'days' => $skeleton['days'],
            'prevWeek' => $skeleton['prevWeek'],
            'nextWeek' => $skeleton['nextWeek'],
            'isAdmin' => $skeleton['isAdmin'],
            'selectedServices' => $sessionData['selectedServices'],
            'selectedStaff' => $sessionData['selectedStaff'],
            'appointments' => $appointments,  
            'calendarData' => $calendarData,     
            ]);

    }
    public function reserved(Request $request, CalendarService $calendarService){
        
        $calendarData = $calendarService->getReservedData($request);

        return view('admin.menu.calendar',[
            'calendarData' => $calendarData,
            
        ]);
    }

}
