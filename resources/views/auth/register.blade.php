@extends('layouts.app')

@section('content')
<style>
    /* Ensure body takes full viewport height for background & centers content */
    /* layouts.app or a global CSS might already handle some of this */
    body, html {
        height: 100%;
    }
    body.register-page-body { /* Add a specific class to body if needed to avoid conflicts */
        background-image: url("{{ asset('images/MacBook Air - 1.png') }}"); /* Assuming image is in public/images */
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding-top: 0; /* Override any default padding from layouts.app if necessary */
        padding-bottom: 0;
    }

    /* Custom styles for the login/register form (SHARED STYLES) */
    .custom-auth-container { /* Renamed from custom-login-container for reusability */
        background-color: #fff;
        border-radius: 3.5rem;
        min-height: 70vh; /* Adjusted min-height for potentially more fields */
        max-height: 800px; /* Optional: prevent it from becoming too tall */
        width: 90vw;
        max-width: 1000px; /* Max width for larger screens */
        box-shadow: 10px 10px 0px black;
        overflow: hidden; /* To contain floated/flex children properly if needed */
    }

    .custom-h1 {
        font-size: clamp(2rem, 7vw, 6rem); /* Adjusted for better fit, can be tweaked */
        color: #333; /* Example text color */
    }

    .left-column-text-container {
        width: 90%; /* Adjust as needed */
        margin: auto;
    }

    .custom-input {
        background-color: #fff !important;
        border: none;
        border-bottom: 3px solid black !important; /* Adjusted thickness slightly */
        border-radius: 0 !important;
        color: black !important; /* Ensure text typed is visible */
    }
    .custom-input::placeholder {
        font-size: clamp(1rem, 2.5vw, 1.5rem); /* Slightly smaller placeholder for more fields */
        color: #555 !important; /* Darker placeholder for readability */
    }
    .custom-input:focus {
        box-shadow: none !important; /* Remove Bootstrap's focus glow if desired */
        background-color: #fce5e0 !important; /* Slight change on focus */
    }

    /* Styling for labels in the form */
    .form-label-custom {
        font-weight: bold;
        color: #333;
        margin-bottom: 0.3rem;
        font-size: 0.9rem;
    }

    .btn-custom-auth { /* Renamed from btn-custom-login for reusability */
        background-color: #333;
        border-color: #333;
        color: white;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 0.5rem; /* Slightly rounded corners for the button */
    }
    .btn-custom-auth:hover {
        background-color: #555;
        border-color: #555;
        color: white;
    }
    .btn-link-custom {
        color: #333;
        font-size: 0.9rem;
    }
    .btn-link-custom:hover {
        color: #000;
    }

    /* Ensure consistent height for columns */
    .row-eq-height {
        display: flex;
        flex-wrap: wrap;
    }
    .row-eq-height > [class*='col-'] {
        display: flex;
        flex-direction: column;
    }

</style>

{{--
    As before, for the body styles to apply reliably, you might need to:
    1. Ensure `layouts.app.blade.php` doesn't conflict.
    2. Add a class to the body tag in `layouts.app.blade.php` like `<body class="@yield('body-class')">`
       and then in this file: `@section('body-class', 'register-page-body d-flex align-items-center justify-content-center')`
    3. Or use the JavaScript approach from the login example if necessary.
--}}

<div class="custom-auth-container d-flex p-0 position-absolute top-50 start-50 translate-middle">
    <div class="row g-0 w-100 row-eq-height">
        <div id="left" class="col-lg-6 d-none d-lg-flex flex-column justify-content-center align-items-center text-center p-4 p-md-5" style="background-color: #fdebe7;">
            <div class="left-column-text-container">
                <h1 class="custom-h1 fw-bold text-start">
                    Register to start chatting
                </h1>
                {{-- <img src="{{ asset('images/register-illustration.svg') }}" alt="Registration illustration" class="img-fluid mt-4" style="max-width: 300px;"> --}}
            </div>
        </div>

        <div id="right" class="col-lg-6 col-md-12 d-flex flex-column justify-content-center p-4 p-sm-5">
            <h2 class="fw-bold mb-4 text-center custom-h1 d-lg-none">{{ __('Register') }}</h2>
             <p class="text-center text-muted mb-4 d-lg-none">Let's get you set up!</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label-custom">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control form-control-lg custom-input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your Full Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label-custom">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control form-control-lg custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="your@email.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label-custom">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control form-control-lg custom-input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Choose a strong password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-4"> {{-- Increased bottom margin for the last input field before button --}}
                    <label for="password-confirm" class="form-label-custom">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control form-control-lg custom-input" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-custom-auth btn-lg">
                        {{ __('Register') }}
                    </button>
                </div>

                 @if (Route::has('login'))
                    <p class="text-center mt-4 mb-0">
                        <span class="text-muted">Already have an account?</span> <a href="{{ route('login') }}" class="btn-link-custom fw-bold">Log In</a>
                    </p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection

{{--
@push('styles')
// If you move CSS to a shared file like `public/css/custom-auth.css`
// <link href="{{ asset('css/custom-auth.css') }}" rel="stylesheet">
@endpush
--}}