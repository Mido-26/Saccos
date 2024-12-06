<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SACCOS(soms)')</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">

    <!-- Tailwind CSS -->
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @endif

    <!-- Nunito Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            width: 98vw !important;
            height: auto !important;
            /* outline: 3px red solid; */
        }

        .main {
            width: 100% !important;

        }
        .img-div{
            height: 100vh !important;
            width: 100% !important; 
        }
        img {
            width: 400px;
            height: 400px;
            object-fit: cover;
        }
        
    </style>
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="main flex flex-row justify-between items-start min-h-screen max-w-screen shadow-md rounded-lg mx-1uto my-auto">
        <!-- Left Section: Company Image -->
        <div class="img-div flex items-center justify-center bg-gray-700">
            <img src="{{ asset('assets/logo/logo2.png') }}" alt="Company Image"
                class="max-w-full max-h-full">

            <div class="absolute bottom-6">
                <h3 class="text-2xl text-green-600 font-bold">TechQuorum Solutions</h3>
                <p class="text-center mt-4 text-white">version 1.0.0</p>
            </div>
            {{-- <i>V 1.0.0</i> --}}
        </div>

         <!-- Right Section: Content -->
         <div class="flex flex-col justify-between items-start p-6 bg-white space-y-8">
            <!-- Top Header -->
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-green-700 mb-4 uppercase">
                    Welcome to SACCOs (SOMS)
                </h1>
                <p class="text-gray-500 text-sm">
                    Your partner in SACCO management and growth.
                </p>
            </div>

            <!-- Center Description -->
            <div class="space-y-6">
                <p class="text-gray-600 text-lg font-extrabold text-left">
                    Simplify SACCO operations with TechQuorum’s powerful tools.
                </p>

                <!-- Feature List with Icons -->
                <div class="space-y-4">
                    <div class="flex items-start">
                        <i class="fas fa-users text-green-600 text-xl mr-3 pr-3"></i>
                        <p><strong>Manage Members:</strong> Track members and their activities.</p>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-chart-line text-blue-600 text-xl pr-3"></i>
                        <p><strong>Reports:</strong> Generate financial insights instantly.</p>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-hand-holding-usd text-orange-600 text-xl pr-3"></i>
                        <p><strong>Loans:</strong> Streamline loan approvals and payouts.</p>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-lock text-red-600 text-xl pr-3"></i>
                        <p><strong>Secure:</strong> Robust protection for all your data.</p>
                    </div>
                </div>

            </div>

            <!-- Additional Information Section -->
            <div class="bg-gray-100 p-4 rounded-md shadow-md">
                <h2 class="text-lg font-semibold text-green-700">Why Choose Us?</h2>
                <p class="text-gray-600 text-sm mt-2">
                    Easy-to-use, secure, and scalable for all SACCOs.
                </p>
                <a href="#features" class="text-blue-600 hover:underline mt-2 block">Learn more</a>
            </div>

            <!-- Bottom Button -->
            <div class="w-full">
                <a href="/config/create"
                    class="flex items-center justify-center w-full md:w-auto px-6 py-3 bg-green-600 text-white font-semibold text-lg rounded-lg shadow-lg hover:bg-green-700 transition">
                    <i class="fas fa-handshake mr-2"></i>
                    Get Started
                </a>
            </div>
        </div>
    </div>
</body>
</html>
