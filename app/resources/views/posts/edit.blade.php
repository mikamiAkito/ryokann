@extends('layouts.app')

@section('content')
    <div>
        <form action="{{ route('posts.update', $posts->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="exampleFormControlInput1">タイトル</label>
                <input type="text" class="form-control" name="title" value="{{$posts->title}}">
            </div>
            <div class="mb-3 text-center">
                <label for="exampleFormControlInput1" class="form-label">受付開始日</label>
                <input type="date" class="form-control ml-auto mr-auto" id="exampleFormControlInput6" name="date_strat" value="{{$posts->date_strat}}">
            </div>
            <div class="mb-3 text-center">
                <label for="exampleFormControlInput1" class="form-label">受付終了日</label>
                <input type="date" class="form-control ml-auto mr-auto" id="exampleFormControlInput6" name="date_end" value="{{$posts->date_end}}">
            </div>
            <div class="mb-3 text-center">
                <label for="exampleFormControlTextarea1" class="form-label">内容</label>
                <textarea class="form-control ml-auto mr-auto" id="exampleFormControlTextarea5" rows="3" name="explanation">{{$posts->explanation}}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">画像</label>
                <input type="file" class="form-control" name="image" value="">
                <input type="file" class="form-control" name="image2" value="">
                <input type="file" class="form-control" name="image3" value="">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">金額</label>
                <input type="text" class="form-control" name="amount" value="{{$posts->amount}}">
            </div>
            @foreach ($errors->all() as $error)
                <li style="color: red;">{{ $error }}</li>
            @endforeach
            <input type="submit" class="btn btn-primary" value="更新"/>
        </form>
    </div>
@endsection