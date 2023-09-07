@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    違反報告を送信しました
                </div>
                <a class="navbar-brand" href="{{ url('/') }}">topへ</a>
            </div>
        </div>
    </div>
</div>
@endsection
