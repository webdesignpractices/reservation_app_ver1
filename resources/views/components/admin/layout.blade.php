<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js']) 
    <title>{{$title ?? 'トップページ'}}</title>
</head>
    <header class = "header">
        <div class="logo">
            <a href="{{route('admin.dashboard')}}">Hair Salon</a>
        </div>
        <nav class="nav">
            <ul>
                @auth('admin')
                <li>
                <form action="{{route('admin.logout')}}" method="post">
                @csrf
                <button type="submit">ログアウト</button>
                </form>
                </li>
                @endauth

                @guest('admin')
                <li><a href="{{route('admin.login')}}">ログイン</a></li>
                
                @endguest
            </ul>
        </nav> 
    </header>
<body>
    

    <div class="container">
        <div class="main">
            {{$slot}}
        </div>
</div>
</body>
</html>