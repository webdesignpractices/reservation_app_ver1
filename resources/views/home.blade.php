<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>TOP</title>
</head>
<body>
    
    <header class = "header">
        <div class="logo">
            <a href="{{route('home')}}">Beauty Salon</a>
        </div>
        <nav class="nav">
            <ul>
                @auth
                <li>
                <form action="{{route('user.logout')}}" method="post">
                @csrf
                <button type="submit">ログアウト</button>
                </form>
                </li>
                <li><a href="{{route('user.mypage')}}">マイページ</a></li>
                @endauth

                @guest
                <li><a href="{{route('login')}}">ログイン</a></li>
                <li><a href="{{route('user.signup')}}">新規登録</a></li>
                @endguest
            </ul>
        </nav> 
    </header>
        <div class="container">
        <div class="main">
        <a href="{{route('menu.services.index')}}" class="nextService">メニュー選択へ</a>

    </div>  
</div>
</body>      