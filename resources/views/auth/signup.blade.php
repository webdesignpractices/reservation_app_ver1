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
        <form action="{{route('auth.signup')}}" method="post">  
            @csrf   
            <h1>新規登録</h1>
            <input type="text" name="name">
            <input type="text" name="email">
            <input type="password" name="password">
        </form>
    </div>  
</div>
</body>
</html>