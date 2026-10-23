<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css','resources/js/app.js']) 
    <title>Document</title>
</head>
<body>
    <x-admin.header />

    <div class="container">
        <div class="main">
            <div class="nav_menus">
                <ul>
                    <li><a href="">施術一覧(メニュー)</a></li>
                    <li><a href="">スタイリスト一覧</a></li>
                    <li><a href="">予約カレンダー</a></li>
                </ul>
            </div> 
        </div>
    </div>
</body>
</html>