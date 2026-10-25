<x-admin.layout>
    <x-slot:title>施術新規作成</x-slot:title>

    <form action="{{route('admin.menu.create.store')}}" method="post">
        @csrf
        <div class="menu_create">

        


        </div>
    </form>

</x-admin.layout>