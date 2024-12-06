<x-layout>
    @section('title', 'Dashboard')
    @section('name', 'Dashboard')
    @section('content')

        @can('viewAdminDashboard')
            @include('components.adminDash')
        @endcan
        @cannot('viewAdminDashboard')
            @include('components.userDashboard')
        @endcannot
    @endsection
</x-layout>
