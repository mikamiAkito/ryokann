@extends('layouts.app')

@section('content')
    <div>
        <form action="{{ route('users.update', $users->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="exampleFormControlInput1">名前</label>
                <input type="text" class="form-control" name="name" value="{{$users->name}}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">メールアドレス</label>
                <input type="email" class="form-control" name="email" value="{{$users->email}}">
            </div>
            <!-- <div class="form-group">
                <label for="exampleFormControlInput1">ユーザーアイコン</label>
                <input type="file" class="form-control" name="image" value="">
            </div> -->
            <input type="submit" class="btn btn-primary" value="更新"/>
        </form>
    </div>
@endsection