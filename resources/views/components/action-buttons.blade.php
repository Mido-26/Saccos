@props(['data', 'route'])

<div class="flex space-x-2">
    {{-- Show Button --}}
    <a href="{{ route("{$route}.show", $data['ID']) }}" 
       class="bg-blue-500 text-white py-1 px-3 rounded-lg hover:bg-blue-600 flex items-center">
        <i class="fas fa-eye mr-1"></i>
    </a>

    {{-- Edit Button --}}
    {{-- <a href="{{ route("{$route}.edit", $data['ID']) }}" 
       class="bg-yellow-500 text-white py-1 px-3 rounded-lg hover:bg-yellow-600 flex items-center">
        <i class="fas fa-edit mr-1"></i>
    </a> --}}
</div>
