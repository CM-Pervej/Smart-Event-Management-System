<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register &mdash; EventMS</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet">

  <!-- Google Fonts (same as login) -->
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,600;9..144,700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- Shared stylesheet -->
  <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="side">
        <!-- LEFT PANEL — Monkey + Branding -->
        <div class="left-panel">
            @include('auth.monkey')
            <div class="brand">
                <span class="brand-tag">Event Management</span>
                <h1>Event<span>MS</span></h1>
                <p>Join thousands managing events smarter every day.</p>
            </div>
        </div>

        <!-- RIGHT PANEL — Register Form -->
        <div class="right-panel">
            <div class="form-header">
                <h2>Create account</h2>
                <p>Fill in your details to get started for free</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-error mb-3 flex flex-col gap-1">
                    @foreach ($errors->all() as $error)
                        <p class="text-sm"> {{ $error }} </p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('users.register') }}" method="POST">
                @csrf
                <!-- Full Name -->
                <div class="field">
                    <label class="field-label" for="name">Full name</label>
                    <div class="input-wrap">
                        <svg class="ico" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"> 
                            <circle cx="12" cy="8" r="4"/> 
                            <path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/> 
                        </svg>
                        <input type="text" id="name" name="name" placeholder="Dr. Md. Nasim Adnan" autocomplete="off" required value="{{ old('name') }}">
                    </div>
                </div>

                <!-- Mobile Number -->
                <div class="field">
                    <label class="field-label" for="phone">Mobile Numer</label>
                    <div class="input-wrap">
                        <svg class="ico" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="7" y="2" width="10" height="20" rx="2" ry="2"/>
                            <line x1="11" y1="18" x2="13" y2="18"/>
                        </svg>
                        <input type="text" id="phone" name="phone" placeholder="+880 1*** ******" autocomplete="off" required value="{{ old('phone') }}">
                    </div>
                </div>

                <!-- Email -->
                <div class="field">
                    <label class="field-label" for="email">Email address</label>
                    <div class="input-wrap">
                        <svg class="ico" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"> 
                            <rect x="2" y="4" width="20" height="16" rx="2"/> 
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/> 
                        </svg>
                        <input type="email" id="email" name="email" placeholder="you@example.com" autocomplete="off" required  value="{{ old('email') }}">
                    </div>
                </div>

                <!-- Password -->
                <div class="field">
                    <label class="field-label" for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="ico" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"> 
                            <rect x="3" y="11" width="18" height="11" rx="2"/> 
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"/> 
                        </svg>
                        <input type="password" id="password" name="password" placeholder="Create a strong password" autocomplete="new-password" required>
                        <button type="button" class="eye-toggle" id="toggle-pw" aria-label="Toggle password visibility">
                            <svg id="eye-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                    <!-- Password strength indicator -->
                    <div class="strength-bar"><div class="strength-bar-fill" id="strength-fill"></div></div>
                    <div class="strength-label" id="strength-label"></div>
                </div>

                <!-- Confirm Password -->
                <div class="field">
                    <label class="field-label" for="password_confirmation">Confirm password</label>
                    <div class="input-wrap">
                        <svg class="ico" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                        </svg>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repeat your password" autocomplete="new-password" required>
                        <button type="button" class="eye-toggle" id="toggle-confirm" aria-label="Toggle confirm password visibility">
                            <svg id="eye-icon-confirm" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <label class="terms">
                    <input type="checkbox" name="terms" required>
                    <span> I agree to the <a href="/terms">Terms of Service</a> and <a href="/privacy">Privacy Policy</a> </span>
                </label>

                <button type="submit" class="btn-login">Create Account &rarr;</button>
            </form>

            <div class="divider"><span>OR SIGN UP WITH</span></div>

            <!-- Social register -->
            <div class="socials">
            <button class="btn-social" type="button">
                <svg width="16" height="16" viewBox="0 0 24 24">
                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
                Google
            </button>
            <button class="btn-social" type="button">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="#1877F2">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
                Facebook
            </button>
            </div>

            <p class="login-link">
            Already have an account?
            <a href="<?php echo route('login'); ?>">Sign in here</a>
            </p>

        </div>
    </div>

    <!-- Core monkey animation (handles #email and #password) -->
    <script src="{{ asset('assets/js/monkey.js') }}"></script>
</body>
</html>