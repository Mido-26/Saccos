@props(['status'])

@php
    $statusClasses = [
        'pending' => 'bg-yellow-100 text-yellow-800',
        'approved' => 'bg-green-100 text-green-800',
        'rejected' => 'bg-red-100 text-red-800',
        'disbursed' => 'bg-blue-100 text-blue-800',
        'active' => 'border-1 bg-green-100 text-green-800',
        'inactive' => 'border-1 bg-red-100 text-red-800',
    ];
@endphp

<span class="px-2 py-1 text-sm font-semibold rounded {{ $statusClasses[$status] ?? 'bg-gray-100 text-gray-800' }}">
    <i class="fas fa-circle mr-1"></i>
     {{ ucfirst($status) }}
</span>
