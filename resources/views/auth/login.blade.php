@extends('layouts.public')

@section('content')
<div class="container flex justify-center">
    <div class="lg:w-9 mt-5">
        <div class="card">
            <div class="card-header">Log in</div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group row">
                        <label for="email" class="col-lg-4 col-form-label text-lg-right">E-Mail Address</label>

                        <div class="col-lg-6">
                            <input
                                id="email"
                                type="email"
                                class="input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autofocus>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-lg-4 col-form-label text-lg-right">Password</label>

                        <div class="col-lg-6">
                            <input
                                id="password"
                                type="password"
                                class="input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password"
                                required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 offset-lg-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">Remember me</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-8 offset-lg-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
