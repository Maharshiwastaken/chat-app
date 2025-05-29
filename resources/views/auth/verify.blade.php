@extends('layouts.app')

@section('content')
<style>
    /* Ensure body takes full viewport height for background & centers content */
    /* layouts.app or a global CSS might already handle some of this */
    body, html {
        height: 100%;
    }
    body.verify-page-body { /* Add a specific class to body if needed to avoid conflicts */
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

    /* Custom styles for the auth form (SHARED STYLES - ensure this is in a global CSS file eventually) */
    .custom-auth-container {
        background-color: #fdc4ba;
        border-radius: 3.5rem;
        min-height: 50vh; /* Can be a bit shorter for this page */
        max-height: 600px;
        width: 90vw;
        max-width: 1000px;
        box-shadow: 10px 10px 0px black;
        overflow: hidden;
    }

    .custom-h1 {
        font-size: clamp(1.8rem, 5vw, 4.5rem); /* Adjusted for this context */
        color: #333;
    }

    .left-column-text-container {
        width: 90%;
        margin: auto;
    }

    /* Specific styling for verify page text */
    .verify-page-text {
        font-size: clamp(1rem, 1.8vw, 1.2rem);
        color: #444;
        line-height: 1.6;
    }

    .alert-custom-verify { /* Custom styling for the success alert if needed */
        background-color: #e9f7ef; /* Softer green */
        border-color: #c3e6cb;
        color: #155724;
        border-radius: 0.5rem; /* Match button radius */
        font-size: clamp(0.9rem, 1.5vw, 1.1rem);
    }


    .btn-custom-auth { /* Shared button style */
        background-color: #333;
        border-color: #333;
        color: white;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 0.5rem;
    }
    .btn-custom-auth:hover {
        background-color: #555;
        border-color: #555;
        color: white;
    }
    .btn-link-custom-verify { /* Styling for the resend link if kept as a link */
        color: #333;
        font-weight: bold;
        text-decoration: underline;
    }
    .btn-link-custom-verify:hover {
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

<div class="custom-auth-container d-flex p-0">
    <div class="row g-0 w-100 row-eq-height">
        <div id="left" class="col-lg-6 d-none d-lg-flex flex-column justify-content-center align-items-center text-center p-4 p-md-5" style="background-color: #fdebe7;">
            <div class="left-column-text-container">
                <h1 class="custom-h1 fw-bold">
                    Almost There!
                </h1>
                <p class="mt-3 fs-5 text-muted">Please check your inbox to verify your email address and complete your registration.</p>
                {{-- You could add an envelope icon or similar illustration here --}}
                {{-- <img src="{{ asset('images/email-verify-illustration.svg') }}" alt="Email illustration" class="img-fluid mt-4" style="max-width: 250px;"> --}}
            </div>
        </div>

        <div id="right" class="col-lg-6 col-md-12 d-flex flex-column justify-content-center p-4 p-sm-5">
            <h2 class="fw-bold mb-4 text-center custom-h1">{{ __('Verify Your Email Address') }}</h2>

            @if (session('resent'))
                <div class="alert alert-custom-verify text-center" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            <p class="verify-page-text text-center mb-3">
                {{ __('Before proceeding, please check your email for a verification link.') }}
            </p>
            <p class="verify-page-text text-center">
                {{ __('If you did not receive the email') }},
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    {{-- Option 1: Styled as a prominent button --}}
                    <button type="submit" class="btn btn-custom-auth btn-sm mt-2">{{ __('Request Another Link') }}</button>
                    {{-- Option 2: Styled as a link (adjust .btn-link-custom-verify CSS as needed) --}}
                    {{-- <button type="submit" class="btn btn-link p-0 m-0 align-baseline btn-link-custom-verify">{{ __('click here to request another') }}</button>. --}}
                </form>
            </p>

            <hr class="my-4">

            <p class="text-center">
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="btn-link-custom">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </p>
            @if (Route::has('login'))
            <p class="text-center mt-2">
                 <a href="{{ route('login') }}" class="btn-link-custom">{{ __('Back to Login') }}</a>
            </p>
            @endif


        </div>
    </div>
</div>
@endsection

