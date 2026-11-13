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

                            $slotDateTime = \Carbon\Carbon::parse($day->format('Y-m-d') . ' ' . $timeList);
                            $isPast = $slotDateTime->isPast();

                            $matchedAppointment = $appointments->first(function ($appointment) use ($slotDateTime) {
                
                            return $slotDateTime->gte($appointment->start_at) 
                            && $slotDateTime->lt($appointment->end_at);
                        });

                        @endphp
                    <td>
                        @if($isPast)
                        <div>
                            <span>受付終了</span>
                        </div>
                        @elseif($matchedAppointment)
                        <div>
                            <div class="tooltip-container">
                                    <a href="#">✕</a>
                                    <span class="tooltip-text">顧客：{{ $matchedAppointment->user->name ?? ' '}}様
                                        @foreach($matchedAppointment->services ?? [] as $service)                                            
                                        <br>{{ $service->name ?? ' '}}{{ $loop->last ? '' : ' , '}}
                                        <br>{{ $service->formatted_duration ?? ' ' }}
                                        @endforeach
                                        
                                        <br>{{ $matchedAppointment->start_at->format('H:i')}} ～ {{ $matchedAppointment->end_at->format('H:i') ?? ' ' }}
                                        <br>{{ $matchedAppointment->staff->name ?? ' ' }}</span>
                                        
                            </div>
                     
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