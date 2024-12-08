<x-layout>

@section('title', 'Loan Overview')
@section('name', 'Loan Overview')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-semibold text-gray-800">All Loans</h2>
        {{-- <button class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 flex items-center">
            <i class="fas fa-plus mr-2"></i> Add New Loan
        </button> --}}
    </div>

    <!-- Search and Filters -->
    <div class="mb-4 flex flex-wrap items-center justify-between gap-4">
        <div class="relative w-full sm:w-auto">
            <input type="text" id="search" placeholder="Search loans..." class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-green-300">
            <i class="fas fa-search absolute right-4 top-3 text-gray-400"></i>
        </div>
        <div class="flex items-center space-x-2">
            <select id="status-filter" class="border rounded-lg px-4 py-2">
                <option value="">Filter by Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
                <option value="disbursed">Disbursed</option>
            </select>
            <select id="period-filter" class="border rounded-lg px-4 py-2">
                <option value="">Filter by Repayment Period</option>
                <option value="short">Short-term (&lt; 12 months)</option>
                <option value="long">Long-term (&ge; 12 months)</option>
            </select>
        </div>
        <div class="flex space-x-2">
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-file-csv mr-2"></i> Export CSV
            </button>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 flex items-center">
                <i class="fas fa-file-pdf mr-2"></i> Export PDF
            </button>
        </div>
    </div>

    <!-- Loan Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">
                        <input type="checkbox" id="select-all" class="form-checkbox">
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border cursor-pointer">
                        Loan ID <i class="fas fa-sort"></i>
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border cursor-pointer">
                        Loan Type <i class="fas fa-sort"></i>
                    </th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Amount (TZS)</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Repayment Period</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Interest Rate (%)</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Status</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($loans->isEmpty())
                    <tr>
                        <td colspan="8" class="text-center text-gray-600 py-6">No loans available at the moment.</td>
                    </tr>
                @else
                    @foreach ($loans as $loan)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 border">
                                <input type="checkbox" class="form-checkbox select-row">
                            </td>
                            <td class="px-4 py-2 border">{{ $loan->id }}</td>
                            <td class="px-4 py-2 border">{{ $loan->loanscartegory->loanName }}</td>
                            <td class="px-4 py-2 border">{{ number_format($loan->amount, 2) }}</td>
                            <td class="px-4 py-2 border">{{ number_format($loan->duration_in_days / 30) }} Months</td>
                            <td class="px-4 py-2 border">{{ $loan->interest_rate }}</td>
                            <td class="px-4 py-2 border">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'approved' => 'bg-green-100 text-green-800',
                                        'rejected' => 'bg-red-100 text-red-800',
                                        'disbursed' => 'bg-blue-100 text-blue-800',
                                    ];
                                @endphp
                                <span class="px-2 py-1 text-sm font-semibold rounded {{ $statusClasses[$loan->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    <i class="fas fa-circle mr-1"></i> {{ ucfirst($loan->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2 border">
                                <div class="flex space-x-2">
                                    <!-- View Loan Details -->
                                    <a href="{{ route('loans.show', $loan->id) }}" 
                                       class="bg-green-500 text-white py-1 px-3 rounded-lg hover:bg-green-600 flex items-center">
                                        <i class="fas fa-eye"></i>
                                    </a>
                            
                                    <!-- Edit Loan -->
                                    <a href="{{ route('loans.edit', $loan->id) }}" 
                                       class="bg-yellow-500 text-white py-1 px-3 rounded-lg hover:bg-yellow-600 flex items-center">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                            
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $loans->links() }}
    </div>
@endsection
</x-layout>