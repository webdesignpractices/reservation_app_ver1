<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js'])   
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="main">
        <h1>選ばれているメニュー↓</h1>
            <div>
                <span>メニュー</span>
                <span>所要時間</span>
                <span>料金</span>
            </div> 
        
        <div>
            <span>{{$service->name}}</span>
            <span>{{$service->formatted_duration}}</span>
            <span>{{$service->formatted_price}}</span>
        </div>
                <h1>選ばれているスタイリスト↓</h1>
            <div>
                <span>スタイリスト</span>
            </div> 
        

            <span>{{$staff->name}}</span>
        </div>
        <h1>予約時間</h1>
        <div>
            <span>{{$date}}、{{$time}}</span>
        </div>
    </div>
</div>    
</body>
</html>