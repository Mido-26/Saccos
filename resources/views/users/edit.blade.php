<x-layout>
    @section('title', 'Edit Member')
    @section('name', 'Edit Member')
    @section('content')
        {{-- @include('layouts.back') --}}
        <div class="bg-white p-6 shadow-md rounded gap-4">
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
            <div class="border-t border-gray-500 mt-4 pt-4"></div>
            <!-- Form to Register User -->
            @include('components.sess_msg')
            <form action="{{ route('users.update', $user->id) }}" method="post" class="max-w-md mb-6 ">
                @csrf
                @method('PATCH')

                <!-- First Name Field -->
                <x-form.input id='first_name' name='first_name' label='' type='text' placeholder='First Name'
                    icon='fas fa-user' value='{{ $user->first_name }}' :required='true' />

                <!-- Last Name Field -->
                <x-form.input id='last_name' name='last_name' label='' placeholder='Last Name' icon='fas fa-user'
                    value='{{ $user->last_name }}' :required='true' />

                <!-- Email Field -->
                <x-form.input id='email' name='email' label='' type='email' placeholder='Email'
                    icon='fas fa-envelope' value='{{ $user->email }}' :required='true' />

                <!-- Phone Number Field -->
                <x-form.input id='phone_number' name='phone_number' label='' type='tel' placeholder='Phone Number'
                    icon='fas fa-phone' value='{{ $user->phone_number }}' :required='true' />

                {{-- Date of Birth field --}}
                <x-form.input id='Date_OF_Birth' name='Date_OF_Birth' label='' type='date'
                    placeholder='Date_OF_Birth' icon='fas fa-calendar' value='{{ $user->Date_OF_Birth }}'
                    :required='true' />

                {{-- Address location field --}}
                <x-form.input id='Address' name='Address' label='' type='text' placeholder='Address'
                    icon='fas fa-location-pin' value='{{ $user->Address }}' :required='true' />

                <!-- Submit Button -->
                <x-form.button icon="fas fa-edit"> Update Member </x-form.button>
            </form>
            <div class="border-t border-gray-500 mt-4 pt-4"></div>
            <div class="flex justify-start items-center rounded-t-lg gap-4">
                <!-- Status Toggle Button -->
                <div class="mb-4">
                    <form action="{{ route('users.updateAction', ['user' => $user->id, 'todo' => 'status']) }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        {{-- <button type="submit"
                            class="{{ $user->status === 'active' ? 'bg-gray-500 hover:bg-gray-800' : 'bg-green-600 hover:bg-green-800' }} text-white px-4 py-2 rounded-xl">
                            <i class="fas {{ $user->status === 'active' ? 'fa-lock' : 'fa-lock-open' }} mr-2"></i>
                            {{ $user->status === 'active' ? 'Deactivate account' : 'Activate account' }}
                        </button> --}}
                        <x-form.button :color="$user->status === 'active' ? 'gray' : 'green'" :icon="'fas ' . ($user->status === 'active' ? 'fa-lock' : 'fa-lock-open')">
                            {{ $user->status === 'active' ? 'Deactivate Account' : 'Activate Account' }}
                        </x-form.button>

                    </form>
                </div>

                <!-- Reset Password Button -->
                <div class="mb-4">
                    <form action="{{ route('users.updateAction', ['user' => $user->id, 'todo' => 'reset']) }}"
                        method="POST">
                        @csrf
                        @method('PATCH')
                        
                        <x-form.button color='red' icon="fas fa-trash-alt"> Reset Password </x-form.button>
                    </form>
                </div>
            </div>

        </div>
    @endsection
</x-layout>
