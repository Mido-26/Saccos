<x-layout>
@section('title', 'Transactions Overview')
@section('name', 'Transactions Overview')
@section('content')
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="flex items-center justify-between my-4">
            <h2 class="text-xl font-semibold text-gray-800">Total Transaction Amount: <span class="text-green-600">{{ number_format($total, 2)}} TZS</span>
            </h2>
            <x-nav-link href="{{ route('transactions.create') }} " icon=" fa-solid fa-circle-plus ">
                Add New Transaction
            </x-nav-link>
        </div>

       
            <x-table :headers="[
                ['label' => 'ID', 'sortable' => true],
                ['label' => 'Account Owner', 'sortable' => true],
                ['label' => 'Amount (TZS)', 'sortable' => true],
                ['label' => 'Transaction Type'],
                ['label' => 'Date'],
                ]" :rows="$transactions
                ->map(
                    fn($transaction) => [
                        'ID' => $transaction->id,
                        'Account Owner' => $transaction->user->first_name . ' ' . $transaction->user->last_name,
                        'Amount (TZS)' => number_format($transaction->amount, 2),
                        'Transaction Type' => view('components.status-badge', ['status' => $transaction->type]),
                        'Date' => \Carbon\Carbon::parse($transaction->created_at)->format('d M Y H:i'),                        
                    ],
                    )
                    ->toArray()" selectable :actions="fn($row) => view('components.action-buttons', ['data' => $row, 'route' => 'transactions'])"
        />
            <!-- Pagination Links -->
            <div class="mt-4 border-t border-gray-400 pt-2">
                {{ $transactions->links('pagination::tailwind') }}
            </div>
        
    </div>
@endsection
</x-layout>