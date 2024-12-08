@include('components.header')
@include('components.nav')
@include('components.nav-top')
<main class="p-4 bg-gray-100 h-full flex-1">
    @yield('content')
</main>
@include('components.footer')
