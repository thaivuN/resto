@extends('layouts.nav')

@section('title')
Welcome!
@endsection

@section('page-content')
<div class="container parent_index">
    <div class="col-md-8">
        <h1><span>Foody, </span>we help you find good food.</h1>

        <!-- Geolocation -->
        <form action="/geo" method="POST" class="form-horizontal" id="hiddenForm" style="margin-top: 5%;">
            {{ csrf_field() }}

            <!-- Postal code -->
            <div class="input-group col-xs-5 {{ $errors->has('postal') ? ' has-error' : '' }}">
                <input type="text" name="postal" id="postal" class="form-control index_input input-lg" value="{{ old('postal') }}" maxlength="7" placeholder="Postal Code">
                @if ($errors->has('postal'))
                    <span class="help-block">
                        <strong>{{ $errors->first('postal') }}</strong>
                    </span>
                @endif

                <!-- submit Button -->
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary btn-lg">
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

    <div class="col-md-4">
        <img src="/images/logo_t.png" width="50%" height="50%;">
    </div>
</div>

<div class="footer text-center footer-pretty" style="background-color: #f49076;height: 30px; margin-top: 20px;">
    <p style="padding-top: 14px;">&copy; NullPointerExceptions - 2016</p>
</div>
@endsection
