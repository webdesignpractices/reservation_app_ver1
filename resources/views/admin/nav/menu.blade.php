<x-admin.layout>
    <x-slot:title>施術一覧</x-slot:title>
            <a href="{{route('admin.menu.create')}}">施術メニューを新規作成する</a>
        
            @error('service_ids')
            <p class = 'error'>{{$message}}</p>
            @enderror
        @foreach($menus as $menu)

        <div  class="menu-container">

                <p>{{$menu->name}}</p>
                <p>所要時間：<span>{{$menu->formatted_duration}}</span></p>                
                <p>料金：<span>{{$menu->formatted_price}}</span></p>
                
            <form action="#" method="post">
                @csrf
                <a href="#">非表示にする</a>
            </form>
            
        </div>

        @endforeach
        <div>
            <a href="{{route('admin.archived.menu')}}">非表示にしたメニューを見る</a>
        </div>
        </form>
            
            <div  class="back_button">
                <a href="{{route('admin.dashboard')}}">ホームへ戻る</a>
            </div>
</x-admin.layout>