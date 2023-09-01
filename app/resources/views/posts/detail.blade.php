@extends('layouts.app')

@section('content')
    <div class="card my-3">
        <div class="card-body">
            <h5 class="card-title">{{$posts->title}}</h5>
            <small>投稿日:{{($posts->created_at)->format('Y/m/d')}}</small><br/>
            <small>更新日:{{($posts->updated_at)->format('Y/m/d')}}</small><br/>
            <small>内容:{{($posts->explanation)}}</small><br/>
            <small>金額:{{($posts->amount)}}円</small>
            <p class="card-text">{{$posts->date}}</p>
            @if($posts->image == null)
                <img src="/storage/noimage.png">
            @else
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="/storage/{{$posts->image}}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="/storage/{{$posts->image2}}" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="/storage/{{$posts->image3}}" alt="Third slide">
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
            @if( Auth::check() )
                @if(auth()->user()->id == $posts->user_id)
                    <a href="{{ route('posts.edit', $posts->id ) }}">編集</a>

                    <form action="{{ route('posts.destroy', $posts->id) }}" method="post" class="float-right">
                        @csrf
                        @method('delete')
                        <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
                    </form>
                    
                @endif
                @if(auth()->user()->role == '0')
                <a href="{{ route('bookings.create',[ 'post_id' => $posts->id ]) }}">予約</a>
                <a href="">違反報告</a>
                @endif
            @endif
        </div>
    </div>
@endsection
