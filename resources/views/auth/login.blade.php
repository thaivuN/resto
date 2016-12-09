@extends('layouts.nav')

@section('page-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        <div class="text-center">
            <h2 class="custom-header">Login</h2>
        </div>

        <form role="form" method="POST" action="{{ url('/login') }}" class="custom-form col-md-8">
            {{ csrf_field() }}
            <div class="col-md-10 col-md-offset-4">
            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-md-12">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ old('email') }}" required autofocus>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>


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

            <div class="form-group">
                <div class="col-md-12">
                    <div class="checkbox">
                         <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group margin-small">
                <div class="col-md-8 text-center">
                    <button type="submit" class="btn btn-warning">
                        Login
                    </button>

                    <a class="btn btn-link btn-color-white" href="{{ url('/password/reset') }}">
                        Forgot Your Password?
                    </a>
                </div>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
