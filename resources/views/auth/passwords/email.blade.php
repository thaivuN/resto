@extends('layouts.nav')

@section('title')
    Resend Password
@endsection

<!-- Main Content -->
@section('page-content')
<div class="container">
    <div class="row">

    <div class="col-md-10 col-md-offset-1">
        <div class="text-center">
            <h2 class="custom-header2">Reset Password</h2>
        </div>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form role="form" method="POST" action="{{ url('/password/email') }}" class="custom-form col-md-8">
            {{ csrf_field() }}

            <div class="col-md-10 col-md-offset-4">
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

            <div class="form-group">
                <div class="col-md-12 text-center" style="padding-top: 20px;">
                    <button type="submit" class="btn btn-danger">
                        Send Password Reset Link
                    </button>
                    <br>
                </div>
            </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
