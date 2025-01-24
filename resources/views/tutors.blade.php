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

<!-- Page Container -->
<div class="container mx-auto px-4">
    <!-- Header Section -->
    <header class="py-8 text-center">
        <h1 class="text-3xl font-bold">Explore Tutors</h1>
        <p class="text-gray-600">A community of volunteer tutors</p>
    </header>

    <!-- Main Content Section -->
    <div class="space-y-6">

          <!-- Main Content Area with Sidebar and Tutor Cards -->
          <div class="flex space-x-8">
            <!-- Subjects Sidebar -->
            <aside class="w-1/4">
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-700 hover:text-blue-500">Computer Science</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-500">Cyber Security</a></li>
                    <li><a href="#" class="text-gray-700 hover:text-blue-500">Software Engineering</a></li>
                </ul>
            </aside>

            <!-- Tutors Section -->
            <main class="flex-1">
               <!-- Tutor Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($tutors as $tutor)
                        <!-- Tutor Card -->
                        <div class="bg-white shadow-md rounded-lg p-4" x-data="{ openForm: false }">
                            <img src="{{ $tutor->image ? asset('images/' . $tutor->image) : '' }}" alt="" class="w-32 h-32 object-cover rounded-full">

                            <div class="mt-4">
                                <h3 class="text-lg font-bold">{{ $tutor->name }}</h3>
                                <p class="text-gray-600">{{ ucfirst($tutor->gender) }}</p>
                                <p class="text-gray-600">{{ $tutor->department }}</p>
                            </div>
                            
                            <div class="mt-2 flex gap-2">
                                <a href="{{ route('tutorProfile', $tutor->tutor_id) }}" class="flex-1 bg-blue-500 text-center text-white py-2 rounded-md hover:bg-blue-400">View Profile</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>
        </div>
    </div>
</div>

<br>
<!-- Footer -->
<footer style="background-color: #8AB6D7; width: 100%;">
  <div class="px-6 py-8 sm:px-12 md:px-20 max-w-full mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 sm:gap-12 md:gap-16">
    
    <!-- About KuppiConnect -->
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
    
    <!-- Company Information -->
    <div class="space-y-2 sm:space-y-4">
      <h4 class="text-lg sm:text-xl font-semibold text-black">Company</h4>
      <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">About Us</p>
      <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Our Mission</p>
      <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Blog</p>
    </div>
    
    <!-- Legal Information -->
    <div class="space-y-2 sm:space-y-4">
      <h4 class="text-lg sm:text-xl font-semibold text-black">Legal</h4>
      <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">FAQs</p>
      <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Terms of Service</p>
      <p class="text-white text-sm sm:text-base cursor-pointer hover:text-gray-300">Privacy Policy</p>
    </div>
    
    <!-- Resources Section -->
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
</html>
