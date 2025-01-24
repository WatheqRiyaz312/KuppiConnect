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

        @if (session('message'))
    <div class="fixed top-16 left-1/2 transform -translate-x-1/2 bg-green-200 text-green-800 p-4 rounded-lg shadow-lg max-w-md w-full z-50">
        <div class="flex items-center">
            <!-- Message Icon -->
            <div class="mr-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <!-- Message Text -->
            <div>
                <p>{{ session('message') }}</p>
            </div>
        </div>
    </div>
@endif

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

<!-- Main Banner Section -->
<section class="text-center py-10 bg-white">
    <h1 class="text-3xl font-bold mt-4">Welcome to Kuppi Culture</h1>
    <p class="text-xl text-gray-600 mt-2">Empowering University Learning</p>
    <img src="{{ asset('images/home.avif') }}" alt="Graduation Illustration" class="mx-auto" style="width: 500px;">
</section>

<!-- About Us Section -->
<section class="text-center py-8 px-4 bg-blue-50">
    <h2 class="text-2xl font-semibold mb-4">About Us</h2>
    <p class="text-gray-600 max-w-md mx-auto">
        Kuppi Connect is a platform dedicated to empowering university students by providing easy access to peer tutoring, personalized study sessions, and academic resources. Our mission is to support students in their educational journey through collaborative learning and expert guidance.
    </p>
</section>

<!-- Key Features Cards Section -->
<section class="py-12 bg-white text-center">
    <h2 class="text-2xl font-semibold mb-8">Our Key Features</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <div class="bg-blue-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Personalized Tutoring</h3>
            <p class="text-gray-700">Get one-on-one tutoring sessions tailored to your learning needs and academic goals.</p>
        </div>
        <div class="bg-blue-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Expert Tutors</h3>
            <p class="text-gray-700">Our tutors are experienced professionals in various fields, ready to guide you to success.</p>
        </div>
        <div class="bg-blue-100 p-6 rounded-lg shadow-lg">
            <h3 class="text-xl font-semibold mb-4">Flexible Scheduling</h3>
            <p class="text-gray-700">Choose the time slots that best fit your schedule, ensuring convenient and effective learning.</p>
        </div>
    </div>
</section>

<!-- Sign Up Section -->
<section class="text-center py-8 bg-blue-50 border-t-2 border-blue-100">
    <h2 class="text-2xl font-bold text-red-800 italic mb-6">Sign Up for Free as a Student to learn more!</h2>

    <!-- Student Sign-Up Button -->
    <div class="bg-white shadow-lg rounded-lg max-w-xl mx-auto py-6 px-8 mb-6 mt-10">
        <h3 class="text-xl font-bold text-blue-600 text-center mb-2">I am a Student</h3>
        <p class="text-gray-600 text-center mb-4">Get help with homework, improve your grades, and ace your exams with personalized tutoring.</p>
        
        <!-- Enhanced Sign-Up Button -->
        <a href="{{ route('login') }}" class="block text-center bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105 hover:shadow-2xl">
            Click here to Sign Up
        </a>
    </div>
</section>

<section class="text-center py-8 bg-blue-50 border-t-2 border-blue-100">
    <h2 class="text-2xl font-bold text-red-800 italic mb-6">Sign Up for Free as a Tutor to Help Others!</h2>

    <!-- Tutor Sign-Up Button -->
    <div class="bg-white shadow-lg rounded-lg max-w-xl mx-auto py-6 px-8 mb-6 mt-10">
        <h3 class="text-xl font-bold text-blue-600 text-center mb-2">I am a Tutor</h3>
        <p class="text-gray-600 text-center mb-4">Share your expertise, help students excel, and earn money by tutoring online.</p>
        
        <!-- Enhanced Sign-Up Button -->
        <a href="{{ route('tutorDashboardLogin') }}" class="block text-center bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 text-white font-semibold py-3 px-6 rounded-lg shadow-lg transition duration-300 transform hover:scale-105 hover:shadow-2xl">
            Click here to Sign Up
        </a>
    </div>
</section>



<!-- Footer -->
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
