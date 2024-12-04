<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Inactive</title>
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <script src="{{ asset('assets/js/taiwind.js') }}"></script>
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center h-screen bg-gray-100 text-gray-800">
        <div class="text-center">
            <!-- Icon or graphic indicating account status -->
            <div class="text-red-500 font-extrabold text-8xl">⛔</div> <!-- Stop icon -->
            
            <!-- Main message -->
            <p class="text-2xl font-semibold text-gray-800 mt-4">Your Account is Inactive</p>
            <p class="text-gray-600 mt-2">We noticed your account is currently inactive. Please contact support or wait for reactivation.</p>

            <!-- Button to contact support -->
            <a href="{{ url('/support') }}" class="mt-6 inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 transition duration-300">
                <i class="fas fa-headset"></i> Contact Support
            </a>

            <!-- Button to go back -->
            <a href="{{ redirect()->back()->getTargetUrl() }}" class="mt-4 inline-block bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-gray-400 transition duration-300">
                <i class="fas fa-arrow-left"></i> Go Back
            </a>
        </div>
    </div>
</body>
</html>
