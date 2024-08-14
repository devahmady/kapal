@extends('home.app.content')
@section('content')
    @foreach ($content as $c)
        @include('auth.' . $c)
    @endforeach
@endsection
