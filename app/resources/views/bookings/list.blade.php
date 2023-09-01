@extends('layouts.app')

@section('content')
    @foreach($bookings as $booking)
        <div class="card my-3">
            <div class="card-body">
                <h5 class="card-title">{{$booking->title}}</h5>
                <small>内容:{{($booking->explanation)}}</small><br/>
                <small>金額:{{($booking->amount)}}円</small><br/>
                <small>宿泊開始日:{{($booking->date_strat)}}</small><br/>
                <small>宿泊終了日:{{($booking->date_end)}}</small>
                <p class="card-text">{{$booking->date}}</p>
                @if($booking->image == null)
                    <img src="/storage/noimage.png">
                @else
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="/storage/{{$booking->image}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/storage/{{$booking->image2}}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="/storage/{{$booking->image3}}" alt="Third slide">
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
            <a href="{{ route('bookings.edit', $booking->id ) }}">編集</a>

            <form action="{{ route('bookings.destroy', $booking->id) }}" method="post" class="float-right">
                @csrf
                @method('delete')
                <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("削除しますか？");'>
            </form>
        </div>
    @endforeach

@endsection