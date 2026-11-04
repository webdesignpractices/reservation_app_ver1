<x-admin.layout>
    <x-slot:title>スタッフ一覧</x-slot:title>
    <h2>スタイリスト一覧</h2>
    <div>
        <a href="{{route('admin.staff.create')}}" >スタッフを追加する</a>
    </div>
    @foreach($staff_s as $staff)
        <div  class="menu-container">
                <p>スタッフNo.{{$staff->staff_code}}(*変更不可)</p>
                <p>スタイリスト名：<span>{{$staff->name}}</span></p>               
                <p>{{$staff->description}}</p>
                <div>
                    <a href="{{route('admin.staff.edit',$staff->id)}}">編集する</a>
                </div>
                <form action="{{route('admin.staff.updateStatus', $staff->id)}}" method="post">
                    @csrf
                    @METHOD('PATCH')
                    <select name="status" onchange="this.form.submit()" value="ステータスを変更する">
                        
                        <option value="active" {{$staff->status === App\Enums\StaffStatus::Active ? : ''}}>在籍中</option>
                        <option value="leave" {{$staff->status === App\Enums\StaffStatus::Leave ? : ''}}>休職中</option>
                        <option value="retired" {{$staff->status === App\Enums\StaffStatus::Retired ? : ''}}>退職</option>

                    </select>
                </form>
        </div>

    @endforeach
        <div>
            <a href="{{route('admin.dashboard')}}">戻る</a>
        </div>
</x-admin.layout>