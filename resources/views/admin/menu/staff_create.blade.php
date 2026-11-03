<x-admin.layout>
    <x-slot:title>スタイリスト追加</x-slot:title>
    <h2>スタイリストを追加</h2>
    <form action="#" method="post">
        @csrf
    <div>
        <p>スタッフNo.<span>(重複不可、後から変更はできません)</span></p>
        <input type="text" name="new_staff_code">
    </div>
    <div>
        <p>スタイリスト名</p>
        <input type="text" name="new_staff" value="{{old('new_staff')}}">
    </div>
    <div>
        <p>コメント</p>
        <textarea name="new_description">{{old('new_description')}}</textarea>
    </div>
    </form>
</x-admin.layout>