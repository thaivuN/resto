@extends('layouts.nav')

@section('page-content')


<div class="container">

@if(count($restos) > 0)
@foreach($resto as $restos)    
    @if($loop->index % 3 === 0)
        <div class="row"></div>
    @endif

    <div class="panel panel-primary col-md-4 col-xs-12">
        <div class="panel-heading"><a href="{{url('/resto_info/'.$resto->id)}}">{{ $resto->name }}</a></div>
        <div class="panel-body">
            {{-- Image --}}
        </div>

        <div class="panel-body">
            {{-- general info --}}

            <ul class="list-inline">
                <li>
                    {{-- Pricing --}}
                    @for($i = 0; $i < $resto->price; $i++)
                        {{'$'}}
                    @endfor
                </li>

                <li>
                    {{-- Rating --}}
                    <div class="rating">
                    @for($i = 0 ; $i < 5 ; $i++)
                        @if($ratings[$resto->id] - $i > 1)
                            <i class="glyphicon glyphicon-star"></i>
                        @elseif($ratings[$resto->id] - $i < 0)
                            <i class="glyphicon glyphicon-star-empty"></i>
                        @else
                            <i class="glyphicon glyphicon-star half"></i>
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