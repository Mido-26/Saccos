@props([
    'icon',
    'bgColor',
    'title',
    'value',
    'link' => '#' // Default value for link
])

<div class="bg-white hover:bg-green-50 shadow-lg rounded-lg px-6 py-4">
    <div class="flex items-center justify-between">
        <div class="p-4 {{ $bgColor }} rounded-lg w-12 h-12 flex items-center justify-center">
            <i class="{{ $icon }} text-white text-2xl"></i>
        </div>
        <div class="ml-4 flex-1">
            <h4 class="text-md font-semibold text-gray-600">{{ $title }}</h4>
            <p class="text-xl font-bold">{{ $value }}</p>
        </div>
        <div class="mt-1 text-right self-end">
            <a href="{{ $link }}" class="text-gray-500 font-semibold text-sm hover:underline">
                View More &rarr;
            </a>
        </div>
    </div>
    
</div>
