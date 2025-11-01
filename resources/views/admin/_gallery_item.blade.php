@php
    $publicFallback = asset('images/placeholder-square.svg');
    $src = $publicFallback;
    $filename = '';
    $filesize = null;
    if (!empty($image->path)) {
        $stored = storage_path('app/public/' . ltrim($image->path, '/'));
        if (file_exists($stored)) $src = asset('storage/' . ltrim($image->path, '/'));
        $filename = basename($image->path);
        try { $filesize = filesize($stored); } catch (
            Throwable $e) { $filesize = null; }
    }
@endphp

<div class="relative bg-white rounded-lg overflow-hidden shadow-sm">
    <a href="{{ $src }}" class="glightbox" data-gallery="gallery" data-title="{{ e($image->caption) }}">
        <img src="{{ $src }}" alt="{{ $image->caption }}" class="w-full h-48 object-cover">
    </a>
    <div class="absolute inset-0 flex items-start justify-end p-2">
        <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition">
            <a href="{{ $src }}" download class="inline-flex items-center gap-1 px-2 py-1 bg-white/80 text-sm rounded shadow text-gray-700" aria-label="Download foto">Unduh</a>
            <button type="button" class="gallery-info inline-flex items-center gap-1 px-2 py-1 bg-white/80 text-sm rounded shadow text-gray-700" data-file-name="{{ $filename }}" data-file-size="{{ $filesize }}" data-caption="{{ e($image->caption) }}" aria-label="Info foto">Info</button>
            <form action="{{ route('admin.gallery.destroy', $image) }}" method="POST" class="confirm-delete inline">
                @csrf @method('DELETE')
                <button class="inline-flex items-center gap-1 px-2 py-1 bg-white/80 text-sm rounded shadow text-red-600">Hapus</button>
            </form>
        </div>
    </div>
    <div class="p-3" data-gallery-id="{{ $image->id }}">
        <div>
            <div class="text-sm font-semibold text-gray-900 truncate gallery-caption" tabindex="0" role="button" aria-label="Edit caption">{{ $image->caption }}</div>
            @if($filename)
                <div class="text-xs text-gray-500 mt-1 truncate">{{ $filename }} @if($filesize) · {{ number_format($filesize/1024, 1) }} KB @endif</div>
            @endif
        </div>
        <div class="text-xs text-gray-500 mt-2">{{ $image->created_at->diffForHumans() }}</div>
    </div>
</div>
