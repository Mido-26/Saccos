<x-layout>
    @section('title', 'Members')
    @section('name', 'Member Information')
    @section('content')

        <div class="w-full max-w-full bg-white rounded-lg shadow-lg">
            {{-- @include('layouts.back') --}}
            <div class="flex justify-between items-center bg-gradient-to-r from-orange-400 to-gray-600 p-6 rounded-t-lg">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <!-- Profile Picture -->
                        <img src="../../assets/logo/logo2.png" alt="Profile Picture"
                            class="w-20 h-20 rounded-full border-4 border-white mx-auto sm:mx-0">
                        <!-- Edit Icon -->
                        <div class="absolute bottom-0 right-0 bg-white p-1 rounded-full">
                            <i class="fas fa-camera text-green-400"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- user information --}}

            <div class="border-t border-gray-300 mt-2 py-6 px-4">
                <div class="flex items-center justify-start gap-4 mb-4">
                    <span class="font-bold text-black">Name:</span>
                    <p class=" font-bold text-lg text-gray-500"> <span>{{ $user->first_name }}</span>
                        <span>{{ $user->last_name }}</span>
                    </p>
                </div>

                <div class="flex items-center justify-start gap-4 mb-4">
                    <span class="font-bold text-black">Email:</span>
                    <p class=" font-bold text-lg text-gray-500"> <span>{{ $user->email }}</span></p>
                </div>

                <div class="flex items-center justify-start gap-4 mb-4">
                    <span class="font-bold text-black">Tel:</span>
                    <p class="font-bold text-lg text-gray-500"> <span>{{ $user->phone_number }}</span></p>
                </div>

                <div class="flex items-center justify-start gap-4 mb-4">
                    <span class="font-bold text-black">DOB:</span>
                    <p class="font-bold text-lg text-gray-500"> <span>{{ $user->Date_OF_Birth }}</span></p>
                </div>

                <div class="flex items-center justify-start gap-4 mb-4">
                    <span class="font-bold text-black">Address:</span>
                    <p class="font-bold text-lg text-gray-500">
                    <Address>{{ $user->Address }}</Address>
                    </p>
                </div>

                <div class="flex items-center justify-start gap-4 mb-4">
                    <span class="font-bold text-black">Role:</span>
                    <p class=" font-bold text-lg text-gray-500"> <span>{{ $user->role }}</span></p>
                </div>

                <div class="flex items-center justify-start gap-4 mb-4">
                    <span class="font-bold text-black">Status:</span>
                    <p class=" font-bold text-lg ">
                        @if ($user->status === 'active')
                            <span
                                class="inline-flex items-center px-3 py-0.5 rounded-full text-md font-medium bg-green-100 text-green-800">
                                {{ ucfirst($user->status) }}
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-0.5 rounded-full text-md font-medium bg-red-100 text-red-800">
                                {{ ucfirst($user->status) }}
                            </span>
                        @endif
                    </p>
                </div>

                <div class="flex items-center justify-start gap-4 mb-4">
                    <span class="font-bold text-black">Created At:</span>
                    <p class=" font-bold text-lg text-gray-500"> <span>{{ $user->created_at }}</span></p>
                </div>

                <div class="flex items-center justify-start gap-4 mb-4">
                    <!-- Update Icon -->
                    <a href="{{ route('users.edit', $user->id) }}"
                        class="inline-flex items-center px-3 py-0.5 gap-2 rounded-full text-white bg-yellow-500 hover:bg-yellow-800"
                        title="Update Member">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <!-- Delete Icon -->
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-block"
                        title="Delete Member">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center px-3 py-0.5 rounded-full gap-2 text-white hover:text-white bg-red-600 hover:bg-red-800"
                            title="Delete Member">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

    @endsection
</x-layout>
