@extends('layouts.app')

@section('title','Restaurant Info')
<h1>{{$resto->name}}</h1>
@endsection

@section('content')
<h3>description</h3>
<p>{{$resto->description}}</p>
<h3>Address</h3>
<p>{{$address->civc#}}</p>
@endsection