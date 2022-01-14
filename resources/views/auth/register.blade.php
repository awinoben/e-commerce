@extends('layouts.guest')

@section('content')
    <div class="login-area">
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
                        <form class="form-row" action="{{ route('register') }}" method="post">
                            @csrf
                            <h1 class="last-title mb-30 text-center">Get Started</h1>

                            @if (session('status'))
                                <div class="alert alert-success mb-3 rounded-0" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form_group col-12">
                                <label for="country_id">Country</label>
                                <select name="country_id" id="country_id"
                                        class="form-control {{ $errors->has('country_id') ? 'is-invalid' : '' }}">
                                    <option value="country_id" disabled selected>Select Country</option>
                                    @foreach(\App\Http\Controllers\CacheController::cacheCountries() as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form_group col-12">
                                <label for="role_id">Account Type</label>
                                <select name="role_id" id="role_id"
                                        class="form-control {{ $errors->has('role_id') ? 'is-invalid' : '' }}">
                                    <option value="role_id" disabled selected>Select Account Type</option>
                                    @foreach(\App\Http\Controllers\CacheController::cacheRoles() as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form_group col-12">
                                <label for="name">Name</label>
                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                                       value="{{ old('name') }}" required
                                       name="name" id="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

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
                                <label for="phone_number">Phone Number</label>
                                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}"
                                       type="text"
                                       value="{{ old('phone_number') }}" required
                                       name="phone_number" id="phone_number">
                                @error('phone_number')
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
                                        type="submit">{{ __('CREATE ACCOUNT') }}</button>
                            </div>

                            <div class="col-lg-12 text-left">
                                <p class="register-page"> Already have an account? <a href="{{ route('login') }}">Login
                                        here</a>.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
