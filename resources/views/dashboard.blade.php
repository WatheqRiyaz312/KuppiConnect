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
<nav class="bg-blue-400 p-4" x-data="{ open: false }">
    <div class="flex items-center justify-between">
        <div class="text-2xl font-bold text-white">
            KuppiConnect
        </div>
        <div class="hidden lg:flex space-x-8 mx-auto">
            <!-- Home Link -->
            <a href="{{ url('/') }}" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-[#FF2D20]">Home</a>

            <!-- Profile Link -->
            <a href="{{ url('/profile') }}" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-[#FF2D20]">Profile</a>

            <!-- Log Out Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-white/70 focus:outline-none focus-visible:ring-[#FF2D20]">
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
            <a href="{{ url('/') }}" class="text-white text-sm font-normal hover:underline">Home</a>
            <a href="{{ url('/profile') }}" class="text-white text-sm font-normal hover:underline">Profile</a>
            <form method="POST" action="{{ route('logout') }}" class="text-white text-sm font-normal hover:underline">
                @csrf
                <button type="submit" class="text-white text-sm font-normal hover:underline">Log Out</button>
            </form>
        </div>
    </div>
</nav>

 <!-- Content -->
 <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in as a Student!") }}
                </div>
            </div>
        </div>

        <!-- Image Section -->
    <div class="flex justify-center mt-8">
        <img src="{{ asset('images/tutoring.jpg') }}" alt="Tutoring Image" class="w-full max-w-4xl rounded-lg shadow-lg">
    </div>
    
    </div>

</body>
</html>