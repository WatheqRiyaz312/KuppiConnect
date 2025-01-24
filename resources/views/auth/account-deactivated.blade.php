<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Account Deactivated</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-blue-50">
    <!-- Header -->
    <header class="bg-red-600 text-white shadow">
        <div class="container mx-auto p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">KuppiConnect</h1>
            <nav>
                <a href="{{ route('index') }}" class="text-white hover:text-gray-200 px-3">Home</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto py-20">
        <div class="text-center bg-white shadow-lg rounded-lg p-8 max-w-md mx-auto">
            <h1 class="text-3xl font-bold text-red-500 mb-6">Account Deactivated</h1>
            <p class="text-gray-700 mb-6">
                Your account has been deactivated. If you believe this is a mistake, please contact support.
            </p>
            <a href="{{ url('/') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded transition">
                Go to Homepage
            </a>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 text-center py-4 mt-8">
        <p>&copy; {{ date('Y') }} KuppiConnect. All rights reserved.</p>
    </footer>
</body>
</html>
