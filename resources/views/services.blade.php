<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Services</title>
</head>
<body>
    <div>
        @foreach($services as $service)
        
            <li><p>メニュー</p><{{$service->name}}<span>{{$service->formatted_duration}}</span><span>{{$service->formatted_price}}</span></li>
        
        @endforeach
    </div>
</body>
</html>