<html>
<body>
    <form method="POST" action="/reservation">
    @csrf
        <!-- 完了メッセージ -->
        @if (session('result'))
            <div style="color:green;">
                {{ session('result') }}
            </div>
            <br>
        @endif
        <select name="room_id">
            <option></option>
            <option selected value="1">桜の間</option>
            <option value="2">松の間</option>
            <option value="3">竹の間</option>
            <option value="4">梅の間</option>
        </select>
        <br>
        <br>
        <input type="date" name="start_date" value="2018-10-01">
        <input type="time" name="start_time" value="19:00">
        <br>
        <input type="date" name="end_date" value="2018-10-01">
        <input type="time" name="end_time" value="23:00">
        <br>
        <br>
        <button type="submit">予約する</button>
        <!-- エラー表示 -->
        @if($errors->any())
            <div style="color:red;">
                【エラー】<br><br>
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
            <br>
        @endif
    </form>
</body>
</html>