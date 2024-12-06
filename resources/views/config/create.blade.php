<x-layout>
    @section('title', 'Saccos Setup')
    @section('name', 'Saccos Setup')
    @section('configsteps')

        <p class="text-lg font-semibold text-gray-800 mb-4">Configuration Steps</p>

        {{-- Step 1 --}}
        <a href="#step1" class="flex items-center gap-2 text-sm text-green-700 hover:text-green-900 transition mb-3">
            <i class="fas fa-building text-sm mr-2"></i>
            <span>Step 1: Organization Information</span>
        </a>

        {{-- Step 2 --}}
        <a href="#step2" class="text-sm flex items-center gap-2 text-green-700 hover:text-green-900 transition mb-3">
            <i class="fas fa-money-check-alt text-sm mr-2"></i>
            <span>Step 2: Financial Settings</span>
        </a>

        {{-- Step 3 --}}
        <a href="#step3" class="text-sm flex items-center gap-2 text-green-700 hover:text-green-900 transition mb-3">
            <i class="fas fa-user-cog text-sm mr-2"></i>
            <span>Step 3: Admin Account Information</span>
        </a>
    @endsection

    @section('content')
        <style>
            .step {
                transition: transform 0.4s ease-in-out, opacity 0.4s ease-in-out;
            }

            .step-hidden {
                transform: translateX(-100%);
                opacity: 0;
            }
        </style>
        <div class="text-center w-full my-6">
            <!-- Main Title -->
            <h3 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl text-gray-800 font-extrabold">
                WELCOME TO SACCOs (SOMS) CONFIGURATION
            </h3>
            <!-- Subtitle -->
            <p class="text-lg sm:text-xl md:text-2xl text-gray-600 mt-2 font-medium">
                Set up your organization and preferences to get started
            </p>
            <!-- Decorative Underline -->
            <div class="mt-4 flex justify-center">
                <div class="h-1 w-24 bg-green-600 rounded"></div>
            </div>
        </div>
        

        <div class="max-w-full p-6 bg-white rounded-xl shadow-md">
            @include('components.sess_msg')
            <form id="multiStepForm" action="{{ route('settings.store') }}" method="post" class="space-y-6 max-w-full">
                @csrf
                {{-- Step 1 --}}
                <div class="step" id="step1">
                    <p class="text-green-700 font-semibold text-2xl mb-6">
                        <strong>Step 1:</strong> Organization Information
                    </p>
                    <x-form.input id="orgName" name="orgName" label="Organization Name:" type="text"
                        placeholder="Organization Name" icon="fas fa-user" class="required" />

                    <x-form.input id="location" name="location" label="Organization Location:" type="text"
                        placeholder="Organization Location" icon="fas fa-location" class="required" />

                    <x-form.input id="email" name="email" label="Organization Email:" type="email"
                        placeholder="Organization Email" icon="fas fa-envelope" class="required" />

                    <x-form.input id="phone" name="phone" label="Organization Phone:" type="tel"
                        placeholder="Organization Phone" icon="fas fa-phone" class="required" />
                </div>

                {{-- Step 2 --}}
                <div class="step hidden" id="step2">
                    <p class="text-green-700 font-semibold text-2xl mb-6">
                        <strong>Step 2:</strong> Loans and Savings Configuration
                    </p>

                    <!-- Savings Information -->
                    <x-form.input id="minSavings" name="minSavings" label="Minimum Savings Amount:" type="number"
                        placeholder="Enter minimum savings amount e.g., 50,000" icon="fas fa-user" step="0.01"
                        class="required" />

                    <!-- Loan Interest Rate -->
                    <x-form.input id="interestRate" name="interestRate" label="Loan Interest Rate (%):" type="number"
                        placeholder="Enter loan interest rate e.g., 5" icon="fas fa-percentage" step="0.01"
                        class="required" />

                    <!-- Loan Duration -->
                    <x-form.input id="loanDuration" name="loanDuration" label="Maximum Loan Duration (Months):"
                        type="number" placeholder="Enter maximum loan duration e.g., 6" icon="fas fa-calendar-alt"
                        step="1" class="required" />

                    <!-- Loan Calculation Method -->
                    <x-form.select-field id="loanType" name="loanType" label="Loan Calculation Method:" :options="[
                        'fixed' => 'Fixed (Max TZS 1,000,000)',
                        'reducing' => 'Reducing Balance (Max = Savings × 5)',
                    ]"
                        placeholder="Select loan calculation method" icon="fas fa-wallet" :required="true"
                        class="required" />

                    <!-- Loan Calculation Value -->
                    <div class="hidden" id="typeLoan">
                        <x-form.input id="loanMinAmount" name="loanMinAmount" label="Loan Calculation Value:" type="number"
                            placeholder="Enter loan calculation value e.g., 50,000,000 or 5" icon="fas fa-coins" step="0.01"
                             />
                    </div>

                    <!-- Default Currency -->
                    <x-form.input id="currency" name="currency" label="Default Currency:" type="text"
                        placeholder="Enter default currency e.g., TZS, USD" icon="fas fa-coins" class="required" />

                    <!-- Allow Guarantor Checkbox -->
                    <div class="mb-4 flex items-center gap-4">
                        <input type="checkbox" name="allowGuarantor" id="allowGuarantor" class="w-5 h-5" />
                        <label for="allowGuarantor" class="text-gray-700 font-medium">
                            Allow Guarantor
                        </label>
                    </div>

                    <!-- Guarantor Information -->
                    <div class="mb-4 space-y-6 hidden" id="guarantor-info">
                        <!-- Minimum Number of Guarantors -->
                        <x-form.input id="minGuarantor" name="minGuarantor" label="Minimum Number of Guarantors:"
                            type="number" placeholder="Enter minimum number of guarantors e.g., 3"
                            icon="fas fa-user-friends" step="1" />

                        <!-- Maximum Loans Referred to a Guarantor -->
                        <x-form.input id="maxGuarantor" name="maxGuarantor"
                            label="Maximum Active Loans Referred to a Guarantor:" type="number"
                            placeholder="Enter maximum loans a guarantor can refer e.g., 10" icon="fas fa-user-shield"
                            step="1" />

                        <!-- Minimum Savings Per Guarantor -->
                        <x-form.input id="minSavingsGuarantor" name="minSavingsGuarantor"
                            label="Minimum Savings Per Guarantor:" type="number"
                            placeholder="Enter minimum savings per guarantor e.g., 500,000" icon="fas fa-money-check-alt"
                            step="0.01" />
                    </div>
                </div>


                {{-- Step 3 --}}
                <div class="step hidden" id="step3">
                    <p class="text-green-700 font-semibold text-2xl mb-6">
                        <strong>Step 3:</strong> Admin Account Information
                    </p>
                    <x-form.input id="first_name" name="first_name" label="First Name:" type="text"
                        placeholder="First Name" icon="fas fa-user" class="required" />

                    <x-form.input id="last_name" name="last_name" label="Last Name:" type="text"
                        placeholder="Last Name" icon="fas fa-user" class="required" />

                    <x-form.input id="admin_email" name="admin_email" label="Email:" type="email"
                        placeholder="Admin Email" icon="fas fa-envelope" class="required" />

                    <!-- Phone Number Field -->
                    <x-form.input id='phone_number' name='phone_number' label='' type='tel'
                        placeholder='Phone Number' icon='fas fa-phone' value='' :required='true' />

                    {{-- Date of Birth field --}}
                    <x-form.input id='Date_OF_Birth' name='Date_OF_Birth' label='' type='date'
                        placeholder='Date_OF_Birth' icon='fas fa-calendar' value='' :required='true' />

                    {{-- Address location field --}}
                    <x-form.input id='Address' name='Address' label='' type='text' placeholder='Address'
                        icon='fas fa-location-pin' value='' :required='true' />
                    <x-form.input id="password" name="password" label="Password:" type="password"
                        placeholder="New Password" icon="fas fa-lock" class="required" />

                    <x-form.input id="password_confirmation" name="password_confirmation" label="Confirm Password:"
                        type="password" placeholder="Confirm Password" icon="fas fa-lock" class="required" />
                </div>
                {{-- Submit & Navigation Buttons --}}
                <div class="flex justify-end items-center mt-8 gap-4">
                    <!-- Previous Step Button -->
                    <x-form.button width="35" id="prevBtn" color="gray" icon="fas fa-chevron-left">
                        Previous Step
                    </x-form.button>
                    <!-- Next Step Button -->
                    <x-form.button width="35" id="nextBtn" color="green" icon="fas fa-chevron-right">
                        Next Step
                    </x-form.button>
                </div>

            </form>

        </div>

    @endsection

</x-layout>
