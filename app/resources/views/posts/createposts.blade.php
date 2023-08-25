@extends('layouts.app')

@section('content')
<!doctype html>
<html lang="en">
    <head>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
    </head>
    <body>
        <h1 class="text-center">投稿入力画面</h1>
        <a href="/posts/calender" class="btn btn-primary">予約可能日確認</a>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 text-center">
                <label for="exampleFormControlInput1" class="form-label">タイトル</label>
                <input type="text" class="form-control ml-auto mr-auto" id="exampleFormControlInput7" name="title">
            </div>
            <div class="mb-3 text-center">
                <label for="exampleFormControlInput1" class="form-label">予約可能日</label>
                <input type="date" class="form-control ml-auto mr-auto" id="exampleFormControlInput6" name="date">
            </div>
            <div class="mb-3 text-center">
                <label for="exampleFormControlTextarea1" class="form-label">内容</label>
                <textarea class="form-control ml-auto mr-auto" id="exampleFormControlTextarea5" rows="3" name="explanation"></textarea>
            </div>
            <div class="mb-3 text-center">
                <label for="exampleFormControlInput1" class="form-label">画像</label>
                <input type="file" class="form-control ml-auto mr-auto" id="exampleFormControlInput1" name="image">
                <input type="file" class="form-control ml-auto mr-auto" id="exampleFormControlInput2" name="image2">
                <input type="file" class="form-control ml-auto mr-auto" id="exampleFormControlInput3" name="image3">
            </div>
            <div class="mb-3 text-center">
                <label for="exampleFormControlInput1" class="form-label">金額</label>
                <input type="text" class="form-control ml-auto mr-auto" id="exampleFormControlInput4" name="amount">
            </div>
            <div class="mb-3 text-center">
                <input type="submit" value="投稿" class="ml-auto mr-auto btn btn-primary btn-lg"/>
            </div>
        </form>
    </body>
</html>
@endsection