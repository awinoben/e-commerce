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
                        <form class="form-row" action="{{ route('verification.resend') }}" method="post">
                            @csrf
                            <div class="mb-3 small text-muted">
                                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                            </div>

                            @if (session('status') == 'verification-link-sent')
                                <div class="alert alert-success" role="alert">
                                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                                </div>
                            @endif

                            <div class="form_group col-12">
                                <label for="email">Email</label>
                                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                       value="{{ auth()->user() ? auth()->user()->email : old('email') }}" required
                                       name="email" id="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form_group col-12">
                                <button class="btn btn-success btn-lg btn-block"
                                        type="submit">{{ __('click here to request another') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
