@props([
    'id',
    'name',
    'label' => '',
    'placeholder' => '',
    'icon' => null,
    'value' => null,
    'required' => false,
    'rows' => 4, // Default number of rows
])

<div class="mb-4">
    {{-- Label --}}
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }} @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    {{-- Textarea Wrapper --}}
    <div class="relative">
        {{-- Icon --}}
        @if ($icon)
            <i class="{{ $icon }} absolute left-3 top-4 text-gray-400"></i>
        @endif

        {{-- Textarea --}}
        <textarea 
            name="{{ $name }}" 
            id="{{ $id }}" 
            rows="{{ $rows }}" 
            placeholder="{{ $placeholder }}" 
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => 'w-full border border-gray-300 rounded-lg ' . 
                           ($icon ? 'pl-10' : 'pl-3') . 
                           ' py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 resize-none'
            ]) }}
        >{{ $value ?? old($name) }}</textarea>
    </div>

    {{-- Validation Error --}}
    @error($name)
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
