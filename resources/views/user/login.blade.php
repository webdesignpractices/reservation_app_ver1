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
        <form action="{{route('user.store')}}" method="post">  
            @csrf   
            <h1>新規登録</h1>
            <div>
                <label>お名前</label>
                <input type="text" name="name">
            </div>
            <div>
                <label>メールアドレス</label>
                <input type="email" name="email">
            </div>   
            <div>
                <label>パスワード</label>
                <input type="password" name="password">
            </div>            
            <div>
                <label>パスワード(確認用)</label>
                <input type="password" name="password_confirmation">
            </div>        
            <button type="submit">ログイン</button>
        </form>
    </div>  
</div>
</body>
</html>