<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - SOMS</title>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Tailwind CSS -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    @endif
    <!-- Nunito Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white px-4 py-3 rounded-xl shadow-lg w-full max-w-sm">
        <!-- Logo Section -->
        <!-- <img src="../assets/logo/logo2.png" alt="HQ Logo" class="mb-6 mx-auto" style="width: 80px;"> -->
        
        <div>
            {{-- <p class="text-center text-2xl text-green-700 uppercase font-extrabold mb-2">SOMS Forgot Password</p> --}}
            <p class="text-center text-gray-500 capitalize my-2">Enter your email address to reset your password</p>
        </div>
        <!-- Forgot Password Form -->
        @include('components.sess_msg')
        <form action="{{ route('password.reset') }}" method="post" class="space-y-2">
            @csrf
            @method('POST')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500 self-center">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Email Input -->
            <div>
                <label for="Email">Email:</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-green-600" aria-hidden="true"></i>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="Email" aria-label="Email"
                        class="block w-full pl-10 pr-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="sub-reset"
                class="w-full bg-green-600 text-white py-1 px-4 rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <i class="fa fa-paper-plane mr-2"></i> Send Reset Link</button>
            
        </form>
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                <a href="{{ route('login') }}" class="text-green-600 hover:text-green-500 font-medium underline">Remember your password? Login</a>
            </p>
        </div>
    </div>

    <p class="text-center mt-4 text-gray-600 absolute bottom-6">version 1.0.0</p>
</body>

</html>
