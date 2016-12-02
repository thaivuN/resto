@extends('layouts.app')


@section('content')
<h1>{{$resto->name}}</h1>
<h3>description</h3>
<p>{{$resto->description}}</p>
<h3>Address</h3>
<p>{{$resto->civic_num}}</p>
<h3>Reviews</h3>

<table>
    @foreach($resto->reviews as $review)
    <tr>
        <td>{{$review->title}}</td>
        <td>{{$review->content}}</td>
        <td>{{$review->rating}}</td>
        <td>{{$review->user->name}}</td>
        <td>{{$review->created_at}}</td>
    </tr>
    @endforeach
    
</table>
@endsection