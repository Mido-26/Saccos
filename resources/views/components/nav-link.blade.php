@props([
    'href' => '#', // Default URL
    'icon' => null, // Optional icon
    'class' => '', // Additional CSS classes
    'color' => 'green'
])

<a href="{{ $href }}" class="bg-{{$color}}-500 text-white px-4 py-2 rounded-xl hover:bg-{{$color}}-800 {{ $class }}">
    @if ($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</a>
