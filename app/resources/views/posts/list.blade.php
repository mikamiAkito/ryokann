@extends('layouts.app')

@section('content')

@if( Auth::check() )
    @if(auth()->user()->role == '1')
        <a href="/posts/create" class="btn btn-primary">新規投稿</a>
    @endif
@endif
@if(count($posts) > 0)
    @foreach($posts as $post)
        <div class="card my-3">
            <a href="/posts/{{$post->id}}">詳細へ</a>
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <small>投稿日:{{($post->created_at)->format('Y/m/d')}}</small><br/>
                <small>更新日:{{($post->updated_at)->format('Y/m/d')}}</small><br/>
                <small>内容:{{($post->explanation)}}</small><br/>
                <small>金額:{{($post->amount)}}円</small>
                <p class="card-text">{{$post->date}}</p>
                @if($post->image == null)
                    <img src="/storage/noimage.png">
                @else
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="/storage/{{$post->image}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/storage/{{$post->image2}}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/storage/{{$post->image3}}" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                @endif
            </div>
            @if( Auth::check() )
                @if(auth()->user()->role == '0')
                    @if($like_model->like_exist(Auth::user()->id,$post->id))
                        <p class="favorite-marke">
                            <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart">いいね</i></a>
                            <span class="likesCount">{{$post->likes_count}}</span>
                        </p>
                    @else
                        <p class="favorite-marke">
                            <a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart">いいね</i></a>
                            <span class="likesCount">{{$post->likes_count}}</span>
                        </p>
                    @endif
                @endif
            @else
                <p class="favorite-marke">
                    <span class="likesCount">{{$post->likes_count}}</span>
                </p>
            @endif
        </div>
    @endforeach
@endif

@endsection
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    $(function () {
        console.log("a");//接続確認（開発者ツールコンソール）
    var like = $('.js-like-toggle');
    var likePostId;
    
    like.on('click', function () {
        var $this = $(this);
        likePostId = $this.data('postid');
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/ajaxlike',  //routeの記述
                type: 'POST', //受け取り方法の記述（GETもある）
                data: {
                    'posts_id': likePostId //コントローラーに渡すパラメーター
                },
        })
    
            // Ajaxリクエストが成功した場合
            .done(function (data) {
    //lovedクラスを追加
                $this.toggleClass('loved'); 
    
    //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
                $this.next('.likesCount').html(data.postsLikesCount); 
    
            })
            // Ajaxリクエストが失敗した場合
            .fail(function (data, xhr, err) {
    //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
    //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });
        
        return false;
    });
    });
</script>