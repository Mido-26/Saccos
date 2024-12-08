<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <x-stat-card icon="fas fa-users" bgColor="bg-blue-500" title="Total Members" value="{{ $members }}" link="/users/" />

    <x-stat-card icon="fas fa-piggy-bank" bgColor="bg-green-500" title="Total Savings" value="{{ $settings->currency }} {{ $totalSavings}}"
        link="/savings" />

    <x-stat-card icon="fas fa-check-circle" bgColor="bg-yellow-500" title="Loans Completed" value="{{ $completed_loans }}"
        link="/loans/" />

    <x-stat-card icon="fas fa-exclamation-circle" bgColor="bg-red-500" title="Due Loans" value="{{ $defaulted_loans }}"
        link="/loans/" />

    <x-stat-card icon="fas fa-hand-holding-usd" bgColor="bg-indigo-500" title="Active Loans" value="{{ $disbursed_loans }}"
        link="/loans/" />

    {{-- <x-stat-card icon="fas fa-user-plus" bgColor="bg-purple-500" title="New Members" value="45"
        link="/members/new" /> --}}

    <x-stat-card icon="fas fa-donate" bgColor="bg-orange-500" title="Total Contributions" value="TZS {{ $totalContribution }}"
        link="/transactions" />

    <x-stat-card icon="fas fa-clock" bgColor="bg-gray-500" title="Pending Loans" value="{{ $pending_loans }}"
        link="/loans/" />
</div>
