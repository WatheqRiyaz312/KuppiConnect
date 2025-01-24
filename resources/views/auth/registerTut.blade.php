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

    <div class="bg-white p-3 rounded-lg shadow-md w-full max-w-xs transition-transform transform hover:scale-105">
        <h2 class="text-sm font-semibold text-center text-blue-600 mb-3">Create an Account</h2>

        <!-- Show errors if any -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('registerTut') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Name -->
            <div class="mb-2">
                <label for="name" class="text-xs font-medium text-blue-500">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                    class="mt-1 block w-full p-1.5 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Email -->
            <div class="mb-2">
                <label for="email" class="text-xs font-medium text-blue-500">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    class="mt-1 block w-full p-1.5 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Password -->
            <div class="mb-2">
                <label for="password" class="text-xs font-medium text-blue-500">Password</label>
                <input type="password" id="password" name="password" required
                    class="mt-1 block w-full p-1.5 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Gender -->
            <div class="mb-2">
                <label for="gender" class="text-xs font-medium text-blue-500">Gender</label>
                <select id="gender" name="gender" required 
                    class="mt-1 block w-full p-1.5 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
                    <option value="">Select Gender</option>
                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <!-- Phone Number -->
            <div class="mb-2">
                <label for="phone_number" class="text-xs font-medium text-blue-500">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required 
                    class="mt-1 block w-full p-1.5 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Profile Picture -->
            <div class="mb-2">
                <label for="image" class="text-xs font-medium text-blue-500">Profile Picture</label>
                <input type="file" id="image" name="image" required 
                    class="mt-1 block w-full p-1.5 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Department -->
            <div class="mb-2">
                <label for="department" class="text-xs font-medium text-blue-500">Department</label>
                <select id="department" name="department" required 
                    class="mt-1 block w-full p-1.5 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">
                    <option value="">Select Department</option>
                    <option value="Computer Science" {{ old('department') == 'Computer Science' ? 'selected' : '' }}>Computer Science</option>
                    <option value="Cyber Security" {{ old('department') == 'Cyber Security' ? 'selected' : '' }}>Cyber Security</option>
                    <option value="Software Engineering" {{ old('department') == 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                </select>
            </div>

            <!-- Bio -->
            <div class="mb-2">
                <label for="bio" class="text-xs font-medium text-blue-500">Bio</label>
                <textarea id="bio" name="bio" rows="2" required 
                    class="mt-1 block w-full p-1.5 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">{{ old('bio') }}</textarea>
            </div>

            <!-- Achievements -->
            <div class="mb-2">
                <label for="achievements" class="text-xs font-medium text-blue-500">Achievements</label>
                <textarea id="achievements" name="achievements" rows="2" required 
                    class="mt-1 block w-full p-1.5 text-xs border border-gray-300 rounded-lg shadow-sm focus:ring-1 focus:ring-blue-500 focus:outline-none">{{ old('achievements') }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="mb-2">
                <button type="submit" 
                    class="w-full py-1.5 text-xs bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200">
                    Register
                </button>
            </div>
        </form>
    </div>

</body>
</html>
