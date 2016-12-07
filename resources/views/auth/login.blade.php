@extends('layouts.nav')

@section('page-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        <div class="text-center">
            <h2 class="custom-header">Login</h2>
        </div>

        <form role="form" method="POST" action="{{ url('/login') }}" class="custom-form col-md-8">
            {{ csrf_field() }}
            <div class="col-md-8 col-md-offset-5">
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
                <div class="col-md-8">
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
        <!--
            <div class="panel panel-warning">
                <div id="custom-header" class="panel-heading text-center">Login</div>
                <div class="panel-body">


                    <form class="form-vertical" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            -->
        </div>
    </div>
</div>
@endsection
