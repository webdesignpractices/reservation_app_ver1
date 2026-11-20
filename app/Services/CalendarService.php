<?php
namespace App\Services;

use Illuminate\Support\Facades\Session;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\StaffController;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\StoreDatetimeRequest;
use App\Http\Controllers\Admin\AdminCalendarController;



class CalendarService {
    public function getCalendarSkeleton(){
        $isAdmin = auth('admin')->check() && auth('admin')->user()->is_admin;

        $dateInput = request()->query('date');
        try{
            $requestedDate = $dateInput ? Carbon::parse($dateInput) : today();
        }catch(\Exception $e){
            $requestedDate = today();
        }
        
        //一般ユーザーが今日より過去を指定した場合は「今日」に強制補正
        if(!$isAdmin && $requestedDate->lt(today())){
            $baseDate = today();
        }else{
            $baseDate = $requestedDate;
        }

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
        
        $prevWeekDate = $startDate->copy()->subWeek();

        //一般ユーザーの場合、前週の開始日が「今日の属する週の開始日」より前になるなら、前週リンクを無効化
        $currentWeekStart = today()->startOfWeek(Carbon::MONDAY);
        if(!$isAdmin && $prevWeekDate->lt($currentWeekStart)){
            $prevWeek = null;
        }else{
            $prevWeek = $prevWeekDate->format('Y-m-d');
        }

        $nextWeekDate = $startDate->copy()->addWeek();
        $maxaLimitDate = today()->addMonths(2);
        if(!$isAdmin && $nextWeekDate->gt($maxaLimitDate)){
            $nextWeek = null;
        }else{
            $nextWeek = $nextWeekDate->format('Y-m-d');
        }

        return [
                'timeLists' => $timeLists,
                'days' => $days,
                'prevWeek' => $prevWeek,
                'nextWeek' => $nextWeek,
                'startDate' => $startDate,
                'isAdmin' => $isAdmin,
                
        ];
    }

    public function getConditionsFromSession(){
        $selectedServiceIds = session('selected.service_ids',[]);
        $selectedServices = Service::whereIn('id',$selectedServiceIds)->get();

        $selectedStaffId = session('selected.staff_id');
        $selectedStaff = $selectedStaffId ? Staff::find($selectedStaffId) : null;

        return [
                'selectedServices' => $selectedServices,
                'selectedStaff' => $selectedStaff,
                'selectedStaffId' => $selectedStaffId,
        ];
    }

    public function getReservedData($isAdmin,$staffId = null){

            $skeleton = $this->getCalendarSkeleton(); 
            $days = $skeleton['days'];
            $timeLists = $skeleton['timeLists'];
            $appointments = $this->getAppointments($days[0] ?? Carbon::today(),$staffId) ?? collect();

            return $this->buildSingleStaffCalendarData($days, $timeLists, $appointments, $staffId);
    }

    public function buildSingleStaffCalendarData(array $days, array $timeLists,Collection $appointments, ?int $staffId = null) :array{
        
        $calendarData = [];
        foreach($days as $day){
            foreach($timeLists as $timeList){
                $datekey = $day->format('Y-m-d');
                $slotStart = Carbon::parse($datekey .' '. $timeList);
                $slotEnd = $slotStart->copy()->addMinutes(30);
                $existingAppointment = $appointments->first(function($appointment) use ($slotStart, $slotEnd, $staffId){

                    $isStaffMatched = is_null($staffId) || $appointment->staff_id == $staffId;
                    return $isStaffMatched 
                    && $appointment->status !== 'cancelled'
                    && $slotStart->lt($appointment->end_at)
                    && $slotEnd->gt($appointment->start_at);
                
                    });
            


                if($existingAppointment){
                    $status = '✕';
                    $isAvalable = false;
                }elseif($slotStart->isPast()){
                    $status = '過去';
                    $isAvalable = false;
                }else{
                    $status = '〇';
                    $isAvalable = true;
                }

                

                $calendarData[$datekey][$timeList] = [
                    'slotStart' => $slotStart,
                    'slotEnd' => $slotEnd,
                    'status' => $status,
                    'isAvalable' => $isAvalable,
                    'appointment' => $existingAppointment,
                ];
            }
        }
        return $calendarData;
        
    }

    public function getAppointments($startDate, $selectedStaffId = null){

        if (!$startDate instanceof Carbon) {
            $startDate = Carbon::parse($startDate);
        }

        
        return $appointments = Appointment::query()
        ->when($selectedStaffId,fn($query,$staffId) => 
            $query->where('staff_id',$staffId)
        )

        ->whereBetween('start_at',[
            $startDate->copy()->startOfDay(),
            $startDate->copy()->endOfWeek(Carbon::SUNDAY)->endOfDay(),
        ])

        ->get() ?? collect();

    }
}