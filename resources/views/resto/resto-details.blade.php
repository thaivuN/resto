@extends('layouts.nav')

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
    				<h2>Details</h2>
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
                <h4>Description:</h4>
                <p>{{$resto->description}}</p>
                <p>
                	Pricing: 
					@for($i = 0; $i < $resto->price; $i++)
					{{'$'}}
					@endfor
                </p>

                {{-- Rating --}}
                <div class="rating">
                @for($i = 0 ; $i < 5 ; $i++)
                    @if($ratings[$resto->id] - $i > 1)
                        <i class="fa fa-star" aria-hidden="true"></i>
                    @elseif($ratings[$resto->id] - $i <= 0)
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
                <p>{{$resto->postal_country}}</p>
                <p>
                	{{$resto->postal_code}}

                	@if(!empty($resto->suite))
    					Suite {{$resto->suite}}
    				@endif
                </p>

        	</div>
        	<div class="panel-footer">
        		
        	</div>

    	</div>
    </div>
</div>

@endsection