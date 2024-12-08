@php
    $allowGuarantor = $settings->allow_guarantor;
    $minGuarantors = $settings->min_guarantor;
    switch ($settings->loan_type) {
        case 'fixed':
            $maxLoan = $settings->loan_max_amount;
            break;
        case 'reducing':
            $maxLoan = Auth::user()->savings->account_balance * $settings->loan_max_amount;
            break;
        default:
            $maxLoan = 0; // Optional: Handle unexpected loan type
            break;
    }
    // $maxLoan =  Auth::user()->savings->account_balance * ;
@endphp
<x-layout>
    @section('title', 'Loan Application')
    @section('name', 'Loan Application')

    @section('content')
        <div class="max-w-full p-6 h-full bg-white rounded-xl shadow-lg">
            <h1 class="text-2xl font-bold  text-gray-600 mb-4">Loan Application Form</h1>

            <div class="mb-4 max-w-3xl">
                <form action="{{ route('loans.store') }}" method="post">
                    @csrf

                    <!-- Loan Information Section -->
                    <div class="mb-8">
                        <p class="text-green-700 font-semibold text-xl mb-6">
                            <strong>Loan Information</strong>
                        </p>
                        <x-form.input id="loanAmount" name="loanAmount" label="Loan Amount:" type="number"
                            placeholder="Enter Loan amount e.g., 50,000" icon="fas fa-money-bill-wave" step="1"
                            class="required" :required="true" max="{{ $maxLoan }}" />

                        <x-form.input id="loanDuration" name="loanDuration" label="Loan Duration (Months):" type="number"
                            max="{{ $settings->loan_duration }}" placeholder="Enter loan duration e.g., 3, 6, 12, 18, 24"
                            icon="fas fa-clock" step="1" class="required" :required="true" />

                        <x-form.input id="interestRate" name="interestRate" label="Loan Interest Rate %:" type="number"
                            readonly value="{{ $settings->interest_rate }}" placeholder="" icon="fas fa-percentage"
                            step="1" class="required" :required="true" />

                        <x-form.input id="principalAmount" name="principalAmount" label="Loan Payable After Rate:"
                            type="number" placeholder="" icon="fas fa-calculator" step="1" class="required"
                            :required="true" readonly />

                        <x-form.input id="monthlyPayments" name="monthlyPayments" label="Loan Monthly Payments:"
                            type="number" placeholder="" icon="fas fa-calculator" step="1" class="required"
                            :required="true" readonly />

                        <x-form.text-area id="description" name="description" label="Description"
                            placeholder="Enter a detailed description" icon="fas fa-align-left" :required="true"
                            rows="5" />
                    </div>

                    <!-- Divider -->
                    <hr class="my-8 border-t-2 border-gray-200">

                    @if ($allowGuarantor)
                        <!-- Referee Information Section -->
                        <div class="mb-8">
                            <p class="text-green-700 font-semibold text-xl mb-6">
                                <strong>Your Referee Information</strong>
                            </p>

                            @if (!is_null($no))
                                @for ($i = 0; $i < $minGuarantors; $i++)
                                    <x-form.select-field id="referee_{{ $i }}" name="referee_{{ $i }}"
                                        label="Referee" :options="$referee" placeholder="Select Your Referee"
                                        icon="fas fa-user-friends" :required="true" />
                                @endfor
                            @else
                                <x-form.select-field id="referee_1" name="referee_1" label="Referee" :options="$referee"
                                    placeholder="Select Your Referee" icon="fas fa-user-friends" :required="true" />
                            @endif
                        </div>

                        <!-- Divider -->
                        <hr class="my-8 border-t-2 border-gray-200">
                    @endif

                    <!-- Submit Button -->
                    <div class="mb-4 flex justify-end items-center gap-6">
                        {{-- clear form Button --}}
                        <x-form.button id="clearButton" width="45" color="gray" icon="fas fa-undo" :disabled="false">
                            Clear Form
                        </x-form.button>
                        {{-- submit Button --}}
                        <x-form.button id="submit" width="45" color="green" icon="fas fa-paper-plane"
                            :disabled="false">
                            Apply Loan
                        </x-form.button>
                    </div>
                </form>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                // Define default variables
                const interestRate = parseFloat($('#interestRate').val()); // Interest rate is pre-filled
                const maxLoanAmount = parseFloat($('#loanAmount').attr('max'));
                const maxLoanDuration = parseInt($('#loanDuration').attr('max'));

                // Form Elements
                const $loanAmountInput = $('#loanAmount');
                const $loanDurationInput = $('#loanDuration');
                const $principalAmountInput = $('#principalAmount');
                const $monthlyPaymentsInput = $('#monthlyPayments');

                // Event Listeners
                $loanAmountInput.on("input", validateAndCalculate);
                $loanDurationInput.on("input", validateAndCalculate);

                // Function to validate inputs and calculate amounts
                function validateAndCalculate() {
                    const loanAmount = parseFloat($loanAmountInput.val());
                    const loanDuration = parseInt($loanDurationInput.val());

                    // Validate loan amount
                    if (isNaN(loanAmount) || loanAmount <= 0 || loanAmount > maxLoanAmount) {
                        $loanAmountInput.addClass("border-red-500")
                            .get(0).setCustomValidity("Loan amount must be between 1 and " + maxLoanAmount);
                        $loanAmountInput.parent().next('.error').text("Loan amount must be between 1 and " + maxLoanAmount).show();
                        $principalAmountInput.val("");
                        $monthlyPaymentsInput.val("");
                        return;
                    } else {
                        $loanAmountInput.removeClass("border-red-500")
                            .get(0).setCustomValidity("");
                        
                         $loanAmountInput.parent().next('.error').hide();    
                    }

                    // Validate loan duration
                    if (isNaN(loanDuration) || loanDuration <= 0 || loanDuration > maxLoanDuration) {
                        $loanDurationInput.addClass("border-red-500")
                            .get(0).setCustomValidity("Loan duration must be between 1 and " + maxLoanDuration +
                                " months");
                        $loanDurationInput.parent().next('.error').text("Loan duration must be between 1 and " + maxLoanDuration + " months").show();       
                        $principalAmountInput.val("");
                        $monthlyPaymentsInput.val("");
                        return;
                    } else {
                        $loanDurationInput.removeClass("border-red-500")
                            .get(0).setCustomValidity("");
                            $loanDurationInput.parent().next('.error').hide();    
                    }

                    // Calculate the principal amount and monthly payments
                    const totalPayable = loanAmount + (loanAmount * (interestRate / 100) * (loanDuration / 12));
                    const monthlyPayments = totalPayable / loanDuration;

                    // Set calculated values
                    $principalAmountInput.val(totalPayable.toFixed(2));
                    $monthlyPaymentsInput.val(monthlyPayments.toFixed(2));
                }

                // Reset form and clear calculations
                $('#clearButton').on("click", function(e) {
                    e.preventDefault();
                    $loanAmountInput.val("").removeClass("border-red-500");
                    $loanDurationInput.val("").removeClass("border-red-500");
                    $principalAmountInput.val("");
                    $monthlyPaymentsInput.val("");
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                // Select all referee dropdowns
                const refereeDropdowns = document.querySelectorAll('select[id^="referee_"]');

                // Function to handle changes
                function handleRefereeChange(event) {
                    const selectedValue = event.target.value;

                    // Loop through all dropdowns
                    refereeDropdowns.forEach(dropdown => {
                        // Skip the current dropdown
                        if (dropdown !== event.target) {
                            // Disable the selected value in other dropdowns
                            const options = dropdown.querySelectorAll("option");
                            options.forEach(option => {
                                if (option.value === selectedValue) {
                                    option.disabled = true;
                                } else {
                                    option.disabled = false; // Reset other options
                                }
                            });

                            // Disable currently selected values in all other dropdowns
                            refereeDropdowns.forEach(drop => {
                                if (drop !== dropdown && drop.value) {
                                    const disabledValue = drop.value;
                                    dropdown.querySelectorAll("option").forEach(opt => {
                                        if (opt.value === disabledValue) {
                                            opt.disabled = true;
                                        }
                                    });
                                }
                            });
                        }
                    });
                }

                // Attach change event listeners to all dropdowns
                refereeDropdowns.forEach(dropdown => {
                    dropdown.addEventListener("change", handleRefereeChange);
                });
            });
        </script>

    @endsection

</x-layout>
