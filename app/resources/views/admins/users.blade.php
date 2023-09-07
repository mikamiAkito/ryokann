@extends('layouts.app')

@section('content')
    @foreach($users as $user)
        <div class="card my-3">
            <div class="card-body">
                <h5 class="card-title">{{$user->name}}</h5>
                <small>会員登録日:{{$user->created_at}}</small><br/>
                <small>ユーザーアイコン:{{$user->image}}</small><br/>
                @if($user->role == '0')
                    <small>一般ユーザー</small><br/>
                @elseif($user->role == '1')
                    <small>旅館運営ユーザー</small><br/>
                    <h5>違反投稿数:{{$user->posts_count}}</h5>
                @else
                    <small>管理者</small><br/>
                @endif
            </div>
        </div>
    @endforeach
@endsection