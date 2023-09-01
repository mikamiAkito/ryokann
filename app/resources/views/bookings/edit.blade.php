@extends('layouts.app')

@section('content')
    <div>
        <form action="{{ route('bookings.update', $bookings->id) }}" method="POST">
            @csrf
            @method('patch')
            <div class="form-group">
                <label for="exampleFormControlInput1">予約人数</label>
                <input type="number" class="form-control" name="number_people" value="{{$bookings->number_people}}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">宿泊開始日</label>
                <input type="date" class="form-control" name="date_strat" value="{{$bookings->date_strat}}">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">宿泊終了日</label>
                <input type="date" class="form-control" name="date_end" value="{{$bookings->date_end}}">
            </div>
            <input type="submit" class="btn btn-primary" value="更新"/>
            <!-- エラー表示 -->
            @if($errors->any())
                <div style="color:red;">
                    【エラー】<br><br>
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
                <br>
            @endif
        </form>
    </div>
@endsection