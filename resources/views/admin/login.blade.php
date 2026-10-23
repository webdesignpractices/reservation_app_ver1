<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js'])  
    <title>Admin_Login</title>
</head>

<x-admin.header />

<body>
    <div class="container">
    <div class="main"> 
        <form action="{{route('user.login.act')}}" method="post">  
            @csrf   
            @if(session('login_message'))   
            <p class = "preloginerror">{{session('login_message')}}</p>   
            @endif
            <h1>管理者用ログイン画面</h1>
            @error('login_error')
             <p class="error">{{$message}}</p>
            @enderror 
            <div>
                <label>メールアドレス</label>
                <input type="email" name="email" value="{{old('email')}}">
            </div>   
            <div>
                <label>パスワード</label>
                <input type="password" name="password">
            </div>            
            <button type="submit">ログインする</button>
        </form>
    </div>  
</body>
</html>