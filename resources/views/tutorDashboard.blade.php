<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Explore Tutors</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Navbar -->
<nav class="bg-blue-400 p-4" x-data="{ open: false }">
    <div class="flex items-center justify-between">
        <!-- Logo -->
        <div class="text-2xl font-bold text-white">
            KuppiConnect
        </div>

        <!-- Hamburger Icon - Visible on small screens -->
        <div class="sm:hidden">
            <button @click="open = !open" class="text-white focus:outline-none">
                <!-- Icon changes based on the 'open' state -->
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Links - Centered on all screen sizes -->
        <div class="hidden sm:flex justify-center space-x-6 text-white font-semibold w-full">
            <a href="{{ route('index') }}" class="text-white hover:underline">Home</a>
            <a href="{{ route('tutors') }}" class="text-white hover:underline">View Tutors</a>
            <a href="{{ route('login') }}" class="text-white hover:underline">Student Login</a>
            <a href="{{ route('tutorloginSubmit') }}" class="text-white hover:underline">Tutor Login</a>
        </div>
         <!-- Show Logout Button if Tutor is Authenticated -->
         <div class="hidden sm:flex space-x-4 text-white">
            @auth('tutor')
                <!-- Show logout button only if tutor is authenticated -->
                <form action="{{ route('tutor.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white font-bold hover:underline">Logout</button>
                </form>
            @endauth
        </div>
    </div>

    <!-- Mobile Menu - Visible when open is true -->
    <div x-show="open" class="sm:hidden">
        <div class="flex flex-col bg-blue-500 text-white p-4 space-y-2">
            <a href="{{ route('index') }}" class="text-white hover:underline">Home</a>
            <a href="{{ route('tutors') }}" class="text-white hover:underline">View Tutors</a>
            <a href="{{ route('login') }}" class="text-white hover:underline">Student Login</a>
            <a href="{{ route('tutorloginSubmit') }}" class="text-white hover:underline">Tutor Login</a>
        </div>
    </div>
</nav>

<!-- Main Content -->
<div class="container mx-auto mt-10">
        <div class="bg-white shadow-lg rounded-lg p-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Profile Section -->
            <div class="col-span-1 lg:col-span-1 flex flex-col items-center bg-gray-50 p-6 rounded-lg border shadow-sm">
                <img src="{{ $tutor->image ? asset('images/' . $tutor->image) : '' }}" alt="" class="w-32 h-32 rounded-full object-cover">
                <h3 class="text-2xl font-bold mt-4">{{ $tutor->name }}</h3>
                <p class="text-gray-600">{{ ucfirst($tutor->gender) }}</p>
                <div class="flex items-center justify-center space-x-6 mt-4">
                <a href="mailto:{{ $tutor->email }}" class="text-gray-500 hover:text-gray-600"><i class="fas fa-envelope"></i> {{ $tutor->email }}</a>
                <a href="tel:{{ $tutor->phone_number }}" class="text-gray-500 hover:text-gray-600"><i class="fas fa-phone-alt"></i> {{ $tutor->phone_number }}</a>
                </div>
            </div>

            <!-- Bio and Achievements Section -->
            <div class="col-span-1 lg:col-span-2 space-y-6">
                <div class="bg-gray-50 p-6 rounded-lg border shadow-sm">
                    <h4 class="text-xl font-semibold text-blue-600">Bio</h4>
                    <p class="text-gray-700">{{ $tutor->bio ?? 'No bio available.' }}</p>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg border shadow-sm">
                    <h4 class="text-xl font-semibold text-blue-600">Achievements</h4>
                    <p class="text-gray-700">{{ $tutor->achievements ?? 'No achievements available.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Module Form Section -->
<div class="container mx-auto mt-6 bg-white p-6 rounded-lg border shadow-sm">
    <h4 class="text-xl font-semibold text-blue-600">Add New Module</h4>
    <form method="POST" action="{{ route('tutorAddModule') }}" enctype="multipart/form-data">
        @csrf
        <div class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-600">Module Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-600">Module Description</label>
                <textarea name="description" id="description" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required></textarea>
            </div>
            <div>
                <label for="date" class="block text-sm font-medium text-gray-600">Day</label>
                <select name="date" id="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="" disabled selected>Select a day</option>
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>
            <div>
                <label for="time" class="block text-sm font-medium text-gray-600">Module Time</label>
                <input type="time" name="time" id="time" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="resources" class="block text-sm font-medium text-gray-600">Resources</label>
                <input type="file" name="resources[]" id="resources" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" multiple>

            </div>
            <button type="submit" class="w-full mt-4 bg-blue-600 text-white p-2 rounded-md">Add Module</button>
        </div>
    </form>
</div>

<!-- Display Modules Section -->
<div class="container mx-auto mt-6 bg-gray-50 p-6 rounded-lg border shadow-sm">
    <h4 class="text-xl font-semibold text-blue-600">Your Modules</h4>
    @if($tutor->modules && $tutor->modules->count() > 0)
        <ul class="list-disc pl-6 text-gray-700">
            @foreach($tutor->modules as $module)
                <li class="mb-4 p-4 border border-gray-300 rounded-lg shadow-sm">
                    <span class="font-semibold text-lg">{{ $module->name }}</span><br>
                    <span class="text-gray-600">{{ $module->description }}</span><br>
                    
                    <!-- Convert the 'date' to day of the week using Carbon -->
                    @php
                        $dayOfWeek = \Carbon\Carbon::createFromFormat('d-m-Y', $module->date)->format('l');
                    @endphp
                    <!-- Make the day and time normal text (no faded color) -->
                    <span class="text-black">Day: {{ $dayOfWeek }}</span> | 
                    <span class="text-black">Time: {{ $module->time }}</span><br>
                    
                    @if($module->resources)
                        <div class="mt-2 space-y-2">
                            @foreach(json_decode($module->resources) as $resource)
                                <a href="{{ asset('storage/' . $resource) }}" target="_blank" class="text-blue-600 hover:underline">
                                    View Resource
                                </a>
                            @endforeach
                        </div>
                    @endif

                    <div class="mt-3">
                        <hr class="border-t-2 border-gray-200">
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-600">You have not added any modules yet.</p>
    @endif
</div>


<!-- Footer -->
 <br>
<footer style="background-color: #8AB6D7; width: 100%;">
    <div class="px-6 py-8 sm:px-12 md:px-20 max-w-full mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 sm:gap-12 md:gap-16">
        <div class="space-y-4">
            <h3 class="text-xl sm:text-2xl font-bold text-black">KuppiConnect</h3>
            <p class="text-white text-sm sm:text-base">Empowering university students through personalized learning and mentorship.</p>
            <p class="text-white text-sm sm:text-base">Follow us on social media for updates and educational resources.</p>
            <div class="flex space-x-4 text-2xl sm:text-3xl text-white">
                <a href="https://facebook.com" class="hover:text-blue-800"><i class="fab fa-facebook-square"></i></a>
                <a href="https://twitter.com" class="hover:text-blue-500"><i class="fab fa-twitter-square"></i></a>
                <a href="https://instagram.com" class="hover:text-pink-500"><i class="fab fa-instagram"></i></a>
                <a href="https://youtube.com" class="hover:text-red-500"><i class="fab fa-youtube"></i></a>
            </div>
            <p class="text-white text-sm sm:text-base">Contact Us</p>
            <p class="text-white text-sm sm:text-base">0771234567</p>
            <p class="text-white text-sm sm:text-base"><a href="mailto:kuppiconnect@gmail.com" class="hover:underline">Mail Us</a></p>
        </div>
        <div class="space-y-2 sm:space-y-4">
            <h4 class="text-lg sm:text-xl font-semibold text-black">Company</h4>
            <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">About Us</p>
            <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Our Mission</p>
            <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Blog</p>
        </div>
        <div class="space-y-2 sm:space-y-4">
            <h4 class="text-lg sm:text-xl font-semibold text-black">Legal</h4>
            <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">FAQs</p>
            <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Terms of Service</p>
            <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Privacy Policy</p>
        </div>
        <div class="space-y-2 sm:space-y-4">
            <h4 class="text-lg sm:text-xl font-semibold text-black">Resources</h4>
            <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Tutoring Resources</p>
            <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Help Center</p>
            <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Partnerships</p>
        </div>
    </div>
    <div class="bg-blue-500 text-gray-200 text-center py-4">
        <p class="text-sm sm:text-base">&copy; 2024 KuppiConnect. All rights reserved.</p>
    </div>
</footer>

</body>
</html>
