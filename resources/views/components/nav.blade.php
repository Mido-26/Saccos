<!-- Sidebar -->
<aside id="sidebar"
    class="w-48 md:w-48 h-screen bg-white shadow-lg sticky top-0 md:relative z-20 transform -translate-x-full md:translate-x-0 transition-transform duration-300"
    style="position: fixed !important; top: 0 !important;">
    <div class="p-4 relative">
        <!-- Close Sidebar Button (Small Screens) -->
        <button class="md:hidden text-gray-700 mb-4" id="toggleSidebarButton">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>

        <!-- Company Logo -->
        <div class="flex justify-center mb-2">
            <p class="text-center text-2xl text-green-700 uppercase font-extrabold mb-2">SOMS</p>
        </div>

        @auth
            
        <!-- Navigation Links -->
        <nav class="space-y-2">
            <!-- Dashboard -->
            <a href="/dashboard"
                class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 rounded transition capitalize
                {{ request()->is('dashboard') ? 'border-l-4 border-green-700 bg-green-100 text-green-700' : '' }}">
                <i class="fa-solid fa-house mr-2"></i> Dashboard
            </a>
                @php
                    $role = session('role');
                @endphp
            <!-- Members with Dropdown -->
            @if ($role == 'admin' || $role == 'staff')
            <div>
                <button id="membersButton"
                    class="flex items-center py-2 px-4 w-full text-gray-700 hover:bg-gray-200 rounded transition capitalize  
                        {{ request()->is('users' , 'users/create', 'users/*') ? 'border-l-4 border-green-700 bg-green-100 text-green-700' : '' }}  ">
                    <i class="fa-solid fa-users mr-2"></i> Members
                    <i id="membersIcon" class="fa-solid fa-chevron-right ml-auto transition-transform duration-300"></i>
                </button>
                <div id="membersDropdown" class="hidden pl-0 space-y-2 bg-gray-100 transition-all">
                    <a href="{{ route('users.index') }}" class="flex items-center py-2 px-4 text-sm text-gray-600 hover:bg-gray-200 rounded transition">
                        <i class="fa-solid fa-list mr-1 text-xs"></i> All Members
                    </a>
                    <a href="{{ route('users.create') }}" class="flex items-center py-2 px-4 text-sm text-gray-600 hover:bg-gray-200 rounded transition">
                        <i class="fa-solid fa-user-plus mr-1 text-xs"></i> Add Member
                    </a>
                    <a href="{{ route('inprogress') }}" class="flex items-center py-2 px-4 text-sm text-gray-600 hover:bg-gray-200 rounded transition">
                        <i class="fa-solid fa-tags mr-1 text-xs"></i> Member Types
                    </a>
                </div>
            </div>

            <!-- Savings -->
            <a href="{{ route('savings.index') }}"
                class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 rounded transition capitalize 
                    {{ request()->is('savings', 'savings/*') ? 'border-l-4 border-green-700 bg-green-100 text-green-700' : '' }}">
                <i class="fa-solid fa-piggy-bank mr-2"></i> Savings
            </a>
            
            
            @endif
            
            <!-- Loans with Dropdown -->
            <div>
                <!-- Main Button -->
                <button id="loansButton"
                    class="flex items-center py-2 px-4 w-full text-gray-700 hover:bg-gray-200 rounded transition capitalize 
                        {{ request()->is('loans', 'loans/create', 'loans/*', 'loan-categories/*') ? 'border-l-4 border-green-700 bg-green-100 text-green-700' : '' }}">
                    <i class="fa-solid fa-hand-holding-usd mr-2"></i> Loans
                    <i id="loansIcon" class="fa-solid fa-chevron-right ml-auto transition-transform duration-300"></i>
                </button>
                
                <!-- Dropdown Content -->
                <div id="loansDropdown" class="hidden pl-0 space-y-2 bg-gray-100 transition-all">
                    <!-- All Loans -->
                    <a href="{{ route('inprogress') }}" 
                       class="flex items-center py-2 px-4 text-sm text-gray-600 hover:bg-gray-200 rounded transition">
                        <i class="fa-solid fa-list mr-1 text-xs"></i> All Loans
                    </a>
                    <!-- Pending Loans -->
                    <a href="{{ route('inprogress') }}" 
                       class="flex items-center py-2 px-4 text-sm text-gray-600 hover:bg-gray-200 rounded transition">
                        <i class="fa-solid fa-clock mr-1 text-xs"></i> Pending Loans
                    </a>
                    <!-- Approved Loans -->
                    <a href="{{ route('inprogress') }}" 
                       class="flex items-center py-2 px-4 text-sm text-gray-600 hover:bg-gray-200 rounded transition">
                        <i class="fa-solid fa-check mr-1 text-xs"></i> Approved Loans
                    </a>
                    <!-- Loans Categories -->
                    <a href="{{ route('inprogress') }}" 
                       class="flex items-center py-2 px-4 text-sm text-gray-600 hover:bg-gray-200 rounded transition">
                        <i class="fa-solid fa-tags mr-1 text-xs"></i> Loan Categories
                    </a>
                </div>
            </div>

            

            <!-- Transactions -->
            <a href="{{ route('transactions.index') }}"
                class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 rounded transition capitalize 
                    {{ request()->is('transactions', 'transactions/*') ? 'border-l-4 border-green-700 bg-green-100 text-green-700' : '' }}">
                <i class="fa-solid fa-exchange-alt mr-2"></i> Transactions
            </a>

            <!-- Reports with Dropdown -->
            <div>
                <button id="reportsButton"
                    class="flex items-center py-2 px-4 w-full text-gray-700 hover:bg-gray-200 rounded transition capitalize 
                        {{ request()->is('reports*') ? 'border-l-4 border-green-700 bg-green-100 text-green-700' : '' }}">
                    <i class="fa-solid fa-chart-line mr-2"></i> Reports
                    <i id="reportsIcon" class="fa-solid fa-chevron-right ml-auto transition-transform duration-300"></i>
                </button>
                <div id="reportsDropdown" class="hidden pl-0 space-y-2 bg-gray-100 transition-all">
                    <a href="{{ route('inprogress') }}" class="flex items-center py-2 px-4 text-sm text-gray-600 hover:bg-gray-200 rounded transition">
                        <i class="fa-solid fa-calendar-alt mr-1 text-xs"></i> Monthly Reports
                    </a>
                    <a href="{{ route('inprogress') }}" class="flex items-center py-2 px-4 text-sm text-gray-600 hover:bg-gray-200 rounded transition">
                        <i class="fa-solid fa-calendar-check mr-1 text-xs"></i> Annual Reports
                    </a>
                    <a href="{{ route('inprogress') }}" class="flex items-center py-2 px-4 text-sm text-gray-600 hover:bg-gray-200 rounded transition">
                        <i class="fa-solid fa-cogs mr-1 text-xs"></i> Custom Reports
                    </a>
                </div>
            </div>
            

            <!-- Settings -->
            <a href="{{ route('inprogress') }}"
                class="flex items-center py-2 px-4 text-gray-700 hover:bg-gray-200 rounded transition capitalize 
                    {{ request()->is('settings', 'settings/*') ? 'border-l-4 border-green-700 bg-green-100 text-green-700' : '' }}">
                <i class="fa-solid fa-cog mr-2"></i> Settings
            </a>
        </nav>
        
        @endauth
        @yield('configsteps')
    </div>
</aside>

<!-- jQuery Script -->
<script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script>
<script>
   $(document).ready(function () {
    // Function to toggle dropdown visibility, close others, and rotate icon
    function toggleDropdown(dropdownId, iconId) {
        // Close any other open dropdowns
        $('.dropdown-content').slideUp().addClass('hidden');
        $('.dropdown-icon').removeClass('rotate-90'); // Reset other icons

        // Open the clicked dropdown and rotate icon
        $(`#${dropdownId}`).stop(true, true).slideToggle().toggleClass('hidden');
        $(`#${iconId}`).toggleClass('rotate-90');
    }

    // Add event listeners for dropdowns
    $('#loansButton').on('click', function () {
        toggleDropdown('loansDropdown', 'loansIcon');
    });

    $('#membersButton').on('click', function () {
        toggleDropdown('membersDropdown', 'membersIcon');
    });

    $('#reportsButton').on('click', function () {
        toggleDropdown('reportsDropdown', 'reportsIcon');
    });

    // Sidebar toggle function
    $('#toggleSidebarButton').on('click', function () {
        $('#sidebar').toggleClass('-translate-x-full');
    });
});
</script>
