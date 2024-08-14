@extends('home.app.content')
@section('content')
    @foreach ($content as $c)
        @include('home.booking.' . $c)
    @endforeach
@endsection
