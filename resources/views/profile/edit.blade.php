<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>KuppiConnect</title>
    @vite('resources/css/app.css') <!-- Ensure Tailwind CSS is configured -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-800">
<!-- Navbar -->
<nav class="bg-blue-500 p-4" x-data="{ open: false }">
    <div class="flex items-center justify-between">
        <div class="text-2xl font-bold text-white">
            KuppiConnect
        </div>
        <div class="hidden lg:flex space-x-8 mx-auto">
            <!-- Home Link -->
            <a href="{{ url('/') }}" class="rounded-md px-3 py-2 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-white">
                Home
            </a>

            <!-- Profile Link -->
            <a href="{{ url('/profile') }}" class="rounded-md px-3 py-2 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-white">
                Profile
            </a>

            <!-- Log Out Form -->
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="rounded-md px-3 py-2 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-white">
                    Log Out
                </button>
            </form>
        </div>
        <button id="hamburger-icon" class="lg:hidden text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <!-- Mobile Navbar -->
        <div id="mobile-navbar" class="hidden fixed inset-0 bg-black bg-opacity-90 flex flex-col items-center space-y-6 z-50 lg:hidden">
            <button id="close-mobile-navbar" class="absolute top-4 right-4 text-white text-3xl focus:outline-none">&times;</button>
            <a href="{{ url('/') }}" class="text-white text-lg hover:underline">Home</a>
            <a href="{{ url('/profile') }}" class="text-white text-lg hover:underline">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-white text-lg hover:underline">Log Out</button>
            </form>
        </div>
    </div>
</nav>

<!-- Profile Page -->
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-6 bg-blue-50 border-l-4 border-blue-500 shadow sm:rounded-lg">
            <h2 class="font-semibold text-xl text-blue-800">
                {{ __('Update Profile Information') }}
            </h2>
            <div class="mt-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-6 bg-blue-50 border-l-4 border-blue-500 shadow sm:rounded-lg">
            <h2 class="font-semibold text-xl text-blue-800">
                {{ __('Update Password') }}
            </h2>
            <div class="mt-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-6 bg-blue-50 border-l-4 border-blue-500 shadow sm:rounded-lg">
            <h2 class="font-semibold text-xl text-blue-800">
                {{ __('Delete Account') }}
            </h2>
            <div class="mt-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>

</body>
</html>
