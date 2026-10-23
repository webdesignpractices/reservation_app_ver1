<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js']) 
    <title>{{$title}}</title>
</head>
<body>
    

    <div class="container">
        <div class="main">
            {{$slot}}
        </div>
</div>
</body>
</html>