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
    <h1>Beauty Salon<h1>
                <nav>
            @auth
            <form action="{{route('user.logout')}}" method="post">
            @csrf
            <button type="submit">ログアウト</button>
            </form>
            <a href="{{route('user.mypage')}}">マイページ<a>
            @endauth

            @guest
            <a href="{{route('login')}}">ログイン</a>
            <a href="{{route('user.signup')}}">新規登録</a>
            @endguest
        </nav> 

    <a href="{{route('menu.services.index')}}" class="nextService">メニュー選択へ</a>

    </div>  
</div>
</body>      