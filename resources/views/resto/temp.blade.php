@extends('layouts.nav')


@section('content')
<h1>{{$resto->name}}</h1>
@if(Auth::check() && $resto->userCanEdit(Auth::user()))
<a href="{{url('/resto_update/'.$resto->id)}}">Update</a>
<br/>
@endif
@for($i = 0; $i < $resto->price; $i++)
{{'$'}}
@endfor

@if(!empty($resto->image_link))
<p>Visit this page to see photos of the restaurant: {{$resto->image_link}}</p>
@endif
<h3> Contact us</h3>
@if(!empty($resto->link))
<a href="{{$resto->link}}">Link: {{$resto->link}}</a>
@else
<p>Link: N/A</p>
@endif
<p>Resto email: @if(!empty($resto->resto_email))
    {{$resto->resto_email}} 
    @else
    N/A
    @endif
</p>
<p>Phone: {{$resto->phone}}</p>
<h4>Genre</h4>
<p>{{$resto->genre->genre}}</p>
<h4>Created at: {{$resto->created_at}}</h4>
@if($resto->created_at!=$resto->updated_at)
<h4>Modified at: {{$resto->updated_at}}</h4>
@endif

<p>Rating: {{number_format($resto->ratings(),1)}}</p>

<h3>Reviews</h3>

<!--
<table>
    @foreach($reviews as $review)
    <tr>
        <td>{{$review->title}}</td>
        <td>{{$review->content}}</td>
        <td>{{$review->rating}}</td>
        <td>{{$review->user->name}}</td>
        <td>@if($review->created_at==$review->updated_at)
                {{$review->created_at}}
            @else
                Updated:{{$review->updated_at}}
            @endif
        </td>
        @if(Auth::check() &&  $review->userCanEdit(Auth::user()))
        <td>
            <form action="" method="POST" class="form-horizontal">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <button type="submit" id="delete-review-{{ $review->id }}" class="btn btn-danger">
                    <i class="fa fa-btn fa-trash"></i>Delete
                </button>
            </form>
        </td>
        @else
        <td></td>
        @endif
            
    </tr>
    @endforeach
    
</table>
{!! $reviews->render() !!}
-->

@if(Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @include('common.errors')
                <div class="panel-heading">Add a Review</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/resto/review/store/'.$resto->id) }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Review Header</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{old('title')}}" >

                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="col-md-4 control-label">Content</label>

                            <div class="col-md-6">
                                <textarea id="content" type="text" class="form-control" name="content" value="{{old('content')}}" ></textarea>

                                @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
                            <label for="rating" class="col-md-4 control-label">Rating</label>

                            <div class="col-md-6">
                                <input id="rating" type="text" class="form-control" name="rating" value="{{old('rating')}}" min="1" max="5">

                                @if ($errors->has('rating'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('rating') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="container">
    @foreach($reviews as $review)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-8">{{$review->title}}</div>
                        <div class="col-md-4">
                            Rating: {{$review->rating}}
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div>{{$review->content}}</div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-8">Author: {{$review->user->name}}</div>
                        <div class="col-md-4">
                            {{$review->created_at}}
                        </div>
                    </div>    
                </div>

            </div>
        </div>
    </div>
    @endforeach
    {!! $reviews->render() !!}
</div>
@endsection

