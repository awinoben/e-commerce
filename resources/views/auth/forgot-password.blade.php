@extends('layouts.guest')

@section('content')
    <div class="login-area" style="margin-top: 55px;">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6">
                    <div class="checkout_info mb-20">
                        <hr>
                        <center>
                            <a href="{{ route('login') }}"><img src="{{ asset('img/logo.png') }}" height="100"
                                                                width="150" alt=""></a>
                        </center>
                        <hr>
                        <form class="form-row" action="{{ route('password.email') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                            </div>

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form_group col-12">
                                <label for="email">Email</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                       value="{{ old('email') }}" required
                                       name="email" id="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form_group col-12">
                                <button class="btn btn-success btn-lg btn-block"
                                        type="submit">{{ __('Email Password Reset Link') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
