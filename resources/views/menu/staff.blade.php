<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Services</title>
</head>
<body>
    <div class="container">
    <div class="main">
        <h1>選ばれているメニュー↓</h1>
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
         
    @foreach($staff_s as $staff)
    <div  class="menu-container">
        
        <div>
            <span>スタイリスト名</span>
            <span>コメント</span>
        </div> 
        
        <div>
            <span>{{$staff->name}}</span>
            <span>{{$staff->description}}</span>
        </div>
        <a href="{{route('appointments.index',[$service,$staff])}}">このスタイリストで予約する</a>
    </div>
    @endforeach
    </div>  
</div>
</body>
</html>