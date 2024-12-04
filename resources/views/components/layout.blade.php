@include('components.header')
@include('components.nav')
@include('components.nav-top')
<main class="p-6 bg-gray-100 min-h-screen flex-1">
    @yield('content')
</main>
@include('components.footer')
