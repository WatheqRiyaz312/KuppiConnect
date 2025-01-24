<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tutors</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-blue-50">
    <!-- Header -->
    <header class="bg-blue-600 text-white shadow">
        <div class="container mx-auto p-4 flex justify-between items-center">
            <h1 class="text-xl font-bold">KuppiConnect</h1>
            <nav>
                @if(auth()->check() && auth()->user()->usertype === 'admin')
                    <!-- Admin Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="text-white hover:text-gray-200 px-3">Dashboard</a>
                @else
                    <!-- User Dashboard -->
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-gray-200 px-3">Dashboard</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:text-gray-200 px-3">Logout</button>
                </form>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto py-8">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg shadow-lg px-6 py-4 mb-6">
            <h1 class="text-3xl font-bold">Tutors</h1>
            <form action="{{ route('admin.tutors') }}" method="GET" class="flex mt-4 sm:mt-0">
                <input
                    type="text"
                    name="search"
                    placeholder="Search Tutors..."
                    value="{{ $query ?? '' }}"
                    class="border border-gray-300 rounded-l p-2 w-full sm:w-auto"
                />
                <button
                    type="submit"
                    class="bg-white text-blue-600 px-4 py-2 rounded-r hover:bg-gray-100 transition"
                >
                    Search
                </button>
            </form>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6 shadow-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tutors Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Email</th>
                        <th class="px-6 py-3 text-left">Department</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tutors as $tutor)
                        <tr class="hover:bg-gray-100">
                            <td class="border px-6 py-4">{{ $tutor->name }}</td>
                            <td class="border px-6 py-4">{{ $tutor->email }}</td>
                            <td class="border px-6 py-4">{{ $tutor->department }}</td>
                            <td class="border px-6 py-4">
                                <form action="{{ route('admin.tutors.destroy', $tutor->tutor_id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded transition"
                                        onclick="return confirm('Are you sure you want to delete this tutor?')"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center border px-6 py-4 text-gray-500">No tutors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-200 text-center py-4 mt-8">
        <p>&copy; {{ date('Y') }} KuppiConnect. All rights reserved.</p>
    </footer>
</body>
</html>
