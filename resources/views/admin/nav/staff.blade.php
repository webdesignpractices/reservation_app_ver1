<x-admin.layout>
    <x-slot:title>スタッフ一覧</x-slot:title>
    <h2>スタッフ一覧</h2>
    @foreach($staff_s as $staff)
        <div  class="menu-container">
                <p>従業員No.{{$staff->staff_code}}(*変更不可)</p>
                <p>スタイリスト名：<span>{{$staff->name}}</span></p>               
                <p>{{$staff->description}}</p>
                <div>
                    <a href="{{route('admin.staff.edit',$staff)}}">編集する</a>
                </div>
        </div>

    @endforeach
        <div>
            <a href="{{route('admin.dashboard')}}">戻る</a>
        </div>
</x-admin.layout>