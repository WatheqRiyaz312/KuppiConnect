<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom gradient background for the page */
        body {
            background: linear-gradient(135deg, #6EE7B7, #3B82F6);
        }
    </style>
</head>
<body class="h-screen flex items-center justify-center">

    <div class="bg-white p-4 rounded-xl shadow-lg w-full max-w-xs transition-transform transform hover:scale-105">
        <h2 class="text-2xl font-semibold text-center text-blue-600 mb-4">Create an Account</h2>
        <p class="text-center text-gray-600 mb-4 text-sm">Sign up to get started with our platform.</p>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="block text-sm font-medium text-blue-500">Name</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('name')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="block text-sm font-medium text-blue-500">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('email')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gender -->
            <div class="mb-3">
                <label for="gender" class="block text-sm font-medium text-blue-500">Gender</label>
                <select id="gender" name="gender" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
                @error('gender')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Bio -->
            <div class="mb-3">
                <label for="bio" class="block text-sm font-medium text-blue-500">Bio</label>
                <textarea id="bio" name="bio" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ old('bio') }}</textarea>
                @error('bio')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Profile Image -->
            <div class="mb-3">
                <label for="image" class="block text-sm font-medium text-blue-500">Profile Image</label>
                <input id="image" type="file" name="image"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('image')
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

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="block text-sm font-medium text-blue-500">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                @error('password_confirmation')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mb-3">
                <button type="submit"
                    class="w-full py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition duration-200">
                    Register
                </button>
            </div>
        </form>
    </div>

</body>
</html>
