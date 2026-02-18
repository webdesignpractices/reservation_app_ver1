<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">   
    <title>Document</title>
</head>
<body>
    @foreach($timeLists as $timeList)
    <div class="time-slot" style="margin-bottom: 10px;">
        <span>{{ $timeList }}</span>
        <button>予約する</button>
    </div>    
    @endforeach
</body>
</html>