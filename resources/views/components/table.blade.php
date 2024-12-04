@props([
    'headers' => [], // Array of headers ['label' => 'Loan ID', 'sortable' => true]
    'rows' => [], // Array of data rows
    'noDataMessage' => 'No data available.', // Message to show when no data is available
    'actions' => null, // Optional closure for row actions
    'selectable' => false, // Option to enable row selection
])

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Standard Table for Larger Screens -->
    <div class="overflow-x-auto">
        <div class="overflow-x-auto min-h-full"> <!-- Added scrollable height -->
            <table class="min-w-full table-auto border-collapse border border-gray-200 hidden sm:table">
                <thead class="bg-gray-100 ">
                    <tr>
                        @if ($selectable)
                            <th class="px-4 py-2 border bg-gray-100">
                                <input type="checkbox" id="select-all" class="form-checkbox">
                            </th>
                        @endif
                        @foreach ($headers as $header)
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border bg-gray-100">
                                {{ $header['label'] }}
                                @if ($header['sortable'] ?? false)
                                    <i class="fas fa-sort"></i>
                                @endif
                            </th>
                        @endforeach
                        @if ($actions)
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600 border bg-gray-100">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (empty($rows))
                        <tr>
                            <td colspan="{{ count($headers) + ($actions ? 1 : 0) + ($selectable ? 1 : 0) }}" 
                                class="text-center text-gray-600 py-6">
                                {{ $noDataMessage }}
                            </td>
                        </tr>
                    @else
                        @foreach ($rows as $row)
                            <tr class="hover:bg-gray-50">
                                @if ($selectable)
                                    <td class="px-4 py-2 border">
                                        <input type="checkbox" class="form-checkbox select-row">
                                    </td>
                                @endif
                                @foreach ($headers as $header)
                                    <td class="px-4 py-2 border">
                                        {{ $row[$header['label']] ?? '' }}
                                    </td>
                                @endforeach
                                @if ($actions)
                                    <td class="px-4 py-2 border">
                                        <div class="flex space-x-2">
                                            {{ $actions($row) }}
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Responsive Stacked Layout for Small Screens -->
    <div class="sm:hidden">
        @if (empty($rows))
            <div class="text-center text-gray-600 py-6">
                {{ $noDataMessage }}
            </div>
        @else
            @foreach ($rows as $row)
                <div class="border border-gray-200 rounded-lg mb-4 p-4 bg-white shadow-sm">
                    @if ($selectable)
                        <div class="mb-2">
                            <input type="checkbox" class="form-checkbox select-row">
                        </div>
                    @endif
                    @foreach ($headers as $header)
                        <div class="flex justify-between py-1">
                            <span class="font-semibold text-gray-600">{{ $header['label'] }}:</span>
                            <span>{{ $row[$header['label']] ?? '' }}</span>
                        </div>
                    @endforeach
                    @if ($actions)
                        <div class="mt-2 flex space-x-2">
                            {{ $actions($row) }}
                        </div>
                    @endif
                </div>
            @endforeach
        @endif
    </div>
</div>
