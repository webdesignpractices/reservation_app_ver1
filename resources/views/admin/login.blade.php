<x-admin.layout>
        <form action="{{route('admin.login.post')}}" method="post">  
            @csrf   
            @if(session('login_message'))   
            <p class = "preloginerror">{{session('login_message')}}</p>   
            @endif
            <h1>管理者用ログイン画面</h1>
            @error('login_error')
             <p class="error">{{$message}}</p>
            @enderror 
            <div>
                <label>社員番号</label>
                <input type="text" name="staff_code" value="{{old('staff_code')}}">
            </div>   
            <div>
                <label>パスワード</label>
                <input type="password" name="password">
            </div>            
            <button type="submit">ログインする</button>
</x-admin.layout>