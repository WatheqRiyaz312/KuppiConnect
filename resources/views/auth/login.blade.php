<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom gradient background for the page */
        body {
            background: linear-gradient(135deg, #6EE7B7, #3B82F6);
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center">

    <div class="bg-white p-4 rounded-lg shadow-md w-full max-w-xs transition-transform transform hover:scale-105">
        <h2 class="text-2xl font-semibold text-center text-blue-600 mb-4">Login</h2>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <!-- Check if user is authenticated -->
        @auth
            @if (auth()->user()->role == 'admin')
                <p class="text-green-600 mb-4">Welcome Admin!</p>
                <a href="{{ url('admin/dashboard') }}" 
                    class="w-full py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition duration-200 mb-4">
                    Go to Admin Dashboard
                </a>
            @else
                <p class="text-green-600 mb-4">Welcome {{ auth()->user()->name }}!</p>
                <a href="{{ url('/dashboard') }}" 
                    class="w-full py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition duration-200 mb-4">
                    Go to Dashboard
                </a>
            @endif
        @else
            <!-- Display the login form if user is not authenticated -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                 <!-- Hidden input to redirect after login -->
    <input type="hidden" name="redirectTo" value="{{ url()->previous() }}">

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="block text-sm font-medium text-blue-500">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('email')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="block text-sm font-medium text-blue-500">Password</label>
                    <input id="password" type="password" name="password" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('password')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox" name="remember" 
                        class="h-4 w-4 text-blue-500 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                    <label for="remember_me" class="ml-2 text-sm text-blue-500">Remember Me</label>
                </div>

                <!-- Actions -->
                <div class="flex justify-between items-center mb-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" 
                            class="text-xs text-blue-500 hover:underline">Forgot Password?</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="mb-4">
                    <button type="submit" 
                        class="w-full py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition duration-200">
                        Log In
                    </button>
                </div>
            </form>

            <!-- Sign Up Prompt -->
            <div class="text-center">
                <p class="text-blue-500 text-sm">Don't have an account? 
                    <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Sign Up</a>
                </p>
            </div>
        @endauth
    </div>
</body>
</html>
