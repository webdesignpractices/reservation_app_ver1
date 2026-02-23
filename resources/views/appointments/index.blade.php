<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js'])   
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="main">
        <h1>選ばれているメニュー↓</h1>
        <div class="menu-container">        
            <div>
                <span>メニュー</span>
                <span>所要時間</span>
                <span>料金</span>
            </div> 
        
        <div>
            <span>{{$service->name}}</span>
            <span>{{$service->formatted_duration}}</span>
            <span>{{$service->formatted_price}}</span>
        </div>
                <h1>選ばれているスタイリスト↓</h1>
        <div class="menu-container">        
            <div>
                <span>スタイリスト</span>
                <span>コメント</span>
            </div> 
        
        <div>
            <span>{{$staff->name}}</span>
            <span>{{$staff->description}}</span>
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
                                <a href="#">〇</a>
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