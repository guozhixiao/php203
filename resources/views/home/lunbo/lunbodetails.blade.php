@extends('layout.home')
@section('title',$title)


@section('content')
@foreach($lunres as $k=>$v)
		<img src="{{$v->lunaddr}}" alt="" width="100%" height="auto"> 


@endforeach
@endsection


@section('js')


@endsection