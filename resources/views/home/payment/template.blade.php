@extends('home.app.content')
@section('content')
    @foreach ($content as $c)
        @include('home.payment.' . $c)
    @endforeach
@endsection
