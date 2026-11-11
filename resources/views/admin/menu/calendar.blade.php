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
                        @foreach($appointments as $appointment)
                        @php
                            $slot = $calendarData[$day->format('Y-m-d')][$timeList] ?? [];
                            $isPast = $slot['isPast'] ?? false;
                            $isBooked = $slot['isBooked'] ?? false;
                        @endphp
                    <td>
                        @if($isPast)
                        <div>
                            <span>受付終了</span>
                        </div>
                        @elseif($isBooked)
                        <div>
                            <div class="tooltip-container">
                                    <a href="#">✕</a>
                                    <span class="tooltip-text">顧客：{{ $appointment->user->name }}様
                                        @foreach($appointment->services as $service)                                            
                                        <br>{{ $service->name}}{{ $loop->last ? '' : ' , '}}
                                        <br>{{ $service->formatted_duration }}
                                        @endforeach
                                        <br>{{ $appointment->start_at->format('H:i')}} ～ {{ $appointment->end_at->format('H:i') }}
                                        <br>{{ $appointment->staff->name }}</span>
                            </div>
                     
                        </div>
                        @else
                        <div>   
                                <a href="#">〇</a>
                        </div>
                        @endif
                    </td>
                        @endforeach
                    @endforeach    
                </tr>
                @endforeach    
            </tbody>
    </table>
</x-admin.layout>