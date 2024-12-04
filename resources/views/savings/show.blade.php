<x-layout>
    @section('title', 'Savings Overview')
    @section('name', 'Savings Overview')

    @section('content')
        {{-- @include('components.back') --}}

        <div class="bg-white shadow-md rounded-lg mb-6 p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Savings Account Details (ID: {{ $saving->id }})</h3>
            </div>

            <div class="text-sm text-gray-700 space-y-3">
                <p><strong>Account Holder:</strong> {{ $saving->user->first_name }} {{ $saving->user->last_name }}</p>
                <p><strong>Current Balance:</strong> {{ number_format($saving->account_balance, 2) }} TZS</p>
                <p><strong>Total Interest Earned:</strong> {{ number_format($saving->interest_earned, 2) }} TZS</p>
                <p><strong>Most Recent Deposit:</strong>
                    {{ \Carbon\Carbon::parse($saving->last_deposit_date)->format('d M Y') }}</p>
            </div>
        </div>
    @endsection
</x-layout>
