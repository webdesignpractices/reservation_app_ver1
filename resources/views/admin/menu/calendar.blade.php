<x-admin.layout>
    <x-slot:title>予約カレンダー</x-slot:title>

    <div class = "navigation">
        <a href="?date={{$prevWeek}}">◀前の週</a>
        <a href="?date={{$nextWeek}}">次の週▶</a>
    </div>
    <table>
        <thead>
            <tr>
            <th>時間</th>
                @foreach($days as $day)
                <th>
                    {{$day->format('m/d')}}<br>
                    {{$day->isoFormat('dd')}}
                </th>
                @endforeach
            </tr>
        </thead>
            <tbody>
                @foreach($timeLists as $timeList)
                <tr>
                    <td>{{$timeList}}</td>
                    @foreach($days as $day)
                    <td>
                        <div>
                            <span>〇</span>
                        </div>
                    </td>
                    @endforeach    
                </tr>
                @endforeach    
            </tbody>
    </table>
</x-admin.layout>