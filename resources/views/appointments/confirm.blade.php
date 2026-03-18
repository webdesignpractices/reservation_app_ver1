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
        @foreach($selectedServices as $service)

        
        <div>
            <span>メニュー：{{$service->name}}</span><br>
            <span>所要時間：{{$service->formatted_duration}}</span><br>
            <span>料金：{{$service->formatted_price}}</span>
        </div>
        @endforeach
                <h1>選ばれているスタイリスト↓</h1>   
            <span>{{$selectedStaff->name}}</span>
        </div>
        <h1>予約時間</h1>
        <div>
            <span>{{$date}}、{{$startTime}}～{{$endTime}}</span>
        </div>
    </div>
</div>    
</body>
</html>