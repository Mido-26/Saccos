<!-- Main Content Area -->
<div class="flex-grow md:ml-48 sm:ml-0 w-full flex flex-col ">
    <!-- Sticky Navbar -->
    <header class="sticky top-0 bg-white shadow p-4 flex justify-between items-center z-10">
        <!-- Toggle Sidebar Button (Small Screens) -->
        <div class="flex items-center gap-5">
            <button class="md:hidden text-gray-700" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <h2 class="text-2xl font-semibold">@yield('name', 'Saccos')</h2>
        </div>
        <div class="flex items-center gap-4">

            @if (Auth::check() && (Auth::user()->role == 'staff' || Auth::user()->role == 'admin'))
                <form id="roleForm" action="{{ route('dashboard') }}" method="POST">
                    @csrf <!-- Protects the form from cross-site request forgery attacks -->

                    @php
                        if (!isset($role)) {
                            $role = session('role');
                        }
                    @endphp
                    <div class="hidden sm:flex items-center">
                        @php
                            $isAdmin = $role == 'admin';
                        @endphp

                        <!-- Hidden Input to Pass the Role -->
                        <input type="hidden" name="role" value="{{ $isAdmin ? 'user' : 'admin' }}">
                        <span class="text-sm text-gray-700 mr-2">User</span>
                        <!-- Toggle Switch -->
                        <label for="roleToggle" class="relative inline-flex items-center cursor-pointer">

                            <input type="checkbox" id="roleToggle" {{ $isAdmin ? 'checked' : '' }} class="sr-only">
                            <!-- Screen reader only, hidden from view -->
                            <!-- Outer Switch Background -->
                            <div
                                class="w-12 h-6 bg-gray-300 rounded-full shadow-inner transition-colors duration-300  {{ $isAdmin ? 'bg-gray-700' : 'bg-green-500' }}">
                            </div>


                            <!-- Toggle Dot -->
                            <div
                                class="dot absolute top-0 left-0 w-6 h-6 bg-white rounded-full shadow-md transform transition-transform duration-300 {{ $isAdmin ? 'translate-x-6' : '' }}">
                            </div>


                        </label>
                        <span class="text-sm text-gray-700 ml-2">Admin</span>
                    </div>
                </form>
            @endif


            {{-- @push('scripts') --}}
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function() {
                    // Listen for changes on the toggle switch
                    $('#roleToggle').change(function() {
                        // Toggle the hidden role input value based on switch state
                        let role = $(this).is(':checked') ? 'admin' : 'user';
                        $("input[name='role']").val(role);

                        // Automatically submit the form when toggled
                        $("#roleForm").submit();
                    });
                });
            </script>
            {{-- @endpush --}}


            <!-- Notification Icon with Dropdown -->
            <div class="relative">
                <button id="notificationButton" class="relative text-gray-700" onclick="toggleNotifications()">
                    <i class="fa-solid fa-bell text-xl"></i>
                    <span id="notificationBadge"
                        class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full hidden"></span>
                </button>
                <!-- Notification Dropdown -->
                <div id="notificationDropdown"
                    class="absolute right-0 mt-2 w-64 bg-white border rounded shadow-lg hidden">
                    <div class="p-4 font-bold text-gray-700 border-b">Notifications</div>
                    <ul id="notificationList" class="max-h-60 overflow-y-auto">
                        <!-- Notifications will be loaded here -->
                    </ul>
                    <div class="p-2 text-center text-dark-700 font-bold text-sm hover:underline cursor-pointer">
                        <!-- <a href="/path/to/notifications/page">View All</a> -->
                    </div>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div class="relative">
                <button id="dropdownButton" class="flex items-center focus:outline-none" onclick="toggleDropdown()">
                    <img src="{{ asset('assets/logo/logo2.png ') }}" alt="Profile"
                        class="w-8 h-8 bg-cover rounded-full">
                    <span class="hidden md:block ml-2">Hi 👋 {{ Auth::user()->first_name ?? 'Guest' }}</span>
                    <i class="fa-solid fa-chevron-down ml-1"></i>
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow-lg hidden">
                    <a href="/profile" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">
                        <i class="fa-solid fa-user"></i> Profile
                    </a>

                    <!-- Logout Form -->
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-200">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </header>
