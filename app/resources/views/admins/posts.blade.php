@extends('layouts.app')

@section('content')
    @foreach($posts as $post)
        <div class="card my-3">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <small>内容:{{($post->explanation)}}</small><br/>
                <small>金額:{{($post->amount)}}円</small><br/>
                <small>違反報告数:{{($post->violations_count)}}</small>
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
                @if($post->del_flg == '1')
                    <h2>表示停止中</h2>
                @endif
                <form action="{{ route('admin.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <input type="hidden" name="del_flg" value="1">
                    <button type="submit">表示停止</button>
                </form>
            </div>
        </div>
    @endforeach
@endsection