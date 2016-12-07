@extends('layouts.nav')

@section('page-content')


<div class="container">

@if(count($restos) > 0)
@foreach($restos as $resto)    
    @if($loop->index % 3 === 0)
        <div class="row"></div>
    @endif

    <div class="panel panel-default col-md-4 col-xs-12">
        <div class="panel-heading"><a href="{{url('/resto_info/'.$resto->id)}}">{{ $resto->name }}</a></div>
        <div class="panel-body">
            {{-- Image --}}
        </div>

        <div class="panel-body">
            {{-- general info --}}

            <ul class="list-inline add-separator">
                <li>
                    {{-- Pricing --}}
                    @for($i = 0; $i < $resto->price; $i++)
                        {{'$'}}
                    @endfor
                </li>

                <li class="color-yellow">
                    {{-- Rating --}}
                    <div class="rating">
                    @for($i = 0 ; $i < 5 ; $i++)
                        @if($ratings[$resto->id] - $i > 1)
                            <i class="fa fa-star" aria-hidden="true"></i>
                        @elseif($ratings[$resto->id] - $i <= 0)
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                        @else
                            {{-- I do not know how to make the star look half full --}}                       
                            <i class="fa fa-star-half-o" aria-hidden="true"></i>
                        @endif
                    @endfor
                    </div>

                </li>
                <li></li>
            </ul>

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