@props(['hidden' => false , 'id', 'name', 'type' => 'text', 'label', 'placeholder' => '', 'icon' => null, 'value' => null, 'required' => false, 'step' => null])

<div class="mb-4 {{ $hidden ? 'hidden' : '' }}">
    <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <div class="relative">
        @if($icon)
            <i class="{{ $icon }} absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        @endif
        <input 
            type="{{ $type }}" 
            name="{{ $name }}" 
            id="{{ $id }}" 
            value="{{ $value ?? old($name) }}" 
            {{ $attributes->merge(['class' => 'w-full border border-gray-300 rounded-lg ' . ($icon ? 'pl-10' : 'pl-3') . ' py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500']) }}
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
        >
    </div>
    <span class="error text-red-500 text-sm hidden"></span>
    @error($name)
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
