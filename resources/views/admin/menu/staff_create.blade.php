<x-admin.layout>
    <x-slot:title>スタイリスト追加</x-slot:title>
    <h2>スタイリストを追加</h2>
    <form action="{{route('admin.staff.store')}}" method="post">
        @csrf
    <div>
        <p>スタッフNo.<span>(重複不可、後から変更はできません)</span></p>
        <input type="text" name="new_staff_code">
    </div>
    <div>
        <p>スタイリスト名</p>
        <input type="text" name="new_name" value="{{old('new_name')}}">
    </div>
    <div>
        <p>コメント</p>
        <textarea name="new_description">{{old('new_description')}}</textarea>
    </div>
    <button type="submit">作成する</button>
    </form>
    <a href="{{route('admin.staff.index')}}">戻る</a>
</x-admin.layout>