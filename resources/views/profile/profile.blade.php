<x-layout>
    @section('title', 'Edit Member')
    @section('name', 'Your Profile')
    @section('content')
        <div class="bg-white px-6 py-4 shadow-md rounded gap-4">
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
            <!-- Form to view  User profile -->
            @include('components.sess_msg')
            @if (session('success1'))
                <div class="bg-green-50 text-green-500 py-2 px-4 rounded mb-4">
                    {{ session('success1') }}
                </div>
            @endif
           
            <form action="{{ route('profile.update', $user->id) }}" method="post" class="max-w-md mb-6 ">
                @csrf
                @method('PATCH')
                <h2 class="text-lg font-semibold mb-4">Profile Information</h2>

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
                <x-form.input id='date_of_birth' name='date_of_birth' label='' type='date'
                    placeholder='Date OF Birth' icon='fas fa-calendar' value='{{ $user->Date_OF_Birth }}'
                    :required='true' />

                {{-- Address location field --}}
                <x-form.input id='Address' name='Address' label='' type='text' placeholder='Address'
                    icon='fas fa-location-pin' value='{{ $user->Address }}' :required='true' />

                <!-- Submit Button -->
                <x-form.button icon="fas fa-edit"> Update Your Profile </x-form.button>
            </form>
            <div class="border-t border-gray-500 mt-4 pt-4"></div>

            @if (session('success2'))
                <div class="bg-green-50 text-green px-4 py-2 rounded mb-4">
                    {{ session('success2') }}
                </div>
            @endif
            <!-- Password Update Form -->
            <form action="{{ route('profile.updatePassword', $user->id) }}" method="post" class="max-w-md mb-6">
                @csrf
                @method('PATCH')
                <h2 class="text-lg font-semibold mb-4">Change Password</h2>

                <!-- Current Password -->
                <x-form.input id='CurrentPassword' name='CurrentPassword' label='Current Password' type='password'
                    placeholder='Current Password' icon='fas fa-lock' :required='true' />
                <!-- New Password -->
                <x-form.input id='NewPassword' name='NewPassword' label='New Password' type='password'
                    placeholder='New Password' icon='fas fa-lock' :required='true' />

                <!-- Confirm Password -->
                <x-form.input id='NewPassword_confirmation' name='NewPassword_confirmation' label='Confirm Password'
                    type='password' placeholder='Confirm Password' icon='fas fa-lock' :required='true' />

                <!-- Change Password Button -->
                <x-form.button icon="fas fa-edit">Update Your Password </x-form.button>
            </form>
        </div>
    @endsection
</x-layout>
