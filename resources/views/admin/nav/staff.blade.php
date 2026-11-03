<x-admin.layout>
    <x-slot:title>スタッフ一覧</x-slot:title>
    @foreach($staff_s as $staff)
        <div  class="menu-container">

                <p>スタイリスト名：<span>{{$staff->name}}</span></p>               
                <p>コメント：<span>{{$staff->description}}</span></p>

        </div>
    @endforeach
</x-admin.layout>