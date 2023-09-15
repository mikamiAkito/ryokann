@extends('layouts.app')

@section('content')

@if( Auth::check() )
    @if(auth()->user()->role == '1')
        <a href="/posts/create" class="btn btn-primary">新規投稿</a>
    @endif
@endif
@auth
    @if(auth()->user()->role != '2')
        @if(count($posts) > 0)
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                    <form class="d-flex" role="search" method="GET" action="{{ route('search') }}">
                    @csrf
                        <div class="form-group">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                        </div>
                        <div class="form-group">
                            <input class="form-control me-2" type="date" aria-label="Search" name="minPrice">
                        </div>
                        <div class="form-group">
                            <input class="form-control me-2" type="date" aria-label="Search" name="maxPrice">
                        </div>
                        <div class="form-group">
                            <select class="form-control me-2" id="exampleFormControlSelect1" name="minAmount">
                                <option value=" " selected hidden>選択してください</option>
                                <option value="5000">5000</option>
                                <option value="10000">10000</option>
                                <option value="20000">20000</option>
                                <option value="30000">30000</option>
                                <option value="50000">50000</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control me-2" id="exampleFormControlSelect1" name="maxAmount">
                                <option value=" " selected hidden>選択してください</option>
                                <option value="5000">5000</option>
                                <option value="10000">10000</option>
                                <option value="20000">20000</option>
                                <option value="30000">30000</option>
                                <option value="50000">50000</option>
                            </select>
                        </div>
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </nav>
            @foreach($posts as $post)
                @if($post->del_flg == '0')
                    <div class="card my-3">
                        <a href="/posts/{{$post->id}}">詳細へ</a>
                        <div class="card-body">
                            <h5 class="card-title">{{$post->title}}</h5>
                            <small>投稿日:{{($post->created_at)->format('Y/m/d')}}</small><br/>
                            <small>更新日:{{($post->updated_at)->format('Y/m/d')}}</small><br/>
                            <small>内容:{{($post->explanation)}}</small><br/>
                            <small>金額:{{($post->amount)}}円</small>
                            <p class="card-text">予約可能日</p>
                            <small>:{{$post->date_strat}}</small>
                            <small>～</small>
                            <small>{{$post->date_end}}</small>
                            @if($post->image == null)
                                <img src="/storage/noimage.png">
                            @else
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img class="d-block w-10" src="/storage/{{$post->image}}" alt="First slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-10" src="/storage/{{$post->image2}}" alt="Second slide">
                                        </div>
                                        <div class="carousel-item">
                                            <img class="d-block w-10" src="/storage/{{$post->image3}}" alt="Third slide">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @if( Auth::check() )
                            @if(auth()->user()->role == '0')
                                @if($like_model->like_exist(Auth::user()->id,$post->id))
                                    <p class="favorite-marke">
                                        <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart">いいね</i></a>
                                        <span class="likesCount">{{$post->likes_count}}good</span>
                                    </p>
                                @else
                                    <p class="favorite-marke">
                                        <a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart">いいね</i></a>
                                        <span class="likesCount">{{$post->likes_count}}good</span>
                                    </p>
                                @endif
                            @elseif(auth()->user()->role == '1')
                                <p class="favorite-marke">
                                    <span class="likesCount">{{$post->likes_count}}good</span>
                                </p>
                            @endif
                        @else
                            <p class="favorite-marke">
                                <span class="likesCount">{{$post->likes_count}}good</span>
                            </p>
                        @endif
                    </div>
                @endif
            @endforeach
        @endif
    @else
        <a href="{{ route('admin.users') }}">ユーザーリスト</a></br>
        <a href="{{ route('admin.posts') }}">投稿リスト</a>
    @endif
@endauth
@guest
    @if(count($posts) > 0)
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <form class="d-flex" role="search" method="GET" action="{{ route('search') }}">
                @csrf
                    <div class="form-group">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keyword">
                    </div>
                    <div class="form-group">
                        <input class="form-control me-2" type="date" aria-label="Search" name="minPrice">
                    </div>
                    <div class="form-group">
                        <input class="form-control me-2" type="date" aria-label="Search" name="maxPrice">
                    </div>
                    <div class="form-group">
                        <select class="form-control me-2" id="exampleFormControlSelect1" name="minAmount">
                            <option value=" " selected hidden>選択してください</option>
                            <option value="5000">5000</option>
                            <option value="10000">10000</option>
                            <option value="20000">20000</option>
                            <option value="30000">30000</option>
                            <option value="50000">50000</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="exampleFormControlSelect1" name="maxAmount">
                            <option value=" " selected hidden>選択してください</option>
                            <option value="5000">5000</option>
                            <option value="10000">10000</option>
                            <option value="20000">20000</option>
                            <option value="30000">30000</option>
                            <option value="50000">50000</option>
                        </select>
                    </div>
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
        @foreach($posts as $post)
            @if($post->del_flg == '0')
                <div class="card my-3">
                    <a href="/posts/{{$post->id}}">詳細へ</a>
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <small>投稿日:{{($post->created_at)->format('Y/m/d')}}</small><br/>
                        <small>更新日:{{($post->updated_at)->format('Y/m/d')}}</small><br/>
                        <small>内容:{{($post->explanation)}}</small><br/>
                        <small>金額:{{($post->amount)}}円</small>
                        <p class="card-text">予約可能日</p>
                        <small>:{{$post->date_strat}}</small>
                        <small>～</small>
                        <small>{{$post->date_end}}</small>
                        @if($post->image == null)
                            <img src="/storage/noimage.png">
                        @else
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-10" src="/storage/{{$post->image}}" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-10" src="/storage/{{$post->image2}}" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-10" src="/storage/{{$post->image3}}" alt="Third slide">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if( Auth::check() )
                        @if(auth()->user()->role == '0')
                            @if($like_model->like_exist(Auth::user()->id,$post->id))
                                <p class="favorite-marke">
                                    <a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart">いいね</i></a>
                                    <span class="likesCount">{{$post->likes_count}}good</span>
                                </p>
                            @else
                                <p class="favorite-marke">
                                    <a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart">いいね</i></a>
                                    <span class="likesCount">{{$post->likes_count}}good</span>
                                </p>
                            @endif
                        @elseif(auth()->user()->role == '1')
                            <p class="favorite-marke">
                                <span class="likesCount">{{$post->likes_count}}good</span>
                            </p>
                        @endif
                    @else
                        <p class="favorite-marke">
                            <span class="likesCount">{{$post->likes_count}}good</span>
                        </p>
                    @endif
                </div>
            @endif
        @endforeach
    @endif
@endguest
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
                console.log('エラー');
                console.log(err);
                console.log(xhr);
            });
        
        return false;
    });
    });
</script>