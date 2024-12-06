@props(['id' => null, 'type' => 'submit', 'color' => 'green', 'icon' => null, 'width' => 'full'])

<button 
    @if ($id)
        id="{{  $id }}"
    @endif
    type="{{ $type }}" 
    class="w-{{ $width }} bg-{{ $color }}-500 text-white font-semibold py-2 px-4 rounded-lg 
           hover:bg-{{ $color }}-700 focus:outline-none focus:ring-2 focus:ring-{{ $color }}-500"
>
    @if ($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $slot }}
</button>
