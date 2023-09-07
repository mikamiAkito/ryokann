@extends('layouts.app')

@section('content')
<form action="violations" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 text-center">
        <label for="exampleFormControlTextarea1" class="form-label">違反報告理由</label>
        <textarea class="form-control ml-auto mr-auto" id="exampleFormControlTextarea5" rows="3" name="reason"></textarea>
    </div>
    <input type="hidden" name="post_id" value="{{ $posts }}">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection