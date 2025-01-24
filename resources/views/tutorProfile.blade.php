<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>View Tutor Profile</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Navbar -->
<nav class="bg-blue-400 p-4" x-data="{ open: false }">
    <div class="flex items-center justify-between">
        <div class="text-2xl font-bold text-white">KuppiConnect</div>
        <div class="sm:hidden">
            <button @click="open = !open" class="text-white focus:outline-none">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="hidden sm:flex space-x-6 text-white font-semibold">
            <a href="{{ route('index') }}" class="text-white hover:underline">Home</a>
            <a href="{{ route('tutors') }}" class="text-white hover:underline">View Tutors</a>
        </div>
        <div class="hidden sm:flex space-x-4 text-white">
           
        </div>
    </div>
    <div x-show="open" class="sm:hidden">
        <div class="flex flex-col bg-blue-500 text-white p-4 space-y-2">
            <a href="{{ route('index') }}" class="hover:text-gray-200">Home</a>
            <a href="{{ route('tutors') }}" class="hover:text-gray-200">View Tutors</a>
            <div class="flex space-x-4">
                
            </div>
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
                {{-- <a href="mailto:{{ $tutor->email }}" class="text-gray-500 hover:text-gray-600"><i class="fas fa-envelope"></i> {{ $tutor->email }}</a> --}}
                {{-- <a href="tel:{{ $tutor->phone_number }}" class="text-gray-500 hover:text-gray-600"><i class="fas fa-phone-alt"></i> {{ $tutor->phone_number }}</a> --}}
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

                {{-- <!-- Modules Section -->
                <div class="bg-gray-50 p-6 rounded-lg border shadow-sm">
                    <h4 class="text-xl font-semibold text-blue-600">Modules</h4>
                    <ul class="list-disc pl-6 text-gray-700">
                        <li>Introduction to Programming</li>
                        <li>Data Structures and Algorithms</li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-bold">{{ $tutor->name }}</h2>
        <p class="text-gray-600">Department: {{ $tutor->department }}</p>
    
        <!-- Display success or error messages if available -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
    
        <form action="{{ route('submit.rating', $tutor) }}" method="POST" class="mt-6">
            @csrf
            <div class="flex items-center">
                <label for="rating" class="mr-4">Rate this tutor:</label>
                <select name="rating" id="rating" class="border p-2 rounded">
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="comment" class="block text-gray-700">Comment (Optional):</label>
                <textarea name="comment" id="comment" class="w-full p-2 border rounded" rows="4"></textarea>
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white px-6 py-2 rounded">Submit Rating</button>
        </form>
    </div>
    
    

<!-- Display Modules Section -->
<!-- Main Content -->
<div class="container mx-auto mt-8">
    <!-- Modules Section -->
<div class="bg-white p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold text-blue-500">Your Modules</h3>
    @if($tutor->modules && $tutor->modules->count() > 0)
        <ul class="mt-4 space-y-4">
            @foreach($tutor->modules as $module)
            <li class="border border-gray-200 rounded-lg p-4">
                <div>
                    <h4 class="text-lg font-semibold text-gray-800">{{ $module->name }}</h4>
                    <p class="text-gray-600">{{ $module->description }}</p>
                    <!-- Schedule Session Button -->
                    <button 
                        onclick="openModal('{{ $module->name }}', '{{ $tutor->name }}', '{{ $tutor->email }}')" 
                        class="bg-blue-500 text-white mt-4 py-2 px-4 rounded-lg hover:bg-blue-400">
                        Schedule Session
                    </button> 
                   <!-- Schedule Session Button -->
                       <!-- Check if the user is authenticated as a student -->
                   @auth('student')
                    <form action="{{ route('schedule.session') }}" method="POST">
                        @csrf
                        <input type="hidden" name="module_name" value="{{ $module->name }}">
                        <input type="hidden" name="tutor_name" value="{{ $tutor->name }}">
                        <input type="hidden" name="tutor_email" value="{{ $tutor->email }}">
                        <button type="submit" class="bg-blue-500 text-white mt-4 py-2 px-4 rounded-lg hover:bg-blue-400">
                            Schedule Session
                        </button>
                    </form>
                @else
                    {{-- <p class="text-red-500 mt-4">You need to log in to schedule a session. <a href="{{ route('loginStu') }}" class="text-blue-500 underline">Log in</a></p> --}}
                @endauth
                </div>
            </li>
            @endforeach
        </ul>
    @else
        <p class="text-gray-600 mt-4">No modules available.</p>
    @endif
</div>
</div>

<!-- Modal -->
<div id="modal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white w-96 p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-semibold text-blue-500 mb-4">Schedule a Session</h3>
        <p class="text-gray-800 mb-4">Module: <span id="modalModuleName"></span></p>
        <input type="hidden" id="modalTutorName">
        <input type="hidden" id="modalTutorEmail">
        <div class="mb-4">
            <label for="sessionDay" class="block text-gray-700 font-medium mb-2">Preferred Day</label>
            <select id="sessionDay" class="w-full border border-gray-300 p-2 rounded-lg">
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
        <div class="mb-4">
            <label for="sessionTime" class="block text-gray-700 font-medium mb-2">Preferred Time</label>
            <select id="sessionTime" class="w-full border border-gray-300 p-2 rounded-lg">
                <option value="" disabled selected>Select a time</option>
                <option value="8:00 AM">8:00 AM</option>
                <option value="8:30 AM">8:30 AM</option>
                <option value="9:00 AM">9:00 AM</option>
                <option value="9:30 AM">9:30 AM</option>
                <option value="10:00 AM">10:00 AM</option>
                <option value="10:30 AM">10:30 AM</option>
                <option value="11:00 AM">11:00 AM</option>
                <option value="11:30 AM">11:30 AM</option>
                <option value="12:00 PM">12:00 PM</option>
                <option value="12:30 PM">12:30 PM</option>
                <option value="1:00 PM">1:00 PM</option>
                <option value="1:30 PM">1:30 PM</option>
                <option value="2:00 PM">2:00 PM</option>
                <option value="2:30 PM">2:30 PM</option>
                <option value="3:00 PM">3:00 PM</option>
                <option value="3:30 PM">3:30 PM</option>
                <option value="4:00 PM">4:00 PM</option>
                <option value="4:30 PM">4:30 PM</option>
                <option value="5:00 PM">5:00 PM</option>
                <option value="5:30 PM">5:30 PM</option>
                <option value="6:00 PM">6:00 PM</option>
                <option value="6:30 PM">6:30 PM</option>
                <option value="7:00 PM">7:00 PM</option>
                <option value="7:30 PM">7:30 PM</option>
                <option value="8:00 PM">8:00 PM</option>
                <option value="8:30 PM">8:30 PM</option>
            </select>
        </div>
        <div class="flex justify-end space-x-4">
            <button onclick="closeModal()" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200">Cancel</button>
            <button onclick="submitForm()" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-400">Submit</button>
        </div>
    </div>
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


<script>
        // JavaScript to handle the modal and email generation
        function openModal(moduleName, tutorName, tutorEmail) {
            // Set the module and tutor details in the modal
            document.getElementById('modalModuleName').textContent = moduleName;
            document.getElementById('modalTutorName').value = tutorName;
            document.getElementById('modalTutorEmail').value = tutorEmail;
            document.getElementById('modal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function submitForm() {
            const tutorName = document.getElementById('modalTutorName').value;
            const tutorEmail = document.getElementById('modalTutorEmail').value;
            const moduleName = document.getElementById('modalModuleName').textContent;
            const sessionDay = document.getElementById('sessionDay').value;
            const sessionTime = document.getElementById('sessionTime').value;

            // Generate the email link with the form data
            const emailBody = `Hi ${tutorName},%0D%0AI would like to schedule a session for the module '${moduleName}'.%0D%0AMy preferred day and time are as follows:%0D%0A- Day: ${sessionDay}%0D%0A- Time: ${sessionTime}%0D%0APlease let me know if this works.%0D%0AThanks.`;
            window.location.href = `mailto:${tutorEmail}?subject=Schedule a Session&body=${emailBody}`;

            // Close the modal
            closeModal();
        }
    </script>

</body>
</html>
