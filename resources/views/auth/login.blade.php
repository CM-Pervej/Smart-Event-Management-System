<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EventMS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.0.0/dist/full.css" rel="stylesheet">
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="card w-full max-w-md bg-white p-8">
        <h2 class="text-2xl font-bold text-center mb-6">Login to Your Account</h2>

        <form action="/login" method="POST" class="space-y-4">
            <!-- Email -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" placeholder="Enter your email" class="input input-bordered w-full" required>
            </div>

            <!-- Password -->
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" placeholder="Enter your password" class="input input-bordered w-full" required>
                <label class="label">
                    <a href="/forgot-password" class="label-text-alt link link-hover">Forgot password?</a>
                </label>
            </div>

            <!-- Remember Me -->
            <div class="form-control">
                <label class="cursor-pointer label">
                    <input type="checkbox" class="checkbox checkbox-primary" name="remember">
                    <span class="label-text ml-2">Remember me</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div class="form-control mt-4">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
        </form>

        <!-- Divider -->
        <div class="divider my-6">OR</div>

        <!-- Social Login Buttons (Optional) -->
        <div class="flex gap-4 justify-center">
            <button class="btn btn-outline btn-sm w-1/2">Google</button>
            <button class="btn btn-outline btn-sm w-1/2">Facebook</button>
        </div>

        <!-- Register Link -->
        <p class="text-center text-sm mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="link link-primary font-semibold">Register here</a>
        </p>
    </div>

</body>
</html>