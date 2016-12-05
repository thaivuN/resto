@extends('layouts.app')
@section('content')


<div class="container parent_index">
    <div>
        <h1><span>Foody, </span>we help you find good food.</h1>

        <!-- Geolocation -->
        <form action="/geo" method="POST" class="form-horizontal" id="hiddenForm" style="margin-top: 5%;">
            {{ csrf_field() }}

            <!-- Postal code -->
            <div class="input-group col-xs-3 {{ $errors->has('postal') ? ' has-error' : '' }}">
                <input type="text" name="postal" id="postal" class="form-control index_input input-lg" value="{{ old('postal') }}" maxlength="7" placeholder="Postal Code">
                @if ($errors->has('postal'))
                <span class="help-block">
                    <strong>{{ $errors->first('postal') }}</strong>
                </span>
                @endif

                <!-- submit Button -->
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-warning btn-lg">
                        Start
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </span>

            </div>



            <!-- all the hidden fields -->
            <input type="hidden" name="latitude"/>
            <input type="hidden" name="longitude"/>
            <input type="hidden" name="error"/>
        </form>
    </div>
</div>



@endsection

@section('js')
<script src="/js/geo.js"></script>
@endsection