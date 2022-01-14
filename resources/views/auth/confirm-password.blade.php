@extends('layouts.guest')

@section('content')
    <div class="login-area" style="margin-top: 55px;">
        <div class="container">
            <div class="row">
                <div class="offset-lg-3 col-lg-6">
                    <div class="checkout_info mb-20">
                        <hr>
                        <center>
                            <a href="{{ route('dashboard') }}"><img src="{{ asset('img/logo.png') }}" height="100"
                                                                    width="150" alt=""></a>
                        </center>
                        <hr>
                        <form class="form-row" action="{{ route('password.confirm') }}" method="post">
                            @csrf
                            <div class="mb-3 text-sm text-muted">
                                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                            </div>

                            <div class="form_group col-12">
                                <label for="password">Password</label>
                                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                       id="password" type="password" name="password" required
                                       autocomplete="current-password" autofocus>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form_group col-12">
                                <button class="btn btn-success btn-lg btn-block"
                                        type="submit">{{ __('Confirm') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
