@extends('layouts.app')

@section('content')

    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">{{Auth::user()->name}}</h5>
            <small>メールアドレス:{{Auth::user()->email}}</small><br/>
            @if(Auth::user()->role == '0')
                <small>アカウントタイプ:一般ユーザー</small>
            @elseif(Auth::user()->role == '1')
                <small>アカウントタイプ:旅館運営ユーザー</small>
            @else
                <small>アカウントタイプ:管理者</small>
            @endif
            <a class="btn btn-primary" href="{{ route('users.edit', Auth::user()->id ) }}" role="button">編集</a>
            @if(Auth::user()->role == '0')
            <a class="btn btn-primary" href="{{ route('likes.index', Auth::user()->id ) }}" role="button">いいね一覧</a>
            <a class="btn btn-primary" href="{{ route('bookings.index', Auth::user()->id ) }}" role="button">予約一覧</a>
            @endif
            <form action="{{ route('users.destroy', Auth::user()->id) }}" method="post" class="float-right">
                @csrf
                @method('delete')
                <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
            </form>
        </div>
    </div>

@endsection