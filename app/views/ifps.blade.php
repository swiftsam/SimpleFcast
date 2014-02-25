@extends('layout')

@section('content')
	<h2>Questions</h2>
    @foreach($ifps as $ifp)
        <p>{{ $ifp->id }} : <a href="questions/{{$ifp->id}}">{{$ifp->short_title}}</a></p>
    @endforeach
@stop