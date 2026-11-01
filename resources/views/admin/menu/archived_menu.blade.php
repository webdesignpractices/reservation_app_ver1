<x-admin.layout>
    <x-slot:title>非表示にしたメニュー</x-slot:title>
    <div class="archivedMenus">                
            <h2>非表示のメニュー</h2>
            
            @forelse($archivedMenus ?? [] as $archivedMenu)   
            <div class="archivedMenu_container">
                <p>{{$archivedMenu->name}}</p>
                <p>所要時間：<span>{{$archivedMenu->formatted_duration}}</span></p>                
                <p>料金：<span>{{$archivedMenu->formatted_price}}</span></p>
            <form action="{{route('admin.menu.unarchive' ,$archivedMenu)}}" method='post'>
                @csrf
                <button type="submit">非表示を解除する</button>
            </div>                                       
                @empty
                <p>非表示のメニューはありません</p>
            @endforelse
    </div>
    <div>
        <a href="{{route('admin.nav.menus.index')}}">戻る</a>
    </div>
</x-admin.layout>