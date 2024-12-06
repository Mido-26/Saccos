<x-layout>
@section('title', 'Transaction Overview')
@section('name', 'Transaction Overview')

@section('content')
    {{-- @include('components.back') --}}

    <div class="bg-white shadow-md rounded-lg mb-6 p-6">
        <!-- Header Section -->
        <div class="border-b pb-4 mb-4">
            <div class="flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-800">
                    Transaction Information
                    <span class="text-gray-500 text-sm">(ID: {{ $transaction->id }})</span>
                </h3>
                {{-- <a href="{{ route('transactions.edit', $transaction->id) }}" 
                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-full text-sm flex items-center shadow"
                   title="Edit Transaction">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a> --}}
                <x-nav-link href="{{ route('transactions.edit', $transaction->id) }}" color="yellow" icon=" fas fa-edit">
                    Edit
                </x-nav-link>
            </div>
        </div>
    
        <!-- Content Section -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Transaction Overview -->
            <div class="space-y-3">
                <p class="flex items-center">
                    <span class="font-semibold text-gray-800 w-40">Account Holder:</span>
                    {{ $transaction->user->first_name }} {{ $transaction->user->last_name }}
                </p>
                <p class="flex items-center">
                    <span class="font-semibold text-gray-800 w-40">Amount:</span>
                    <span class="text-green-600 font-semibold">
                        {{ number_format($transaction->amount, 2) }} TZS
                    </span>
                </p>
                <p class="flex items-center">
                    <span class="font-semibold text-gray-800 w-40">Transaction Type:</span>
                    <span class="{{ $transaction->type === 'deposit' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }} px-3 py-1 rounded-full text-xs font-semibold">
                        {{ ucfirst($transaction->type) }}
                    </span>
                </p>
            </div>
    
            <!-- Payment & Status Information -->
            <div class="space-y-3">
                <p class="flex items-center">
                    <span class="font-semibold text-gray-800 w-40">Payment Method:</span>
                    {{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}
                </p>
                <p class="flex items-center">
                    <span class="font-semibold text-gray-800 w-40">Status:</span>
                    <span class="{{ 'completed' === 'completed' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }} px-3 py-1 rounded-full text-xs font-semibold">
                        {{ ucfirst('N/A') }}
                    </span>
                </p>
                <p class="flex items-center">
                    <span class="font-semibold text-gray-800 w-40">Transaction Date:</span>
                    {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y, h:i:s A') }}
                </p>
            </div>
    
            <!-- Completion & Initiator Info -->
            <div class="space-y-3">
                <p class="flex items-center">
                    <span class="font-semibold text-gray-800 w-40">Completed At:</span>
                    {{ $transaction->completed_at ? \Carbon\Carbon::parse($transaction->completed_at)->format('d M Y, h:i:s A') : 'Pending' }}
                </p>
                <p class="flex items-center">
                    <span class="font-semibold text-gray-800 w-40">Initiator:</span>
                    {{ $transaction->initiator->first_name ?? 'N/A' }} {{ $transaction->initiator->last_name ?? '' }}
                </p>
                <p class="flex items-center">
                    <span class="font-semibold text-gray-800 w-40">Transaction Reference:</span>
                    {{ $transaction->transaction_reference }}
                </p>
            </div>
        </div>
    
        <!-- Description Section -->
        <div class="mt-6 border-t pt-4">
            <h4 class="text-lg font-semibold text-gray-800 mb-2">Transaction Description</h4>
            <p class="text-gray-700 text-sm">
                {{ $transaction->description ?? 'No description provided.' }}
            </p>
        </div>
    </div>
    
    
@endsection
</x-layout>