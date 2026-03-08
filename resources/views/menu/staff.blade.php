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
    <form action="{{route('menu.staff.session')}}" method="post">
        @csrf  
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
        </div>
        @endforeach
        <button type="submit">このスタイリストで決定する</button>
    </form>
    <a href="{{route('appointments.index',[$service,$staff])}}">日時選択へ</a>

    </div>  
</div>
</body>
</html>