<x-layout>
    @section('title', 'Savings')
    @section('name', 'Savings Overview')
    @section('content')
        {{-- @include('layouts.back') --}}

        <x-table :headers="[
                ['label' => 'ID', 'sortable' => true],
                ['label' => 'Member', 'sortable' => true],
                ['label' => 'Account Balance (TZS)', 'sortable' => true],
                ['label' => 'Interest Earned'],
                ['label' => 'Last Deposit Date'],
                ]" :rows="$savings
                ->map(
                    fn($saving) => [
                        'ID' => $saving->id,
                        'Member' => $saving->user->first_name . ' ' . $saving->user->last_name,
                        'Account Balance (TZS)' => number_format($saving->account_balance, 2),
                        'Interest Earned' => number_format($saving->interest_earned, 2),
                        'Last Deposit Date' => \Carbon\Carbon::parse($saving->last_deposit_date)->format('d M Y'),                        
                    ],
                    )
                    ->toArray()" selectable :actions="fn($row) => view('components.action-buttons', ['data' => $row, 'route' => 'savings'])"
        />
            <!-- Pagination Links -->
            <div class="mt-4 border-t border-gray-400 pt-2">
                {{ $savings->links('pagination::tailwind') }}
            </div>
    @endsection
</x-layout>
