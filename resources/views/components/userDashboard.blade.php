@php
    $maxLoan = 0;
    $currency = $settings->currency;
    // Determine the max loan based on the loan type
    switch ($settings->loan_type) {
        case 'fixed':
            $maxLoan = $settings->loan_max_amount;
            break;
        case 'reducing':
            $maxLoan = $user->savings->account_balance * $settings->loan_max_amount;
            break;
        default:
            $maxLoan = 0; // Optional: Handle unexpected loan type
            break;
    }
    // Format the max loan amount
    $maxLoan = number_format($maxLoan, 2);
@endphp

<div class="w-full">
    <h3 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-700 capitalize">
        Hi 👋 {{ $user->first_name }} {{ $user->last_name }}
    </h3>
    <div class="flex flex-wrap items-center py-4">
        <p class="text-lg sm:text-xl font-semibold text-gray-500">
            Your Total Savings Are
        </p>
        <span
            class="text-2xl sm:text-3xl font-bold bg-white px-2 py-1 mx-3 rounded-xl underline-offset-2 text-gray-500 inline-block">
            {{ $currency }}
            <span id="amount">******</span> <!-- Default view is asterisks -->
            <i id="toggleVisibility" class="fas fa-eye-slash ml-2 hover:text-gray-700 cursor-pointer"></i>
            <!-- Default icon is eye-slash -->
        </span>
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Active Loan Card -->
        <div class="bg-white shadow-lg rounded-lg pt-4 pb-4 px-4 border-t-4 border-green-500">
            <div class="flex items-center mb-2">
                <div class="p-2 bg-green-500 rounded-xl">
                    <i class="fas fa-hand-holding-usd text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <h4 class="text-lg sm:text-xl font-bold text-gray-600">Active Loan</h4>
                </div>
            </div>
            <hr>
            <div class="mt-4">
                <h5 class="text-sm sm:text-md font-semibold text-gray-600">
                    Current Outstanding
                    <a href="#" title="View Loan Distribution" class="text-gray-500 hover:text-gray-700 ml-2">
                        <i class="fas fa-info-circle"></i>
                    </a>
                </h5>
                <p class="text-lg sm:text-xl font-bold">
                    <i class="fas fa-money-bill-wave text-green-500 mr-2"></i> TZS ******
                </p>
            </div>
            <div class="my-4">
                <h5 class="text-sm sm:text-md font-semibold text-gray-600">Due Date</h5>
                <p class="text-lg sm:text-xl font-bold">Aug, 13</p>
            </div>
            <button
                class="bg-green-500 w-full text-white font-bold text-base sm:text-lg px-4 py-2 rounded-lg hover:bg-green-600 flex items-center justify-center">
                <i class="fas fa-credit-card mr-2"></i> Repay before Due
            </button>
        </div>

        <!-- Apply for Loan Card -->
        <div class="bg-white shadow-lg rounded-lg pt-4 pb-4 px-4 border-t-4 border-blue-500">
            <div class="flex items-center mb-2">
                <div class="p-2 bg-blue-500 rounded-xl">
                    <i class="fas fa-piggy-bank text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <h4 class="text-lg sm:text-xl font-bold text-gray-600">Need Extra Funds?</h4>
                </div>
            </div>
            <hr>
            <div class="mt-4">
                <h5 class="text-sm sm:text-md font-semibold text-gray-600">You can get up to:</h5>
                <p class="text-lg sm:text-xl font-bold">{{ $currency }} {{ $maxLoan }}</p>
            </div>
            <p class="text-sm text-gray-500 mt-2 mb-4">
                Apply for a quick loan to help you meet your financial needs.
            </p>
            <a href="{{ route('inprogress') }}"
                class="bg-blue-500 w-full text-white font-bold text-base sm:text-lg px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center justify-center">
                <i class="fas fa-hand-holding-usd mr-2"></i> Apply Now
            </a>
        </div>
    </div>

    <!-- Transactions and Notifications Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <!-- Recent Transactions Section -->

        <div class="bg-white shadow-lg rounded-lg pt-4 pb-4 px-4 border-t-4 border-teal-500">
            <div class="flex items-center mb-2">
                <div class="p-2 bg-teal-500 rounded-xl">
                    <i class="fas fa-exchange-alt text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <h4 class="text-lg sm:text-xl font-bold text-gray-600">Recent Transactions</h4>
                </div>
            </div>
            <hr>
            <ul class="mt-4 space-y-2">
                <li class="text-gray-600 flex justify-between">
                    <span>Deposit</span>
                    <span class="font-bold">TZS 200,000</span>
                </li>
                <li class="text-gray-600 flex justify-between">
                    <span>Withdrawal</span>
                    <span class="font-bold">TZS 100,000</span>
                </li>
                <li class="text-gray-600 flex justify-between">
                    <span>Loan Repayment</span>
                    <span class="font-bold">TZS 50,000</span>
                </li>
            </ul>
            <button class="text-sm text-teal-500 mt-4 hover:underline" id="showMoreTransactions">Show More</button>
        </div>

        <!-- New Notifications Section -->
        <div class="bg-white shadow-lg rounded-lg pt-4 pb-4 px-4 border-t-4 border-orange-500">
            <div class="flex items-center mb-2">
                <div class="p-2 bg-orange-500 rounded-xl">
                    <i class="fas fa-bell text-white text-lg"></i>
                </div>
                <div class="ml-4">
                    <h4 class="text-lg sm:text-xl font-bold text-gray-600">Notifications</h4>
                </div>
            </div>
            <hr>
            <ul class="mt-4 space-y-2">
                <li class="text-gray-600 flex justify-between">
                    <span>Loan Payment Reminder</span>
                    <span class="text-sm text-gray-400">2 hours ago</span>
                </li>
                <li class="text-gray-600 flex justify-between">
                    <span>Account Statement Available</span>
                    <span class="text-sm text-gray-400">Yesterday</span>
                </li>
                <li class="text-gray-600 flex justify-between">
                    <span>Profile Update Successful</span>
                    <span class="text-sm text-gray-400">3 days ago</span>
                </li>
            </ul>
            <button class="text-sm text-orange-500 mt-4 hover:underline" id="showMoreNotifications">Show More</button>
        </div>
    </div>
</div>

<script>
    document.getElementById('toggleVisibility').addEventListener('click', function() {
        const amountElement = document.getElementById('amount');
        const originalAmount = "{{ number_format($user->savings->account_balance, 2) }}";

        // Toggle between showing amount and asterisks
        if (amountElement.textContent === originalAmount) {
            amountElement.textContent = '******'; // Replace with asterisks
            this.classList.replace('fa-eye', 'fa-eye-slash'); // Change to eye-slash icon
        } else {
            amountElement.textContent = originalAmount; // Show original amount
            this.classList.replace('fa-eye-slash', 'fa-eye'); // Change back to eye icon
        }
    });
</script>
