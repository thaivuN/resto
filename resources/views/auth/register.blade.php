@extends('layouts.nav')

@section('page-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
        <div class="text-center">
            <h2 class="custom-header">Register</h2>
        </div>

        <form role="form" method="POST" action="{{ url('/register') }}" class="custom-form col-md-8">


            {{ csrf_field() }}
            <div class="col-md-10 col-md-offset-5">

            {{-- Name --}}
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label for="name">Name</label>
                    <input type="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter name" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- Email --}}
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- Password --}}
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label for="pwd">Password</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Password" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            {{-- Password #2 --}}
            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label for="pwd">Confirm Password</label>
                    <input type="password" class="form-control" id="password-confirm" placeholder="Password" name="password_confirmation" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                </div>
            </div>

            {{-- Postal --}}
            <div class="form-group {{ $errors->has('postal_code') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label for="email">Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" placeholder="Enter postal code" name="postal_code" value="{{ old('postal_code') }}" required>
                    @if ($errors->has('psotal_code'))
                        <span class="help-block">
                            <strong>{{ $errors->first('postal_code') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

                {{-- Button --}}
                <div class="form-group" style="padding-top: 20px;">
                    <div class="col-md-12" style="padding-top: 20px;">
                    <button type="submit" class="btn btn-warning">
                        Register
                    </button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
