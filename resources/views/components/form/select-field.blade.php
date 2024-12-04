{{-- components/select-field.blade.php --}}
@props(['label', 'name', 'options', 'selected' => null, 'icon' => null, 'placeholder' => 'Select an option', 'required' => false])

<div class="space-y-1">
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <div class="relative">
        @if($icon)
            <i class="{{ $icon }} absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
        @endif
        <select 
            name="{{ $name }}" 
            id="{{ $name }}" 
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge(['class' => 'w-full border border-gray-300 rounded-lg py-2 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500']) }}
        >
            <option value="" disabled {{ is_null($selected) ? 'selected' : '' }}>{{ $placeholder }}</option>
            @foreach($options as $value => $text)
                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>{{ $text }}</option>
            @endforeach
        </select>
    </div>
    @error($name)
        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
    @enderror
</div>
