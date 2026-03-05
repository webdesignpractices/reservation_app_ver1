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
        <nav>
            @auth
            <form action="{{route('user.logout')}}" method="post">
            @csrf
            <button type="submit">ログアウト</button>
            </form>
            @endauth

            @guest
            <a href="{{route('user.login.index')}}">ログイン</a>
            <a href="{{route('user.signup')}}">新規登録</a>
            @endguest
        </nav>         
    <form action="{{route('menu.services.session')}}" method="post">
        @csrf
    @foreach($services as $service)
    <div  class="menu-container">
        <input type="checkbox" name="service_ids[]" value="{{$service}}" id="service_{{$service}}">
        <label for="service_{{$service}}">
        <div>
            <span>メニュー</span>
            <span>{{$service->name}}</span>
            <span>所要時間</span>
            <span>{{$service->formatted_duration}}</span>
            <span>料金</span>
            <span>{{$service->formatted_price}}</span>
        </div>
        </label>
    </div>
    @endforeach
    </form>
        <a href="{{route('menu.staff.index',$service)}}">スタイリスト選択へ</a>

    </div>  
</div>
</body>
</html>