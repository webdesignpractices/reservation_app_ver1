<x-admin.layout>
    <x-slot:title>施術新規作成</x-slot:title>

    <form action="#"{{--"{{route('admin.menu.create.store')}}" --}} method="post">
        @csrf
        <div class="menu_create">
            <div>
                <label>施術名</label>
                <input type="text" name="newMenu" value="{{old('newMenu')}}">
            </div>
            <div>
                <label>所要時間</label>
                <input type="text" name="newDuration" value="{{old('newDuration')}}">
            </div>
                 <div>
                <label>料金 <span class="caution">*30分単位で入力してください</span></label>
                <input type="text" name="newPrice" value="{{old('newPrice')}}">
            </div>
            <button type="submit">作成する</button>

        


        </div>
    </form>

</x-admin.layout>