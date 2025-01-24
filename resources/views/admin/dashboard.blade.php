<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>KuppiConnect Admin Dashboard</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gradient-to-b from-blue-50 to-blue-200 min-h-screen text-gray-800">

<!-- Navbar -->
<nav class="bg-blue-600 shadow-lg">
    <div class="container mx-auto px-4 flex justify-between items-center py-4">
        <!-- Brand -->
        <div class="text-2xl font-extrabold text-white">
            <i class="fas fa-graduation-cap mr-2"></i>KuppiConnect
        </div>

        <!-- Desktop Links -->
        <div class="hidden lg:flex space-x-6">
            <a href="{{ url('/') }}" class="text-white font-semibold hover:text-gray-200 transition">Home</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="text-white font-semibold hover:text-gray-200 transition">Log Out</button>
            </form>
        </div>

        <!-- Mobile Hamburger -->
        <button @click="open = !open" x-data="{ open: false }" class="lg:hidden text-white">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>

<!-- Dashboard Header -->
<header class="py-10 bg-gradient-to-r from-blue-500 to-blue-600 shadow-lg">
    <div class="container mx-auto text-center text-white">
        <h1 class="text-4xl font-bold mb-2">Admin Dashboard</h1>
        <p class="text-lg font-light">Monitor and manage all tutors, students, and modules</p>
    </div>
</header>

<!-- Dashboard Content -->
<main class="container mx-auto py-10 px-4">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Active Tutors Card -->
        <a href="{{ route('admin.tutors') }}" class="block transform hover:scale-105 transition-transform duration-300">
            <div class="bg-gradient-to-br from-purple-500 to-purple-700 text-white rounded-lg shadow-lg p-8 text-center">
                <i class="fas fa-user-tie text-5xl mb-4"></i>
                <h3 class="text-2xl font-semibold mb-2">Active Tutors</h3>
                <p class="text-4xl font-bold">{{ $activeTutors }}</p>
            </div>
        </a>

        <!-- Active Students Card -->
        <a href="{{ route('admin.students') }}" class="block transform hover:scale-105 transition-transform duration-300">
            <div class="bg-gradient-to-br from-green-500 to-green-700 text-white rounded-lg shadow-lg p-8 text-center">
                <i class="fas fa-user-graduate text-5xl mb-4"></i>
                <h3 class="text-2xl font-semibold mb-2">Active Students</h3>
                <p class="text-4xl font-bold">{{ $activeStudents }}</p>
            </div>
        </a>

        <!-- Modules Card -->
        <a href="{{ route('admin.modules') }}" class="block transform hover:scale-105 transition-transform duration-300">
            <div class="bg-gradient-to-br from-blue-400 to-blue-600 text-white rounded-lg shadow-lg p-8 text-center">
                <i class="fas fa-book text-5xl mb-4"></i>
                <h3 class="text-2xl font-semibold mb-2">Modules</h3>
                <p class="text-4xl font-bold">{{ $modules }}</p>
            </div>
        </a>
    </div>
</main>

<footer class="bg-blue-600 text-white py-6 mt-10">
    <div class="container mx-auto text-center">
        <p>&copy; {{ date('Y') }} KuppiConnect. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
