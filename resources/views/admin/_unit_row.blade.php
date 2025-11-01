@php
    // expects $unit
    $publicFallback = asset('images/placeholder-square.svg');
    $thumb = $publicFallback;
    if (!empty($unit->image)) {
        $pubCandidate = public_path(ltrim($unit->image, '/'));
        if (file_exists($pubCandidate)) {
            $thumb = asset(ltrim($unit->image, '/'));
        } else {
            $basename = basename($unit->image);
            $samplePub = public_path('images/samples/' . $basename);
            if (file_exists($samplePub)) {
                $thumb = asset('images/samples/' . $basename);
            } else {
                $storedPath = storage_path('app/public/' . ltrim($unit->image, '/'));
                if (file_exists($storedPath)) {
                    $thumb = asset('storage/' . ltrim($unit->image, '/'));
                }
            }
        }
    }
@endphp

@php $index = $index ?? null; @endphp
<tr id="unit-row-{{ $unit->id }}" data-unit-id="{{ $unit->id }}" class="bg-white dark:bg-gray-800 odd:bg-gray-50 dark:odd:bg-gray-750 hover:bg-emerald-50/30 dark:hover:bg-emerald-900/20 transition">
    <td class="px-3 md:px-4 py-2 md:py-3 text-xs md:text-sm text-gray-500 dark:text-gray-400 font-medium hidden">{{ $index ? $index : $unit->id }}</td>
    <td class="px-2 md:px-4 py-2 md:py-3">
        <input type="checkbox" data-bulk value="{{ $unit->id }}" class="form-checkbox h-4 w-4 text-emerald-600 dark:text-emerald-500 rounded border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1 transition cursor-pointer">
    </td>
    <td class="px-3 md:px-4 py-2 md:py-3">
        <div class="flex items-center gap-2 md:gap-3">
            <a href="{{ $thumb }}" class="glightbox flex-shrink-0" data-gallery="units" data-title="{{ e($unit->title) }}" data-description="{{ e($unit->description) }}">
                <img src="{{ $thumb }}" alt="{{ $unit->title }}" data-unit-thumb="{{ $thumb }}" class="w-16 h-12 md:w-20 md:h-14 object-cover rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 cursor-zoom-in">
            </a>
                <div class="flex flex-col min-w-0">
                    {{-- Title: single-line truncated. Full title+description is available via tooltip for quick preview --}}
                    <div class="flex items-center gap-2">
                        <div class="text-xs md:text-sm font-semibold text-gray-900 dark:text-white truncate title-popover-trigger" data-unit-title title="{{ e($unit->title . ($unit->description ? ' — ' . Str::limit($unit->description, 140) : '')) }}">{{ $unit->title }}</div>
                    </div>
                    {{-- keep description out of the table to keep rows consistent; available in tooltip/expand --}}
                </div>
        </div>
    </td>
    <td class="px-3 md:px-4 py-2 md:py-3 text-xs md:text-sm hidden md:table-cell">
        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-emerald-100 dark:bg-emerald-900/40 text-emerald-800 dark:text-emerald-300">{{ $unit->type }}</span>
    </td>
    <td class="px-3 md:px-4 py-2 md:py-3 text-xs md:text-sm text-gray-700 dark:text-gray-300">{{ $unit->bedrooms ?? '-' }}</td>
    <td class="px-3 md:px-4 py-2 md:py-3 text-xs md:text-sm text-gray-700 dark:text-gray-300">{{ $unit->bathrooms ?? '-' }}</td>
    <td class="px-3 md:px-4 py-2 md:py-3 text-xs md:text-sm text-gray-700 dark:text-gray-300 hidden lg:table-cell">{{ $unit->land_area ?? '-' }} m²</td>
    <td class="px-3 md:px-4 py-2 md:py-3 text-xs md:text-sm text-gray-700 dark:text-gray-300 hidden lg:table-cell">{{ $unit->floor_area ?? '-' }} m²</td>
    <td class="px-3 md:px-4 py-2 md:py-3 text-xs md:text-sm text-gray-700 dark:text-gray-300 hidden xl:table-cell">{{ $unit->parking ?? '-' }}</td>
    <td class="px-3 md:px-4 py-2 md:py-3 text-xs md:text-sm text-gray-700 dark:text-gray-300 hidden xl:table-cell">{{ $unit->built_year ?? '-' }}</td>
    <td class="px-3 md:px-4 py-2 md:py-3 text-right">
        <div class="text-xs md:text-sm font-semibold text-emerald-700 dark:text-emerald-400" data-unit-price>Rp {{ number_format($unit->price,0,',','.') }}</div>
    </td>
    <td class="px-3 md:px-4 py-2 md:py-3 text-right">
        <div class="inline-flex items-center gap-1 md:gap-2">
            <a href="#" data-edit-url="{{ route('admin.units.edit', $unit) }}" class="inline-flex items-center gap-1 px-2 md:px-3 py-1 md:py-1.5 text-xs font-medium text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/30 hover:bg-emerald-100 dark:hover:bg-emerald-900/50 rounded-md transition edit-btn" title="Edit unit">
                <svg class="w-4 h-4 md:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span class="hidden md:inline">Edit</span>
            </a>
            <form action="{{ route('admin.units.destroy', $unit) }}" method="POST" class="inline confirm-delete">
                @csrf
                @method('DELETE')
                <button class="inline-flex items-center gap-1 px-2 md:px-3 py-1 md:py-1.5 text-xs font-medium text-red-700 dark:text-red-400 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 rounded-md transition" title="Hapus unit">
                    <svg class="w-4 h-4 md:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span class="hidden md:inline">Hapus</span>
                </button>
            </form>
        </div>
    </td>
</tr>
