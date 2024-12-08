<x-layout>

@section('title', 'Loan Details')
@section('name', 'Loan Details')
@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Loan Details</h2>

        <!-- Loan Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Loan ID -->
            <div>
                <p class="text-sm text-gray-600 font-semibold">Loan ID:</p>
                <p class="text-lg text-gray-800">{{ $loan->id }}</p>
            </div>

            <!-- Loan Type -->
            <div>
                <p class="text-sm text-gray-600 font-semibold">Loan Type:</p>
                <p class="text-lg text-gray-800">{{ $loan->loanscartegory->loanName }}</p>
            </div>

            <!-- Borrower -->
            <div>
                <p class="text-sm text-gray-600 font-semibold">Borrower:</p>
                <p class="text-lg text-gray-800">
                    <a href="{{ route('members.show', $loan->user->id) }}" class="text-blue-500 hover:underline">
                        {{ $loan->user->first_name }} {{ $loan->user->last_name }}
                    </a>
                </p>
            </div>

            <!-- Principal Amount -->
            <div>
                <p class="text-sm text-gray-600 font-semibold">Principal Amount (TZS):</p>
                <p class="text-lg text-gray-800">{{ number_format($loan->principal_amount, 2) }}</p>
            </div>

            <!-- Total Amount Payable -->
            <div>
                <p class="text-sm text-gray-600 font-semibold">Total Amount Payable (TZS):</p>
                <p class="text-lg text-gray-800">{{ number_format($loan->amount, 2) }}</p>
            </div>

            <!-- Repayment Period -->
            <div>
                <p class="text-sm text-gray-600 font-semibold">Repayment Period:</p>
                <p class="text-lg text-gray-800">{{ number_format($loan->duration_in_days / 30) }} Months</p>
            </div>

            <!-- Interest Rate -->
            <div>
                <p class="text-sm text-gray-600 font-semibold">Interest Rate (%):</p>
                <p class="text-lg text-gray-800">{{ $loan->interest_rate }}</p>
            </div>

            <!-- Status -->
            <div>
                <p class="text-sm text-gray-600 font-semibold">Status:</p>
                <span
                    class="inline-block px-3 py-1 rounded text-sm font-semibold {{ $loan->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : ($loan->status === 'approved' ? 'bg-green-100 text-green-800' : ($loan->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-blue-100 text-blue-800')) }}">
                    {{ ucfirst($loan->status) }}
                </span>
            </div>

            <!-- Created and Updated Information -->
            <div>
                <p class="text-sm text-gray-600 font-semibold">Created By:</p>
                <p class="text-lg text-gray-800">{{ $loan->created_by }}</p>
                <p class="text-sm text-gray-600">Created At: {{ $loan->created_at->format('d M Y') }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 font-semibold">Last Updated:</p>
                <p class="text-lg text-gray-800">{{ $loan->updated_by }}</p>
                <p class="text-sm text-gray-600">Updated At: {{ $loan->updated_at->format('d M Y') }}</p>
            </div>
        </div>

        <!-- Loan Timeline -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Loan Timeline</h3>
            <ul class="list-disc pl-5 text-gray-700">
                <li>Applied on: {{ $loan->created_at->format('d M Y') }}</li>
                <li>Approved on: {{ $loan->approved_at ? $loan->approved_at->format('d M Y') : 'N/A' }}</li>
                <li>Disbursed on: {{ $loan->disbursed_at ? $loan->disbursed_at->format('d M Y') : 'N/A' }}</li>
            </ul>
        </div>

        <!-- Status Change Buttons -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Change Loan Status</h3>
            <div class="flex space-x-4">
                @if ($loan->status !== 'approved' && $loan->status !== 'disbursed')
                    <!-- Approve Button -->
                    <form action="{{ route('loans.changeStatus', ['loan' => $loan->id, 'status' => 'approved']) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                            Approve
                        </button>
                    </form>
                @endif

                @if ($loan->status !== 'rejected' && $loan->status !== 'disbursed')
                    <!-- Reject Button -->
                    <form action="{{ route('loans.changeStatus', ['loan' => $loan->id, 'status' => 'rejected']) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                            Reject
                        </button>
                    </form>
                @endif

                @if ($loan->status !== 'disbursed')
                    <!-- Disburse Button -->
                    <form action="{{ route('loans.changeStatus', ['loan' => $loan->id, 'status' => 'disbursed']) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                            Disburse
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Admin Logs -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Action Logs</h3>
            <p class="text-gray-600">No logs available.</p>
        </div>
    </div>
@endsection
</x-layout>