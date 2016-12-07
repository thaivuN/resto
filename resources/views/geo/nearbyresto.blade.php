@extends('layouts.nav')

@section('page-content')

@if (count($restos) > 0)
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            Near Restaurants
        </div>

        <div class="panel-body">
            <table class="table table-striped resto-table">

                <!-- Table Headings -->
                <thead>
                <th>Restaurant Name</th>
                <th>Price</th>
                <th>Postal Code</th>
                <th>Distance</th>
                <th>Details</th>
                </thead>

                <!-- Table Body -->
                <tbody>
                @foreach ($restos as $resto)
                    <tr>
                        <!-- Resto Name -->
                        <td class="table-text">
                            <div><a href="{{url('/resto_info/'.$resto->id)}}">{{ $resto->name }}</a></div>
                        </td>

                        <td class="table-text">
                            <div>
                                @for($i = 0; $i < $resto->price; $i++)
                                    {{'$'}}
                                @endfor
                            </div>
                        </td>
                        <td class="table-text">
                            <div>{{$resto->postal_code}}</div>
                        </td>
                        <td>
                            <div>{{$resto->distance}}</div>
                        </td>
                        <td class="table-text">
                            
                        </td>
                        
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif

@endsection