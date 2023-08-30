@extends('layouts.app')

@section('content')
    <form method="POST" action="/bookings">
        @csrf
        <!-- 完了メッセージ -->
        @if (session('result'))
            <div style="color:green;">
                {{ session('result') }}
            </div>
            <br>
        @endif
        <div class="form-group">
            <label for="exampleInputEmail1">予約人数</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="number_people">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">予約開始日</label>
            <input type="date" class="form-control" id="exampleInputPassword1" name="date_strat">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">予約終了日</label>
            <input type="date" class="form-control" id="exampleInputPassword1" name="date_end">
        </div>
        <input type="hidden" name="post_id" value="{{ $posts }}">
        <button type="submit" class="btn btn-primary">Submit</button>
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
    <a href="">予約可能日</a>
@endsection