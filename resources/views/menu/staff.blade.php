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
        <a href="{{route('appointments.index',$staff)}}">予約日時選択画面へ</a>
    </div>
    @endforeach
    </div>  
</div>
</body>
</html>