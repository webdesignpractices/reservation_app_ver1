<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>ログイン</title>
</head>
<body>
    <div class="container">
    <div class="main"> 
        <form action="#" method="post">  
            @csrf   
            <h1>ログイン</h1>
            <div>
                <label>メールアドレス</label>
                <input type="email" name="email">
            </div>   
            <div>
                <label>パスワード</label>
                <input type="password" name="password">
            </div>            
            <button type="submit">ログイン</button>
        </form>
    </div>  
</div>
</body>
</html>