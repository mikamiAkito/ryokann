@extends('layouts.app')

@section('content')
    @foreach($likes as $like)
        <div class="card my-3">
            <div class="card-body">
                <h5 class="card-title">{{$like->title}}</h5>
                <small>内容:{{($like->explanation)}}</small><br/>
                <small>金額:{{($like->amount)}}円</small>
                <p class="card-text">{{$like->date}}</p>
                @if($like->image == null)
                    <img src="/storage/noimage.png">
                @else
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="/storage/{{$like->image}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/storage/{{$like->image2}}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/storage/{{$like->image3}}" alt="Third slide">
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

@endsection