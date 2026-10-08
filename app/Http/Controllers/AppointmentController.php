<?php

namespace App\Http\Controllers;

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Session;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Http\Controllers\Auth;



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
        $selectedStaff = $selectedStaffId ? Staff::find($selectedStaffId) : null;

        $appointments = Appointment::query()
        ->when($selectedStaffId,fn($query,$staffId) => 
            $query->where('staff_id',$staffId)
        )

        ->whereBetween('start_at',[
            $startDate->copy()->startOfDay(),
            $startDate->copy()->addDays(7)->endOfDay(),
        ])
        ->get();
        
        


        return view('appointments.index',['timeLists' => $timeLists,
                'days' => $days,
                'prevWeek' => $prevWeek,
                'nextWeek' => $nextWeek,
                'selectedServices' => $selectedServices,
                'selectedStaff' => $selectedStaff,
                'appointments' => $appointments,
                ]);
    }
    public function confirm(Request $request){
        $selectedServiceIds = session('selected.service_ids',[]);
        $selectedServices = Service::whereIn('id',$selectedServiceIds)->get();

        $selectedStaffId = session('selected.staff_id');
        $selectedStaff = Staff::findOrFail($selectedStaffId);

        $selectedDate = session('selected.date_time.date');//"2026-02-25"
        $date = Carbon::parse($selectedDate);
        $selectedTime = session('selected.date_time.time');//"11:00"

        $startTime = Carbon::parse($selectedDate.''.$selectedTime);
        $totalDuration = $selectedServices->sum('duration_minutes');
        $endTime = $startTime->copy()->addMinutes($totalDuration);
        
        return view('appointments.confirm',[
            'selectedServices' => $selectedServices,
            'selectedStaff' => $selectedStaff,
            'date' => $date,
            'startTime' => $startTime->format('H:i'),
            'endTime' => $endTime->format('H:i'),
        ]);

    }

    public function postServise(Request $request){

    $menuIds = $request->input('service_ids', []);
        if(empty($menuIds)){
            return back()
            ->withErrors(['service_error' => 'メニューを選択してください'])
            ->withInput();
        }
        
        $validated = $request->validate(['service_ids' => 'required']);
        session(['selected.service_ids' => $validated['service_ids']]);
        //dd(session('selected.service_ids'));
        return redirect()->route('menu.staff.index');

    }
    public function postStaff(Request $request){
        $validated = $request->validate(['staff_id' => 'required']);
        session(['selected.staff_id' => $validated['staff_id']]);
        
        if($request->direction === 'back'){
            return redirect()->route('menu.services.index');
        }
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
        $selectedServiceIds = session('selected.service_ids');
        $selectedServices = Service::whereIn('id',$selectedServiceIds)->get();

        $staffid = session('selected.staff_id');
        $dateTime = session('selected.date_time');//中身["date" => "2026-04-04","time" => "15:00"]

        $startTime = Carbon::parse($dateTime['date'].''.$dateTime['time']);
        $totalDuration = $selectedServices->sum('duration_minutes');
        $endTime = $startTime->copy()->addMinutes($totalDuration);

        try {
            $apppointment = DB::transaction(function () use ($staffId, $startTime, $endTime, $selectedServices){
                //同一スタッフの同じ時間帯に重複する予約がないか確認（排他確認）
                $hasOrverlap = Appointment::where('staff_id',$staffId)
                ->where('status', '!=', 'cancelled')//キャンセル済みを除外する場合
                ->where(function ($query) use ($startTime,$endTime){
                    //時間帯の重複条件:既存の予約の（開始＜今回の終了）AND　（終了＞今回の開始）
                    $query->where('start_at','<' ,$endTime)
                        ->where('end_at', '>' ,$startTime);
                })
                ->lockForUpdate()//☆ここポイント：他処理からの同時割り込みをブロックする
                ->exists();
            //重複がある場合はロールバックさせる
            if ($hasOrverlap){
                throw new \Exception('指定された時間帯はすでに他の予約が入っています')
            }
            //予約の作成
            $newAppointment = Appointment::create([
                'user_id'    => auth()->id(),    // ログイン中のユーザーID
                'staff_id'   => $staffid,      // 選んだスタッフID
                'start_at'   => $startTime,     // 予約開始
                'end_at'     => $endTime,       // 予約終了
                'status'     => 'confirmed',    // デフォルト値があるけど明示してもOK
            ]);

            //中間テーブルの結合
            $newAppointment->services()->attach($selectedServices);
                return $newAppointment;
            });

            //成功した場合のセッションクリア
            session()->forget('selected');
            return redirect()->route('user.mypage');
        } catch (\Exception $e) {
            //重複があった場合、または処理中にエラーがあった場合
            return redirect()->back()->with('error',$e->getMessege());
        }

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

        $appointment->delete();

        return redirect()->route('user.mypage');
    }
    
}
