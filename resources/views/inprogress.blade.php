<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Development in Progress</title>
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <script src="{{ asset('assets/js/taiwind.js') }}"></script>
</head>
<body class="bg-white">
    <div class="flex items-center justify-center h-screen bg-white text-gray-800">
        <div class="text-center">
            <!-- Large Text for the Message -->
            <div class="text-yellow-500 font-extrabold text-8xl">🚧</div> <!-- Construction icon -->
            
            <p class="text-2xl font-semibold text-gray-800 mt-4">This Page is Not Available</p>
            <p class="text-gray-600 mt-2">Development is still ongoing. Please check back later.</p>

            <a href="{{ redirect()->back()->getTargetUrl() }}" class="mt-6 inline-block bg-yellow-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-yellow-600 transition duration-300">
                <i class="fas fa-arrow-left"></i> Go Back Home
            </a>
        </div>
    </div>
</body>
</html>
