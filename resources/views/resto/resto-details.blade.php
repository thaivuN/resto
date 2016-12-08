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
    		<div class="panel panel-default">
    			<h1 class="panel-title">Details</h1>
    		</div>

    		<div class="panel-body">
            	{{-- Image --}}
                @if(empty($resto->image_link))
                    <img src="/images/bg.jpg" width="100%" height="100%;">
                @else
                    <img src="{{$resto->image_link}}" width="100%" height="100%;">
                @endif

                <h3>Address</h3>

        	</div>


    	</div>
    </div>
</div>

@endsection