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
        @foreach($selectedServices as $service)
        <div class="menu-container">        

        <div>
            <span>メニュー：{{$service->name}}</span><br>
            <span>所要時間：{{$service->formatted_duration}}</span><br>
            <span>料金：{{$service->formatted_price}}</span>
        </div>
        @endforeach
                <h1>選ばれているスタイリスト↓</h1>

        <div class="menu-container">        
        
        <div>
            <span>{{$selectedStaff->name}}</span>
            <span>コメント：{{$selectedStaff->description}}</span>
        </div>
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
                                <form action="{{route('appointments.index.session')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="date" value="{{$day->format('Y-m-d')}}">
                                    <input type="hidden" name="time" value="{{$timeList}}">
                                    <div class="tooltip-container">
                                    <button type="submit">〇</button>
                                    <span class="tooltip-text">{{$day->isoFormat('YYYY年MM月DD日')}}<br>開始:{{$timeList}}</span>
                                    </div>
                                </form>
                            </td>
                        @endforeach    
                </tr>
            @endforeach

        </tbody>
    </table>

    </div>
</div>    
</body>
</html>
