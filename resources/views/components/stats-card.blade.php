<!-- resources/views/components/stats-card.blade.php -->
<div class="bg-white shadow-lg rounded-lg px-6 py-4">
    <div class="flex items-center">
        <div class="p-4 {{ $bgColor }} rounded-lg w-12 h-12 flex items-center justify-center">
            <i class="fas {{ $icon }} text-white text-2xl"></i>
        </div>
        <div class="ml-4">
            <h4 class="text-lg font-semibold text-gray-600">{{ $title }}</h4>
            <p class="text-2xl font-bold">{{ $value }}</p>
        </div>
    </div>
</div>
