@php
    // expects $facility and optional $index
    $index = $index ?? null;
    $publicFallback = asset('images/placeholder-square.svg');
    $thumb = $publicFallback;
    // facilities may not have images; try to discover if provided
    if (!empty($facility->image)) {
        $pubCandidate = public_path(ltrim($facility->image, '/'));
        if (file_exists($pubCandidate)) {
            $thumb = asset(ltrim($facility->image, '/'));
        } else {
            $storedPath = storage_path('app/public/' . ltrim($facility->image, '/'));
            if (file_exists($storedPath)) {
                $thumb = asset('storage/' . ltrim($facility->image, '/'));
            }
        }
    }
@endphp

<tr id="facility-row-{{ $facility->id }}" data-facility-id="{{ $facility->id }}" class="bg-white dark:bg-gray-800 odd:bg-gray-50 dark:odd:bg-gray-700/50 hover:bg-emerald-50/10 dark:hover:bg-emerald-900/10 transition">
    <td class="px-3 md:px-4 py-3 w-12">
        <input type="checkbox" data-bulk value="{{ $facility->id }}" class="form-checkbox h-4 w-4 text-emerald-600 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1 transition cursor-pointer">
    </td>
    <td class="px-3 md:px-4 py-3">
        <div class="flex items-center min-w-0">
            <div class="flex flex-col">
                <div class="text-sm font-semibold text-gray-900 dark:text-white truncate" data-facility-name data-unit-title title="{{ e($facility->name) }}">{{ $facility->name }}</div>
                <div class="md:hidden text-xs text-gray-500 dark:text-gray-400 truncate mt-1">{{ Str::limit($facility->description, 50) }}</div>
            </div>
        </div>
    </td>
    <td class="px-3 md:px-4 py-3 hidden md:table-cell">
        <div class="text-sm text-gray-600 dark:text-gray-300 truncate" data-facility-desc>{{ $facility->description }}</div>
    </td>
    <td class="px-3 md:px-4 py-3 text-right w-24 md:w-36 whitespace-nowrap">
        <div class="inline-flex items-center gap-1 md:gap-2">
            <a href="#" data-edit-url="{{ route('admin.facilities.edit', $facility) }}" class="inline-flex items-center gap-1 px-2 md:px-2.5 py-1 text-xs font-medium text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-900/20 hover:bg-emerald-100 dark:hover:bg-emerald-900/30 rounded-md transition edit-btn" title="Edit fasilitas">
                <svg class="w-3 h-3 md:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span class="hidden md:inline">Edit</span>
            </a>
            <form action="{{ route('admin.facilities.destroy', $facility) }}" method="POST" class="inline confirm-delete">
                @csrf
                @method('DELETE')
                <button class="inline-flex items-center gap-1 px-2 md:px-2.5 py-1 text-xs font-medium text-red-700 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 rounded-md transition" title="Hapus fasilitas">
                    <svg class="w-3 h-3 md:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    <span class="hidden md:inline">Hapus</span>
                </button>
            </form>
        </div>
    </td>
</tr>
