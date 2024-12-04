<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Saccoss(SOMS)</title>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Tailwind CSS -->
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endif
    <!-- Nunito Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="../assets/fonts/Nunito.ttf"> --}}
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
            <p class="text-center text-2xl text-green-700 uppercase font-extrabold mb-2">soms Login</p>
            <p class="text-center text-gray-500 capitalize my-2">Sign in to start your session</p>
        </div>
        <!-- Login Form -->
        @include('components.sess_msg')
        <form action="{{ route('login') }}" method="post" class="space-y-2">
            @csrf
            @method('POST')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
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
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($_GET['email'] ?? '') ?>"
                        placeholder="Email" aria-label="Email"
                        class="block w-full pl-10 pr-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                </div>
            </div>

            <div>
                <div class="flex justify-between items-center">
                    <label for="Password">Password:</label>
                    <p class=" text-left text-sm text-gray-600">
                        <a href=" {{ route('password.request')}}" class="text-gray-600 hover:text-gray-500 font-medium underline">Forget Password? </a>
                       </p>
                </div>
                <!-- Password Input -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-lock text-green-600" aria-hidden="true"></i>
                    </div>
                    <input type="password" id="password" name="password" value="<?= htmlspecialchars('') ?>"
                        placeholder="Password" aria-label="Password"
                        class="block w-full pl-10 pr-3 py-2 border border-green-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm"
                        required>
                </div>
            </div>
            
            <!-- Submit Button -->
            <button type="submit" name="sub-log"
                class="w-full bg-green-600 text-white py-1 px-4 rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                <i><i class="fa-solid fa-right-to-bracket mr-2"></i></i> Login</button>
            
        </form>
    </div>

    <p class="text-center mt-4 text-gray-600 absolute bottom-6">version 1.0.0</p>
</body>

</html>
