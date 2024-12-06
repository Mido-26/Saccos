<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen text-gray-800">
        <div class="text-center bg-gray-100 p-8  max-w-lg">
            <!-- Icon or graphic for email verification -->
            <div class="text-green-500 font-extrabold text-8xl mb-4">
                <i class="fas fa-envelope"></i>
            </div>
            
            <!-- Main message -->
            <h1 class="text-3xl font-bold text-gray-800">Verify Your Email</h1>
            <p class="text-gray-600 mt-2">
                A verification email has been sent to your registered email address. Please check your inbox and click the link to verify your email.
            </p>
            
            <!-- Instructions or additional info -->
            <p class="text-gray-600 mt-4">
                Didn't receive the email? Check your spam folder or click the button below to resend the verification email.
            </p>
            
            <!-- Resend email button -->
            <a href="{{ route('verification.send') }}" 
               class="mt-6 inline-block bg-blue-500 text-white font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                <i class="fas fa-paper-plane"></i> Resend Email
            </a>

            <!-- Go back button -->
            <a href="{{ url('/') }}" 
               class="mt-4 inline-block bg-gray-300 text-gray-800 font-semibold py-2 px-6 rounded-lg shadow-md hover:bg-gray-400 transition duration-300">
                <i class="fas fa-home"></i> Go Back to Home
            </a>
        </div>
    </div>
</body>
</html>
