<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>マイページ</title>
</head>
<div class="container">
    <div class="main"> 
        <h1>↓予約一覧↓</h1>
        <ul>
            @forelse($user->appointments as $appointment)
            <li><li>
                            <span>メニュー：{{}}</span><br>
            <span>所要時間：{{$service->formatted_duration}}</span><br>
            <span>料金：{{$service->formatted_price}}</span>
        </div>

                <h1>選ばれているスタイリスト↓</h1>   
            <span>{{$selectedStaff->name}}</span>
        </div>
        <h1>予約時間</h1>
        <div>
            <span>{{$appointment->start_at->isoFormat('YYYY年MM月DD日')}}　{{$startTime}}～{{$endTime}}（終了予定）</span>
        </div>
        </ul>

    </div>  
</div>
</body>
</html>