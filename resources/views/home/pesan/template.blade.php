@extends('home.app.content')
@section('content')
    @foreach ($content as $c)
        @include('home.pesan.' . $c)
    @endforeach
@endsection
