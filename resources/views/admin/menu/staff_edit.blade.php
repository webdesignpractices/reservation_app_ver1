<x-admin.layout>
    <x-slot:title>スタッフ編集</x-slot:title>
    <h2>スタッフ編集</h2>
    <form action="{{route('admin.staff.update',$staff)}}" method="post">
        @csrf
        @METHOD('PUT')
    <div>
        <p>スタイリスト名</p>
        <input type="text" name="update_name" value="{{($staff->name)}}">
    </div>
    <div>
        <p>コメント</p>
        <textarea name="update_comment">{{($staff->description)}}</textarea>
    </div>
    <button type="submit">更新する</button>
    </form>
</x-admin.layout>