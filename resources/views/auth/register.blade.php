<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EventMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.0.0/dist/full.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="card w-full max-w-md p-8 scroll-m-0">
        <h2 class="text-2xl font-bold text-center mb-6">Create Your Account</h2>

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Full Name -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Full Name</span>
                </label>
                <input type="text" name="full_name" placeholder="Your full name" class="input input-bordered w-full" required>
            </div>

            <!-- Email -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" placeholder="Your email" class="input input-bordered w-full" required>
            </div>

            <!-- Phone -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Mobile Number</span>
                </label>
                <input type="text" name="phone" placeholder="Your phone number" class="input input-bordered w-full" required>
            </div>

            <!-- Password -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" placeholder="Enter password" class="input input-bordered w-full" required>
            </div>

            <!-- Confirm Password -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Confirm Password</span>
                </label>
                <input type="password" name="password_confirmation" placeholder="Confirm password" class="input input-bordered w-full" required>
            </div>

            <!-- Submit Button -->
            <div class="form-control mt-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
        </form>

        <!-- Already have account -->
        <p class="text-center text-sm mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="link link-primary font-semibold">Login here</a>
        </p>
    </div>

</body>
</html>