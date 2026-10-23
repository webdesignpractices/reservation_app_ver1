<header class = "header">
        <div class="logo">
            <a href="{{route('admin.dashboard')}}">Hair Salon</a>
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
                
                <li><a href="{{route('admin.login')}}">ログイン</a></li>
                @endguest
            </ul>
        </nav> 
    </header>