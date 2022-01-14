@extends('layouts.guest')

@section('content')
    <div class="login-area" style="margin-top: 55px;">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6">
                    <div class="checkout_info mb-20">
                        <hr>
                        <center>
                            <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" height="100"
                                                               width="150" alt=""></a>
                        </center>
                        <hr>
                        <form class="form-row" action="{{ route('login') }}" method="post">
                            @csrf
                            <h1 class="last-title mb-30 text-center">Welcome Back</h1>

                            @if (session('status'))
                                <div class="alert alert-success mb-3 rounded-0" role="alert">
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
                                <label for="password">Password</label>
                                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       type="password"
                                       value="{{ old('password') }}" required
                                       name="password" id="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form_group col-12">
                                <label for="remember_box">
                                    <input id="remember_box" name="remember" type="checkbox">
                                    <span> Remember me </span>
                                </label>
                            </div>

                            <div class="form_group col-12">
                                <button class="btn btn-green btn-lg btn-block"
                                        type="submit">{{ __('LOGIN') }}</button>
                            </div>

                            <div class="col-lg-12 text-left">
                                <a class="lost-password"
                                   href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                            </div>
                            <div class="col-lg-12 text-left">
                                <p class="register-page"> No account? <a href="{{ route('register') }}">Create one
                                        here</a>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
