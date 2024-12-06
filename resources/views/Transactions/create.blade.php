<x-layout>
    @section('title', 'Create Transaction')
    @section('name', 'Create Transaction')
    @section('content')
        <div class="bg-white px-4 py-3 shadow-md rounded-lg w-full max-w-full">
            <form action="{{ route('transactions.store') }}" method="POST" class="space-y-6">
                @csrf
                @include('components.sess_msg')
                {{-- User ID --}}
                {{-- @dump($users) --}}
                   
                <x-form.select-field name="user_id" label="User Account" :options="$users" placeholder="Select a user" icon="fas fa-user"
                    :required="true" />

                {{-- Transaction Type --}}
                <x-form.select-field name="type" label="Transaction Type" :options="[
                    'deposit' => 'Deposit',
                    'withdrawal' => 'Withdrawal',
                    'loan_payment' => 'Loan Payment',
                    'loan_disbursement' => 'Loan Disbursement',
                ]"
                    placeholder="Select a transaction type" icon="fas fa-exchange-alt" :required="true" />

                {{-- Amount --}}
                <x-form.input id="amount" name="amount" label="Amount" type="number"
                    placeholder="Enter the transaction amount" icon="fas fa-dollar-sign" step="0.01" :required="true" />

                {{-- Payment Method --}}
                <x-form.select-field name="payment_method" label="Payment Method" :options="['bank_transfer' => 'Bank Transfer', 'mobile_money' => 'Mobile Money', 'cash' => 'Cash']"
                    placeholder="Select a payment method" icon="fas fa-wallet" :required="true" />

                {{-- Currency --}}
                {{-- <x-form.select-field name="currency" label="Currency" :options="['TZS' => 'Tanzanian Shilling', 'USD' => 'US Dollar', 'EUR' => 'Euro']" placeholder="Select a currency"
                    icon="fas fa-money-bill-wave" :required="true" :selected="'TZS'" /> --}}

                {{-- Description --}}
                <x-form.text-area id="description" name="description" label="Description"
                    placeholder="Enter a detailed description" icon="fas fa-comment" :required="true" rows="5" />

                {{-- Submit Button --}}
                <x-form.button icon="fas fa-save"> Submit Transaction </x-form.button>
            </form>


        </div>

        <script>
            const form = document.getElementById('transactionForm');
            const savingsInput = document.getElementById('savings_account');
            const datalist = document.getElementById('savings_list');
            const errorMessage = document.getElementById('error-message');

            form.addEventListener('submit', function(e) {
                const options = Array.from(datalist.options).map(option => option.value);
                if (!options.includes(savingsInput.value)) {
                    e.preventDefault();
                    errorMessage.classList.remove('hidden');
                    savingsInput.classList.add('border-red-500');
                } else {
                    errorMessage.classList.add('hidden');
                    savingsInput.classList.remove('border-red-500');
                }
            });
        </script>

    @endsection
</x-layout>
