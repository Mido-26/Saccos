<x-layout>
    @section('title', 'Create Member')
    @section('name', 'Register Member')
    @section('content')
        <div class="bg-white p-6 shadow-md rounded">


            <!-- Form to Register User -->
            @include('components.sess_msg')
            <form action="{{ route('users.store') }}" method="post" class="max-w-md mb-6">
                @csrf
                @method('POST')
                <h2 class="text-lg font-semibold mb-4">Register Member</h2>
                <!-- First Name Field -->
                <x-form.input id='first_name' name='first_name' label='' type='text' placeholder='First Name'
                    icon='fas fa-user' :required='true' />
                
                <!-- Last Name Field -->
                <x-form.input id='last_name' name='last_name' label='' placeholder='Last Name' icon='fas fa-user'
                    :required='true' />

                <!-- Email Field -->
                <x-form.input id='email' name='email' label='' type='email' placeholder='Email'
                    icon='fas fa-envelope' value='' :required='true' />

                <!-- Phone Number Field -->
                <x-form.input id='phone_number' name='phone_number' label='' type='tel' placeholder='Phone Number'
                    icon='fas fa-phone' value='' :required='true' />

                {{-- Date of Birth field --}}
                <x-form.input id='Date_OF_Birth' name='Date_OF_Birth' label='' type='date'
                    placeholder='Date_OF_Birth' icon='fas fa-calendar' value='' :required='true' />

                {{-- Address location field --}}
                <x-form.input id='Address' name='Address' label='' type='text' placeholder='Address'
                    icon='fas fa-location-pin' value='' :required='true' />

                <!-- Submit Button -->
                <x-form.button icon="fas fa-circle-plus"> Add Member </x-form.button>
            </form>
        </div>



    @endsection
</x-layout>
