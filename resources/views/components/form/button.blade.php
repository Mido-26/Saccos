@props(['type' => 'submit', 'color' => 'green', 'icon' => null])

<button 
    type="{{ $type }}" 
    class="w-full bg-{{ $color }}-600 text-white font-semibold py-2 px-4 rounded-lg 
           hover:bg-{{ $color }}-700 focus:outline-none focus:ring-2 focus:ring-{{ $color }}-500"
>
    @if ($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</button>
