@extends('home.app.content')
@section('content')
    @foreach ($content as $c)
        @include('home.history.' . $c)
    @endforeach
@endsection
