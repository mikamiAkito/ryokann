@extends('layouts.app')

@section('content')

@if( Auth::check() )
    @if(auth()->user()->role == '1')
        <a href="/posts/create" class="btn btn-primary">新規投稿</a>
    @else
        @if(!$posts->isLikedBy(Auth::user()))
            <span class="likes">
                <i class="fas fa-music like-toggle" data-post-id="{{ $posts->id }}"></i>
            <span class="like-counter">{{$posts->likes_count}}</span>
            </span><!-- /.likes -->
        @else
            <span class="likes">
                <i class="fas fa-music heart like-toggle liked" data-post-id="{{ $posts->id }}"></i>
            <span class="like-counter">{{$posts->likes_count}}</span>
            </span><!-- /.likes -->
        @endif
    @endif
@else
    <span class="likes">
        <i class="fas fa-music heart"></i>
        <span class="like-counter">{{$item->likes_count}}</span>
    </span><!-- /.likes -->
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
        </div>
    @endforeach
@endif

@endsection