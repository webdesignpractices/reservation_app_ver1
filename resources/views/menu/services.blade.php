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
        
    <form action="{{route('menu.services.session')}}" method="post">
        @csrf
        @error('service_error')
        <p class = 'error'>{{$message}}</p>
        @enderror
    @foreach($services as $service)

    <div  class="menu-container">
        <input type="checkbox" name="service_ids[]" value="{{$service->id}}" id="service_{{$service->id}}"
        {{in_array($service->id,old('service_ids',session('selected.service_ids', []))) ? 'checked' : ''}}>
        <label for="service_{{$service->id}}">
        <div>
            <span>メニュー</span>
            <span>{{$service->name}}</span>
            <span>所要時間</span>
            <span>{{$service->formatted_duration}}</span>
            <span>料金</span>
            <span>{{$service->formatted_price}}</span>
        </div>
        </label>
    </div>
    @endforeach
    <button type="submit">メニューを決定する</button>
    </form>
        <a href="{{route('home')}}" class="backHome">ホームへ戻る</a>
        <a href="{{route('menu.staff.index')}}" class="nextStaff">スタイリストを見る</a>
    </div>  
</div>
</body>
</html>