<x-layout>
    @section('title', 'Members')
    @section('name', 'Members')

    @section('content')

        {{-- <div class="bg-white p-6 shadow-md rounded w-full overflow-x-auto"> --}}
            <!-- Add Customer Button -->
            <div class="mb-4 text-right">

                <x-nav-link href="{{ route('users.create') }} " icon=" fa-solid fa-circle-plus ">
                    Add New Member
                </x-nav-link>
            </div>

            <!-- Users Table -->
            <x-table :headers="[
                ['label' => 'ID', 'sortable' => true],
                ['label' => 'First Name', 'sortable' => true],
                ['label' => 'Last Name', 'sortable' => true],
                ['label' => 'Email'],
                ['label' => 'Phone Number'],
                ['label' => 'Role'],
                ['label' => 'Status'],
                // ['label' => 'Actions']
                ]" :rows="$users
                ->map(
                    fn($user) => [
                        'ID' => $user->id,
                        'First Name' => $user->first_name,
                        'Last Name' => $user->last_name,
                        'Email' => $user->email,
                        'Phone Number' => $user->phone_number,
                        'Role' => $user->role,
                        'Status' => view('components.status-badge', ['status' => $user->status]),
                        
                    ],
                    )
                    ->toArray()" selectable :actions="fn($row) => view('components.action-buttons', ['data' => $row, 'route' => 'users'])"
            />
            <!-- Pagination Links -->
            <div class="mt-4 border-t border-gray-400 pt-2">
                {{ $users->links('pagination::tailwind') }}
            </div>
        {{-- </div> --}}

    @endsection
</x-layout>
