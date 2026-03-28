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
            @foreach($selectedServices as $service)

            <div>
                <span>メニュー：{{$service->name}}</span><br>
                <span>所要時間：{{$service->formatted_duration}}</span><br>
                <span>料金：{{$service->formatted_price}}</span>
            </div>
            @endforeach
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
        <button type="submit" name="direction" value="next">日時選択へ</button>
        <button type="submit" name="direction" value="back">戻る</button>
        </form>
        
    </div>  
</div>
</body>
</html>