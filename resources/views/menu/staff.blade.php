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
            @if(session('selected.service_ids'))
            @foreach($selectedServices as $service)

            <div>
                <span>メニュー：{{$service->name}}</span><br>
                <span>所要時間：{{$service->formatted_duration}}</span><br>
                <span>料金：{{$service->formatted_price}}</span>
            </div>
            @endforeach
            @else
            <p>メニューが未選択です</p>
            @endif
        <form action="{{route('menu.staff.session')}}" method="post">
        @csrf  
        @foreach($staff_s as $staff)
        <div  class="menu-container">
            <input type="radio" name="staff_id" value="{{$staff->id}}" id="staff_{{$staff->id}}" 
             {{session('selected.staff_id') == $staff->id ? 'checked' :''}}>
            <label for="staff_{{$staff->id}}">
                <span>スタイリスト名：</span>
                <span>{{$staff->name}}</span><br>
                <span>コメント：</span>
                <span>{{$staff->description}}</span>
            </div>

        </div>
        @endforeach
        <button type="submit">スタイリストを決定して日時を選択する</button>       
        </form>
        <a href="{{route('menu.services.index')}}" class="backService">戻る</a>
        <a href="{{route('appointments.index')}}" class="showDate">空き日時を見る</a>
    </div>  
</div>
</body>
</html>