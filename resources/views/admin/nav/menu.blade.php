<x-admin.layout>
    <x-slot:title>施術一覧</x-slot:title>
            <form action="#" method="post">
        {{--@csrf
            @error('service_ids')
            <p class = 'error'>{{$message}}</p>
            @enderror--}}
        @foreach($menus as $menu)

        <div  class="menu-container">

                <p>{{$menu->name}}</p>
                <p>所要時間：<span>{{$menu->formatted_duration}}</span></p>                
                <p>料金：<span>{{$menu->formatted_price}}</span></p>
                
            <form action="#" method="post">
                @csrf
                <a href="#">編集する</a>
            </form>
            
        </div>

        @endforeach
        
        </form>
            
            <div  class="back_button">
                <a href="{{route('admin.dashboard')}}">ホームへ戻る</a>
            </div>
</x-admin.layout>