@extends('layouts.public')

@section('content')
<div class="container flex justify-center">
    <div class="lg:w-9 mt-5">
        <div class="card">
            <div class="card-header">Reset Password</div>
            <div class="card-body">
                <form role="form" method="POST" action="{{ url('/password/reset') }}">
                    {!! csrf_field() !!}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-lg-right">E-Mail Address</label>

                        <div class="col-lg-6">
                            <input
                                type="email"
                                class="input{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                name="email"
                                value="{{ $email or old('email') }}">
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-lg-right">Password</label>

                        <div class="col-lg-6">
                            <input
                                type="password"
                                class="input{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                name="password">
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-4 col-form-label text-lg-right">Confirm Password</label>
                        <div class="col-lg-6">
                            <input
                                type="password"
                                class="input{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <div class="invalid-feedback">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6 offset-lg-4">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
