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
            <li class = reserved>
                
                @foreach($appointment->services as $service)
                <div>
                    <span>メニュー：{{$service->name}}</span><br>
                    <span>所要時間：{{$service->formatted_duration}}</span><br>
                    <span>料金：{{$service->formatted_price}}</span>
                </div>
                @endforeach

                
                <div>   
                    <span>スタイリスト：{{$appointment->staff->name}}</span>
                </div>
                <h2>予約時間</h2>
                <div>
                    <span>{{$appointment->start_at->isoFormat('YYYY年MM月DD日')}}
                        {{$appointment->start_at->format('H:i')}}～{{$appointment->end_at->format('H:i')}}（終了予定）
                    </span>
                </div>
                <div>
                    <form action="{{route('appointments.cancel', $appointment)}}" method="post">
                        @csrf
                        @method('DELETE')
                    <button type = "submit">この予約をキャンセルする</button>
                </form>
                </div>
            </li>
             @empty
             <li>
             <p>予約がありません<p>
            </li>   
             @endforelse      
        </ul>

    </div>  
</div>
</body>
</html>