<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - KuppiConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom gradient background for the page */
        body {
            background: linear-gradient(135deg, #6EE7B7, #3B82F6);
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center">

    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm transition-transform transform hover:scale-105">
        <h2 class="text-2xl font-semibold text-center text-blue-600 mb-6">Login to Tutor-Dashboard</h2>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('tutorloginSubmit') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-md font-medium text-blue-500">Email</label>
                <input id="email" type="email" name="email" required autofocus
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-md font-medium text-blue-500">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mb-4">
                <button type="submit" 
                    class="w-full py-3 bg-blue-600 text-white rounded-lg text-lg font-semibold hover:bg-blue-700 transition duration-200">
                    Log In
                </button>
            </div>
        </form>

        <!-- Sign Up Prompt -->
        <div class="text-center">
            <p class="text-blue-500 text-md">Don't have an account? 
                <a href="{{ route('registerFormTutor') }}" class="text-blue-600 font-semibold hover:underline">Sign Up</a>
            </p>
        </div>
    </div>

</body>
</html>
