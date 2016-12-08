@extends('layouts.nav')

@section('page-content')


<div class="container">

@if(count($restos) > 0)
@foreach($restos as $resto)    
    @if($loop->index % 3 === 0)
        <div class="row">
    @endif

    <div class="col-md-4 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading"><a href="{{url('/resto_info/'.$resto->id)}}">{{ $resto->name }}</a></div>
        <div class="panel-body image-container">
            {{-- Image --}}
            <a href="{{url('/resto_info/'.$resto->id)}}">
                @if(empty($resto->image_link))
                    <img src="/images/bg.jpg">
                @else
                    <img src="{{$resto->image_link}}">
                @endif
            </a>
        </div>

        <div class="panel-body separator nopadding" text-overflow: ellipsis;>
            {{-- general info --}}

            
                <div class="col-md-3 col-xs-12 text-center" style="background-color: #b4d455; height: 100%;">
                    {{-- Pricing --}}
                    @for($i = 0; $i < $resto->price; $i++)
                        {{'$'}}
                    @endfor
                </div>

                <div class="col-md-6 col-xs-12 stars text-center" style="height: 100%;">
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

                </div>
                <div class="col-md-3 col-xs-12 text-center" style="height: 100%;">
                    {{-- Genre --}}
                    <p style="max-width: 100%;max-height: 100%;white-space: nowrap;text-overflow: ellipsis;overflow:hidden;">{{$resto->genre->genre}}</p>
                </div>
            
        </div>

        <div class="panel-footer text-center">
            <p>{{$resto->civic_num.", ".$resto->street}}</p>
        </div>
    </div>
    </div>

    @if($loop->index % 3 === 2)
        </div>
    @endif

@endforeach
@else
    <strong>We're sorry, we do not have any restos for you.</strong>
@endif
</div>
@endsection