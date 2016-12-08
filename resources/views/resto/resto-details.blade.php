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
    		<div class="panel panel-default">
    			<h3 class="panel-title">Details</h3>
    		</div>
    	</div>
    </div>
</div>

@endsection