{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

@extends('layouts.app')

@section('content')
<style>
    /* Ensure body takes full viewport height for background & centers content */
    /* layouts.app or a global CSS might already handle some of this */
    body, html {
        height: 100%;
    }
    body.login-page-body { /* Add a specific class to body if needed to avoid conflicts */
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

    /* Custom styles for the login form */
    .custom-login-container {
        background-color: #fff;
        border-radius: 3.5rem;
        min-height: 60vh; /* Use min-height for flexibility */
        max-height: 700px; /* Optional: prevent it from becoming too tall */
        width: 90vw;
        max-width: 1000px; /* Max width for larger screens */
        box-shadow: 10px 10px 0px black;
        overflow: hidden; /* To contain floated/flex children properly if needed */
    }

    .custom-h1 {
        font-size: clamp(2rem, 7vw, 6rem); /* Adjusted for better fit */
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
        font-size: clamp(1rem, 2.5vw, 1.75rem);
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

    .form-check-label-custom {
        font-size: 0.9rem;
        color: #333;
    }

    .btn-custom-login {
        background-color: #333;
        border-color: #333;
        color: white;
        padding: 0.75rem 1.5rem;
        font-size: 1.1rem;
        border-radius: 0.5rem; /* Slightly rounded corners for the button */
    }
    .btn-custom-login:hover {
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

{{-- Add a class to body tag if you need very specific body styles only for this page.
You might need to modify your layouts.app.blade.php to allow pushing classes to body or use JavaScript.
Alternatively, wrap the content in a div that takes full height if modifying body is hard.
For now, assuming `layouts.app` allows the body to be styled or the styles above are sufficient.
If you control layouts.app.blade.php, you could have: <body class="@yield('body-class')">
And here: @section('body-class', 'login-page-body d-flex align-items-center justify-content-center')
--}}

<div class="custom-login-container d-flex p-0 position-absolute top-50 start-50 translate-middle""> {{-- Removed p-3/p-md-4 to let columns handle padding --}}
    <div class="row g-0 w-100 row-eq-height"> {{-- g-0 to remove gutters, w-100 to fill container --}}
        <div id="left" class="col-lg-6 d-none d-lg-flex flex-column justify-content-center align-items-center text-center p-4 p-md-5" style="background-color: #fdebe7;"> {{-- Slightly different bg for left if desired, or remove style --}}
            <div class="left-column-text-container">
                <h1 class="custom-h1 fw-bold text-start">
                    {{-- Text from your custom design --}}
                    Login to <br class="d-md-none">see your chats
                </h1>
                {{-- You can add an illustrative image or more text here --}}
                {{-- <img src="{{ asset('images/chat-illustration.svg') }}" alt="Chat illustration" class="img-fluid mt-4" style="max-width: 300px;"> --}}
            </div>
        </div>

        <div id="right" class="col-lg-6 col-md-12 d-flex flex-column justify-content-center p-4 p-sm-5">
            <h2 class="fw-bold mb-4 text-center custom-h1 d-lg-none">{{ __('Login') }}</h2> {{-- Login title for smaller screens where left panel is hidden --}}
             <p class="text-center text-muted mb-4 d-lg-none">Welcome back!</p>


            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label-custom">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control form-control-lg custom-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="your@email.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label-custom">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control form-control-lg custom-input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="your password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label form-check-label-custom" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                     @if (Route::has('password.request'))
                    <div class="col-md-6 text-md-end">
                        <a class="btn btn-link btn-link-custom p-0" href="{{ route('password.request') }}">
                            {{ __('Forgot Password?') }}
                        </a>
                    </div>
                    @endif
                </div>


                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-custom-login btn-lg">
                        {{ __('Login') }}
                    </button>
                </div>

                @if (Route::has('register'))
                    <p class="text-center mt-4 mb-0">
                        <span class="text-muted">Don't have an account?</span> <a href="{{ route('register') }}" class="btn-link-custom fw-bold">Sign Up</a>
                    </p>
                @endif
            </form>
        </div>
    </div>
</div>

@endsection

{{-- @push('scripts')
<script>
    // If your layouts.app.blade.php uses a class for the body that you want to override for this page only:
    // document.body.classList.add('login-page-body');
    // Or ensure your body tag in layouts.app.blade.php can accept a class yield:
    // <body class="@yield('body-class')"> then in this file @section('body-class', 'login-page-body')
    // For simplicity, the CSS provided tries to target body directly or assumes it's wrapped.
    // If the background image isn't showing correctly, ensure the path in CSS is correct and
    // that your main layout doesn't have a conflicting background.
    // One way to ensure the body style applies if you can't modify layouts.app.blade.php:
    if (document.querySelector('.custom-login-container')) { // Check if we are on the login page
        document.body.style.backgroundImage = `url("{{ asset('images/MacBook Air - 1.png') }}")`;
        document.body.style.backgroundSize = 'cover';
        document.body.style.backgroundRepeat = 'no-repeat';
        document.body.style.backgroundPosition = 'center center';
        document.body.style.display = 'flex';
        document.body.style.alignItems = 'center';
        document.body.style.justifyContent = 'center';
        document.body.style.minHeight = '100vh';
        // Potentially remove padding from a main content wrapper if your layout has one
        const mainContent = document.querySelector('.content') || document.querySelector('main');
        if (mainContent) {
            mainContent.style.padding = '0';
        }
    }
</script>
@endpush

@push('styles')
{{-- This is another way to add the styles if your layout supports @stack('styles') in the head --}}
{{-- <link href="{{ asset('css/custom-login-styles.css') }}" rel="stylesheet"> --}}
{{-- @endpush --}} --}}