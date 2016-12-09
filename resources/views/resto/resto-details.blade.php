@extends('layouts.nav')

@section('title')
{{$resto->name}}
@endsection

@section('page-content')

<div class="container">

    <div class="row">       
        <div class="col-md-12 col-xs-12 text-center">
            
            <h1 class="resto-name">{{$resto->name}}</h1>

        </div>
    </div>

    <div class="row">
    	<div class="col-md-6 col-xs-12">
    		{{-- Panel starts here --}}
    		<div class="panel panel-info">
    			<div class="panel-title" style="margin-left: 3%">
    				<h3>Details</h3>
    			</div>
    		</div>

    		<div class="panel-body" style="background-color:#F9F9F9;">
            	{{-- Image --}}
                @if(empty($resto->image_link))
                    <img src="/images/bg.jpg" width="100%" height="100%;">
                @else
                    <img src="{{$resto->image_link}}" width="100%" height="100%;">
                @endif

                {{-- General Information --}}
                <h3>Info</h3>
                @if(Auth::check() && $resto->userCanEdit(Auth::user()))
                    <a href="{{url('/resto_update/'.$resto->id)}}" style="float:right" class="btn btn-link">Update</a>
                @endif

                <h4>Description:</h4>
                <p>{{$resto->description}}</p>
                <p>
                	Pricing: 
					@for($i = 0; $i < $resto->price; $i++)
					{{'$'}}
					@endfor
                </p>

                {{-- Rating --}}
                <div class="rating stars">
                @for($i = 0 ; $i < 5 ; $i++)
                    @if(number_format($resto->ratings(),1) - $i >= 1)
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @elseif(number_format($resto->ratings(),1) - $i <= 0)
                        <i class="fa fa-star-o" aria-hidden="true"></i>
                    @else                     
                        <i class="fa fa-star-half-o" aria-hidden="true"></i>
                    @endif
                @endfor
                </div>

                {{-- Address --}}
                <h3>Address</h3>
                <p>{{$resto->civic_num.' '.$resto->street}}</p>
                <p>{{$resto->city}}, {{$resto->province}}</p>
                <p>{{$resto->country}}</p>
                <p>
                	{{$resto->postal_code}}

                	@if(!empty($resto->suite))
    					Suite {{$resto->suite}}
    				@endif
                </p>

                {{-- Contact --}}
                <h3>Contact</h3>
                <p><i class="fa fa-phone" aria-hidden="true"></i> {{$resto->phone}}</p>

                @if(!empty($resto->resto_email))
                <p><i class="fa fa-envelope" aria-hidden="true"></i> {{$resto->resto_email}}</p>
                @endif

                @if(!empty($resto->link))
                <a href="{{$resto->link}}">Link to the website</a>
                @endif

                
        	</div>

    	</div>

    	{{-- Reviews column --}}
    	<div class="col-md-6 col-xs-12">
    		{{-- Panel starts here --}}
    		<div class="panel panel-info">
    			<div class="panel-title" style="margin-left: 3%">
    				<h3 >Reviews</h3>
    			</div>

    			@if(Auth::check())
    			{{-- Add Review --}}
    			<div class="panel-body">
    				<form class="form-vertical" role="form" method="POST" action="{{ url('/resto/review/store/'.$resto->id) }}">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="control-label">Title</label>

                                <input id="title" type="text" class="form-control" name="title" value="{{old('title')}}" >

                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content" class="control-label">Content</label>

                                <textarea id="content" type="text" class="form-control" name="content" value="{{old('content')}}" ></textarea>

                                @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                        </div>

                        {{-- If I will have time I will add a click even for the rating. --}}
                        <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
                            <label for="rating" class="control-label">Rating</label>

                                <input id="rating" type="text" class="form-control" name="rating" value="{{old('rating')}}" min="1" max="5">

                                @if ($errors->has('rating'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('rating') }}</strong>
                                </span>
                                @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-8">
                                <button type="submit" class="btn btn-primary">
                                    Review
                                </button>

                            </div>
                        </div>
                    </form>
    			</div>
    			@endif

				{{-- Other reviews --}}
				<div class="panel-body">
					@foreach($reviews as $review)
						<div class="review-container">
							<p><b>{{$review->title}}</b></p>
							<p>{{$review->content}}</p>

							<div class="rating stars">
                			@for($i = 0 ; $i < 5 ; $i++)
                    			@if($review->rating - $i >= 1)
                        			<i class="fa fa-star" aria-hidden="true"></i>
                    			@elseif($review->rating - $i <= 0)
                        			<i class="fa fa-star-o" aria-hidden="true"></i>
                    			@else                     
                        			<i class="fa fa-star-half-o" aria-hidden="true"></i>
                    			@endif
                			@endfor
                			</div>

                			<p>By: {{$review->user->name}}</p>
						</div>
						<hr>
					@endforeach

                    {!! $reviews->render() !!}

                    @if(count($reviews) === 0)
                        <p>There is no reviews for this restaurant yet. Be the first to rate it!</p>
                    @endif
				</div>

    		</div>
    	</div>
    </div>
</div>

@endsection