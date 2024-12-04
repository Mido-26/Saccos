<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support</title>
    <link rel="stylesheet" href="{{ asset('assets/css/all.min.css') }}">
    <script src="{{ asset('assets/js/taiwind.js') }}"></script>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8 bg-gray-100">
        <div class="bg-white shadow-xl rounded-lg max-w-md w-full px-8 py-10">
            <h2 class="text-3xl font-extrabold text-gray-800 text-center">Contact Support</h2>
            <p class="mt-4 text-gray-600 text-center">Need help? Fill out the form below, and our support team will get back to you as soon as possible.</p>
            
            <form action="{{ route('support') }}" method="POST" class="mt-8 space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
                    <input id="name" name="name" type="text" required
                        class="mt-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" name="email" type="email" required
                        class="mt-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2">
                </div>

                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <input id="subject" name="subject" type="text" required
                        class="mt-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2">
                </div>

                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                    <textarea id="message" name="message" rows="5" required
                        class="mt-2 block w-full rounded-lg border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-4 py-2"></textarea>
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="w-full py-3 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-300">
                        Submit
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">Alternatively, you can reach us at <a href="mailto:support@example.com" class="text-indigo-600 hover:underline">support@example.com</a> or call <a href="tel:+123456789" class="text-indigo-600 hover:underline">+1 234 567 89</a>.</p>
        </div>
    </div>
</body>
</html>
