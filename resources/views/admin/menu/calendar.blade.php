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

                        @php

                            $datekey = $day->format('Y-m-d');
                            $slot = $calendarData[$datekey][$timeList] ?? null;
                            $status = $slot['status'] ?? '〇';
                            $appointment = $slot['appointment'] ?? null;


                        @endphp
                    <td>
                            @if($status === '✕' && $appointment)
                        <div>
                            <div class="tooltip-container">
                                    <a href="#">✕</a>
                                    <span class="tooltip-text">顧客：{{ $appointment->user->name ?? ' '}}様
                                        @foreach($appointment->services ?? [] as $service)                                            
                                        <br>{{ $service->name ?? ' '}}{{ $loop->last ? '' : ' , '}}
                                        <br>{{ $service->formatted_duration ?? ' ' }}
                                        @endforeach
                                        
                                        <br>{{ $appointment->start_at->format('H:i')}} ～ {{ $appointment->end_at->format('H:i') ?? ' ' }}
                                        <br>{{ $appointment->staff->name ?? ' ' }}
                                        <br>{{ $appointment->memo ?? '備考なし'}}</span>
                            </div>
                     
                        </div>
                            @elseif($status === '過去')
                                <div class="tooltip-container">
                                    <span class= "pastOrdayoff">■</span>
                                    <span class="tooltip-text">予約不可</span>
                                </div>
                            @else
                        <div>   
                                <a href="{{route('admin.create.reservation',['date' => $day->format('Y-m-d'), 'time' => $timeList])}}">〇</a>
                        </div>
                            @endif
                        
                    </td>
                    @endforeach    
                        
                </tr>
                @endforeach    
            </tbody>
    </table>
</x-admin.layout>