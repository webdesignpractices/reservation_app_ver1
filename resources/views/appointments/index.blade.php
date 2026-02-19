<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">   
    <title>Document</title>
</head>
<body>

<div class="navigation">
        <a href="?date={{ $prevWeek }}">◀ 前の週</a>
        <span>{{ $days[0]->format('Y年m月') }}</span>
        <a href="?date={{ $nextWeek }}">次の週 ▶</a>
</div>
    <table>
        <thead>
            <tr>
                <th>時間</th>
                @foreach($days as $day)
                 <th>
                    {{ $day->format('m/d')}}<br>
                    {{ $day->isoFormat('dd')}}
                 </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($timeLists as $timeList)
                <tr>
                    <td>{{ $timeList }}</td>@foreach($days as $day)
                    <td>
                        <a href="#">〇</a>
                    </td>
                @endforeach    
                </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>