@extends('layouts.app')

@section('content')
    <div>
        <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
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
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
            <div class="form-group row">
                <label for="avatar" class="col-md-4">{{ __('プロフィール画像') }}</label>
                <div class="col-md-6">
                    <input id="avatar" type="file" name="avatar" class="form-control-file">
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="更新"/>
        </form>
    </div>
@endsection