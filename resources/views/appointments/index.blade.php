<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js'])   
    <title>予約確認</title>
</head>
<body>
<div class="container">
    <div class="main">        
        <h1>選ばれているメニュー↓</h1>
        @if(session('selected.service_ids'))
            @foreach($selectedServices as $service)
        <div class="menu-container">        

        <div>
            <span>メニュー：{{$service->name}}</span><br>
            <span>所要時間：{{$service->formatted_duration}}</span><br>
            <span>料金：{{$service->formatted_price}}</span>
        </div>
            @endforeach
        @else
            <p>メニューが選ばれていません</p>
        @endif
        
        <h1>選ばれているスタイリスト↓</h1>
        @if(session('selected.staff_id'))
        <div class="staff-container">        
        
            <div>
                <span>{{$selectedStaff->name}}</span>
                <span>コメント：{{$selectedStaff->description}}</span>
            </div>
        @else
        <p>スタイリストが未選択です</p>
        @endif
        </div>
    
        <div class="navigation">
            <a href="?date={{ $prevWeek }}">◀ 前の週</a>
            <span>{{ $days[0]->format('Y年m月') }}</span>
            <a href="?date={{ $nextWeek }}">次の週 ▶</a>
        </div>
    <table>
        <thead>
            <tr>
                <th>時間</th>
                @foreach($days as $day)   
                 <th>
                        {{ $day->format('m/d')}}<br>
                        {{ $day->isoFormat('dd')}}
                 </th>
                @endforeach
                
            </tr>
        </thead>
        <tbody>
            @foreach($timeLists as $timeList)
                <tr>
                    <td>{{ $timeList }}</td>
                        @foreach($days as $day)
                        <td>
                            
                            @php
                            $slotStart = \Carbon\Carbon::parse($day->format('Y-m-d') .' '. $timeList);
                            $slotEnd = $slotStart->copy()->addMinutes(30);
                            @endphp

                            @if($appointments->contains(fn($appointment) => 
                            $slotStart->lt($appointment->end_at)&&
                            $slotEnd->gt($appointment->start_at)
                            ))
                                <span>×</span>
                            @else
                                @if(session('selected.service_ids'))
                                <form action="{{route('appointments.index.session')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="date" value="{{$day->format('Y-m-d')}}">
                                    <input type="hidden" name="time" value="{{$timeList}}">
                                    <div class="tooltip-container">
                                    <button type="submit">〇</button>
                                    <span class="tooltip-text">{{$day->isoFormat('YYYY年MM月DD日')}}<br>開始:{{$timeList}}</span>
                                    </div>
                                </form>
                                
                                @else
                                <div class="tooltip-container">
                                    <span class="available-mark">〇</span>
                                    <span class="tooltip-text">{{ $day->isoFormat('YYYY年MM月DD日') }}<br>開始:{{ $timeList }}</span>
                                    </div>
                                    
                                @endif
                        </td>
                                
                            @endif

                        @endforeach    
                </tr>
            @endforeach
               
            </tbody>

        </table>
        <a href="{{route('menu.staff.index')}}" class="backStaff">戻る</a>
        <a href="{{route('menu.services.index')}}" class="startReserve">メニュー選択画面へ</a>
    </div>

</div>    
</body>
</html>
