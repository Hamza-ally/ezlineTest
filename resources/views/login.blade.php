<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>EZline | Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ asset('') }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/iconfonts/font-awesome/css/all.min.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/vendor.bundle.base.css?v=' . time()) }}">
    <link rel="stylesheet" href="{{ asset('theme/vendors/css/vendor.bundle.addons.css?v=' . time()) }}">

    <link rel="stylesheet" href="{{ asset('theme/css/style.css?v=' . time()) }}">

    <link rel="shortcut icon" href="{{ asset('theme/images/favicon.png') }}" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row w-100">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="theme/images/logo.svg" alt="logo">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" id="login_form" method="POST" action="{{ route('api.login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-lg" name="email" id="email"
                                        placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg" name="password"
                                        id="password" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" id="login" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <a href="{{route('register')}}" class="auth-link text-black">Sign Up?</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="{{ asset('theme/vendors/js/vendor.bundle.base.js?v=' . time()) }}"></script>
    <script src="{{ asset('theme/vendors/js/vendor.bundle.addons.js?v=' . time()) }}"></script>

    <script src="{{ asset('theme/js/off-canvas.js?v=' . time()) }}"></script>
    <script src="{{ asset('theme/js/hoverable-collapse.js?v=' . time()) }}"></script>
    <script src="{{ asset('theme/js/misc.js?v=' . time()) }}"></script>
    <script src="{{ asset('theme/js/settings.js?v=' . time()) }}"></script>
    <script src="{{ asset('theme/js/todolist.js?v=' . time()) }}"></script>

    <script src="{{ asset('js/auth/auth.js?v=' . time()) }}"></script>

</body>

</html>


{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}
