<x-admin.layout>
    <x-slot:title>管理者用予約作成</x-slot:title>
    <form action="#" method="post">
        @csrf
    <div>
        <h1>メニューを選択</h1>
        @foreach($services as $service)
        <div  class="menu-container">
            <input type="checkbox" name="service_ids[]" value="{{$service->id}}" id="service_{{$service->id}}"
            {{in_array($service->id,old('service_ids',session('selected.service_ids', []))) ? 'checked' : ''}}>
            <label for="service_{{$service->id}}">
            <div>
                <p>メニュー：<span>{{$service->name}}</span></p>
                
                <p>所要時間：<span>{{$service->formatted_duration}}</span></p>
                
                <p>料金:<span>{{$service->formatted_price}}</span></p>
                
            </div>
            </label>
        </div>
        @endforeach
            <div>
                <h1>スタイリストを選択</h1>
            @foreach($staff_s as $staff)
                <div class="staff_container">
                    <input type="radio" name="staff_id" value="{{$staff->id}}" id="staff_{{$staff->id}}" 
                    {{session('selected.staff_id') == $staff->id ? 'checked' :''}}>
                    <label for="staff_{{$staff->id}}">
                        <span>スタイリスト名：</span>
                        <span>{{$staff->name}}</span><br>
                        <span>コメント：</span>
                        <span>{{$staff->description}}</span>
                </div>        
            @endforeach
            </div>
            <div>
                <h1>顧客情報</h1>
                <select name="customer_type" id="customer_type">
                    <option value="member">既存会員から選ぶ</option>
                    <option value="guest">ゲスト（非会員・電話）</option>
                </select>
                
                <div id="member_select_box">
                    <h1>会員名</h1>
                    <select name="user_id">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                    </select>
                </div>
                <div id="guest_input_box">
                    <label>ゲストお名前</label>
                    <input type="text" name="guest_name">
                    <label>ゲスト電話番号</label>
                    <input type="text" name="guest_tel">
                </div>   
            </div>
            <div class="next_button">
                <button type="submit">予約内容を確認する</button>
            </div>
    </div>
    </form>
</x-admin.layout>