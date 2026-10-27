<x-admin.layout>
    <x-slot:title>施術新規作成</x-slot:title>

    <form action="{{route('admin.menu.create.store')}}" method="post">
        @csrf
        <div class="menu_create">
            <div>
                <label>施術名</label>
                <input type="text" name="name" value="{{old('name')}}">
            </div>
            <div>
                <label>所要時間 <span class="caution">*30分単位で入力してください</span></label>
                <input type="text" name="duration_minutes" value="{{old('validated')}}">
            </div>
                 <div>
                <label>料金 </label>
                <input type="text" name="price" value="{{old('price')}}">
            </div>
            <button type="submit">作成する</button>

        


        </div>
    </form>

</x-admin.layout>