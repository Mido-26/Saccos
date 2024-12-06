<x-layout>
    @section('title', 'Edit Transaction')
    @section('name', 'Edit Transaction')
    @section('content')
        {{-- @include('components.back') --}}
        <div class="bg-white px-4 py-3 shadow-md rounded-lg w-full max-w-full">


            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                @include('components.sess_msg')

                {{-- User ID --}}
                <x-form.select-field name="user_id" label="User Account" :options="$users" placeholder="Select a user"
                    icon="fas fa-user" :selected="old('user_id', $transaction->user_id)" :required="true" />

                {{-- Transaction Type --}}
                <x-form.select-field name="type" label="Transaction Type" :options="[
                    'deposit' => 'Deposit',
                    'withdrawal' => 'Withdrawal',
                    'loan_payment' => 'Loan Payment',
                    'loan_disbursement' => 'Loan Disbursement',
                ]"
                    placeholder="Select a transaction type" icon="fas fa-exchange-alt" :selected="old('type', $transaction->type)"
                    :required="true" />

                {{-- Amount --}}
                <x-form.input id="amount" name="amount" label="Amount" type="number"
                    placeholder="Enter the transaction amount" icon="fas fa-dollar-sign" step="0.01" :value="old('amount', $transaction->amount)"
                    :required="true" />

                {{-- Payment Method --}}
                <x-form.select-field name="payment_method" label="Payment Method" :options="[
                    'bank_transfer' => 'Bank Transfer',
                    'mobile_money' => 'Mobile Money',
                    'cash' => 'Cash',
                ]"
                    placeholder="Select a payment method" icon="fas fa-wallet" :selected="old('payment_method', $transaction->payment_method)" :required="true" />

                {{-- Description --}}
                <x-form.text-area id="description" name="description" label="Description"
                    placeholder="Enter a detailed description" icon="fas fa-comment" rows="3" :value="old('description', $transaction->description)"
                    :required="true" />

                {{-- Submit Button --}}
                <x-form.button icon="fas fa-save"> Update Transaction </x-form.button>
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

        <script>
            $(document).ready(function() {
                $('#savings_account').select2({
                    placeholder: "Select Account",
                    allowClear: true,
                    width: '100%' // Makes the dropdown fit the container width
                });
            });
        </script>

    @endsection
</x-layout>
