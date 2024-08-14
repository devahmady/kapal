@extends('home.app.content')
@section('content')
    @foreach ($content as $c)
        @include('home.user.' . $c)
    @endforeach
@endsection
