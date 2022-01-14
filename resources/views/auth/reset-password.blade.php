@extends('layouts.guest')

@section('content')
    <div class="login-area">
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
                        <form class="form-row" action="{{ route('password.update') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="form_group col-12">
                                <label for="email">Email</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                       value="{{ old('email') }}" required autofocus
                                       name="email" id="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form_group col-12">
                                <label for="password">Password</label>
                                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                       type="password"
                                       id="password"
                                       name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form_group col-12">
                                <label for="password_confirmation">Confirm Password</label>
                                <input class="form-control" type="password" id="password_confirmation"
                                       name="password_confirmation" required
                                       autocomplete="new-password">
                            </div>

                            <div class="form_group col-12">
                                <button class="btn btn-success btn-lg btn-block"
                                        type="submit">{{ __('Reset Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
