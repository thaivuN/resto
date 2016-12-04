@extends('layouts.app')


@section('content')
<h1>{{$resto->name}}</h1>
<a href="{{url('/resto_update/'.$resto->id)}}">Update</a>
<h3>description</h3>
<p>{{$resto->description}}</p>
<h3>Address</h3>
<p>{{$resto->civic_num.' '.$resto->street}}
    <br/>{{$resto->city.', '.$resto->postal_code}}
    <br/>
    @if(!empty($resto->suite))
    Suite {{$resto->suite}}
    @endif
</p>
<h3>Reviews</h3>

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
            
    </tr>
    @endforeach
    
</table>
{!! $reviews->render() !!}




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
@endsection