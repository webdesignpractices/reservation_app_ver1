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
            <input type="radio" name="staff_id" value="{{$staff->id}}" id="staff_{{$staff->id}}">
            <label for="staff_{{$staff->id}}">
                <span>スタイリスト名：</span>
                <span>{{$staff->name}}</span><br>
                <span>コメント：</span>
                <span>{{$staff->description}}</span>
            </div>

        </div>
        @endforeach
        <button type="submit">日時選択へ</button>
    </form>
    <!--<a href="{{route('appointments.index')}}"></a>-->

    </div>  
</div>
</body>
</html>