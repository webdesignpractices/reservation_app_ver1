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
    @foreach($services as $service)
    <div  class="menu-container">
        
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
        <a href="{{route('menu.staff.index',$service)}}">スタッフ選択画面へ</a>
    </div>
    @endforeach
    </div>  
</div>
</body>
</html>