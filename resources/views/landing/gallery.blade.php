@extends('layouts.app')

@section('content')
{{-- Hero Header --}}
<section class="relative bg-gradient-to-br from-emerald-50 via-white to-teal-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-16 lg:py-20 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-sm font-semibold rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $siteSettings['badge_gallery'] ?? 'GALERI KAMI' }}
            </div>
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
                {{ $siteSettings['gallery_title'] ?? 'Lihat Keindahan Lingkungan Kami' }}
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                {{ $siteSettings['gallery_subtitle'] ?? 'Jelajahi foto-foto lingkungan, fasilitas, dan suasana komunitas di Bumi Asri Parahyangan.' }}
            </p>

            @php
                // Build a small shuffled pool for the hero rotator (up to 8 images)
                $poolCollection = (method_exists($images, 'getCollection') ? $images->getCollection() : collect($images));
                $heroItems = $poolCollection->shuffle()->take(8)->values();
                $heroUrls = [];
                foreach ($heroItems as $it) {
                    $publicFallback = asset('images/placeholder-wide.svg');
                    $imgUrl = $publicFallback;
                    if (!empty($it->path)) {
                        $pubCandidate = public_path(ltrim($it->path, '/'));
                        if (file_exists($pubCandidate)) {
                            $imgUrl = asset(ltrim($it->path, '/'));
                        } else {
                            $basename = basename($it->path);
                            $samplePub = public_path('images/samples/' . $basename);
                            if (file_exists($samplePub)) {
                                $imgUrl = asset('images/samples/' . $basename);
                            } else {
                                $storedPath = storage_path('app/public/' . ltrim($it->path, '/'));
                                if (file_exists($storedPath)) {
                                    $imgUrl = asset('storage/' . ltrim($it->path, '/'));
                                }
                            }
                        }
                    }
                    $heroUrls[] = $imgUrl;
                }
            @endphp

            @if(count($heroUrls) > 0)
            <div class="mt-8" data-aos="fade-up">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl h-64 sm:h-96 bg-gray-100 dark:bg-gray-800 hero-rotator" data-images='{{ json_encode($heroUrls) }}'>
                    <img src="{{ $heroUrls[0] }}" alt="Gallery hero" class="w-full h-full object-cover rotator-hero-img" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- Gallery Grid --}}
<section class="py-16 lg:py-20 bg-white dark:bg-gray-900 transition-colors"
         x-data="{ loading: true }" 
         x-init="setTimeout(() => loading = false, 300)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($images->count() > 0)
            {{-- Filter Info --}}
            <div class="mb-8 text-center" data-aos="fade-up">
                <p class="text-gray-600 dark:text-gray-400">
                    <span x-show="!loading">
                        Menampilkan <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $images->count() }}</span> dari <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $images->total() }}</span> foto
                    </span>
                    <span x-show="loading" class="inline-block h-6 bg-gray-200 dark:bg-gray-700 rounded w-48 animate-pulse"></span>
                </p>
            </div>

            <!-- Skeleton Loaders -->
            <div x-show="loading" x-transition class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @for($i = 0; $i < 12; $i++)
                    <x-skeleton-gallery-card />
                @endfor
            </div>

            {{-- Masonry-style Grid --}}
            <div x-show="!loading" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @php
                    // Work with the paginator's collection (if paginator) or the array
                    $collection = (method_exists($images, 'getCollection') ? $images->getCollection() : collect($images));
                    $groups = $collection->groupBy(function($it){ return trim($it->caption ?? '') ?: '—'; });
                    $filtered = collect();
                    foreach ($groups as $g) {
                        $filtered = $filtered->concat($g->take(5));
                    }
                    $filtered = $filtered->values();
                @endphp
                @foreach($filtered as $index => $img)
                    @php
                        // Determine image URL: prefer public path, then public samples, then storage, fallback to placeholder
                        $publicFallback = asset('images/placeholder-square.svg');
                        $imgUrl = $publicFallback;
                        if (!empty($img->path)) {
                            $pubCandidate = public_path(ltrim($img->path, '/'));
                            if (file_exists($pubCandidate)) {
                                $imgUrl = asset(ltrim($img->path, '/'));
                            } else {
                                $basename = basename($img->path);
                                $samplePub = public_path('images/samples/' . $basename);
                                if (file_exists($samplePub)) {
                                    $imgUrl = asset('images/samples/' . $basename);
                                } else {
                                    $storedPath = storage_path('app/public/' . ltrim($img->path, '/'));
                                    if (file_exists($storedPath)) {
                                        $imgUrl = asset('storage/' . ltrim($img->path, '/'));
                                    }
                                }
                            }
                        }
                        $isLarge = $index % 7 === 0;
                    @endphp

                    <div class="group relative rounded-2xl overflow-hidden shadow-lg dark:shadow-gray-900/50 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 {{ $isLarge ? 'sm:col-span-2 sm:row-span-2' : '' }}" data-aos="zoom-in" data-aos-delay="{{ ($index % 8) * 50 }}">
                        <div class="relative {{ $isLarge ? 'h-96' : 'h-64' }} bg-gray-100 dark:bg-gray-800 overflow-hidden">
                            <a href="{{ $imgUrl }}" class="block w-full h-full glightbox" data-gallery="gallery" data-title="{{ e($img->caption) }}">
                                <img src="{{ $imgUrl }}" alt="{{ $img->caption ?? 'Gallery Image' }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" loading="lazy">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors"></div>
                            </a>
                        </div>

                        <div class="p-3 bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
                            <h3 class="text-sm font-semibold text-gray-900 dark:text-white truncate">{{ $img->caption ?? '' }}</h3>
                        </div>

                        <div class="absolute top-4 right-4 w-10 h-10 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($images->hasPages())
            <div class="mt-12" data-aos="fade-up">
                <div class="space-y-4">
                    <div class="flex justify-center">
                        {{ $images->links() }}
                    </div>
                    <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                        Menampilkan <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $images->firstItem() }}</span> 
                        sampai <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $images->lastItem() }}</span> 
                        dari <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $images->total() }}</span> foto
                    </div>
                </div>
            </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="text-center py-20 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-600" data-aos="fade-up">
                <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 to-emerald-200 dark:from-emerald-900/30 dark:to-emerald-800/30 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 dark:text-gray-200 mb-2">Galeri Sedang Dipersiapkan</h3>
                <p class="text-gray-500 dark:text-gray-400">Foto-foto terbaru akan segera ditambahkan.</p>
            </div>
        @endif
    </div>
</section>

{{-- Stats Section --}}
<section class="py-16 bg-gradient-to-br from-emerald-600 to-teal-600 dark:from-emerald-700 dark:to-teal-700 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-white rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center text-white" data-aos="fade-up">
            <div>
                <div class="text-4xl lg:text-5xl font-bold mb-2">{{ $images->total() }}+</div>
                <div class="text-emerald-100">Foto Gallery</div>
            </div>
            <div>
                <div class="text-4xl lg:text-5xl font-bold mb-2">15+</div>
                <div class="text-emerald-100">Area Fasilitas</div>
            </div>
            <div>
                <div class="text-4xl lg:text-5xl font-bold mb-2">5</div>
                <div class="text-emerald-100">Tipe Hunian</div>
            </div>
            <div>
                <div class="text-4xl lg:text-5xl font-bold mb-2">100+</div>
                <div class="text-emerald-100">Keluarga</div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const hero = document.querySelector('.hero-rotator');
    if (!hero) return;
    let images = [];
    try { images = JSON.parse(hero.getAttribute('data-images') || '[]'); } catch(e) { images = []; }
    if (!images.length) return;
    const imgEl = hero.querySelector('.rotator-hero-img');
    if (!imgEl) return;

    let idx = 0;
    // Start at random image
    idx = Math.floor(Math.random() * images.length);
    imgEl.src = images[idx];

    function rotate() {
        let next = Math.floor(Math.random() * images.length);
        if (next === idx) next = (next + 1) % images.length;
        const pre = new Image();
        pre.src = images[next];
        pre.onload = function() {
            imgEl.style.transition = 'opacity 400ms';
            imgEl.style.opacity = '0';
            setTimeout(function() {
                imgEl.src = images[next];
                imgEl.style.opacity = '1';
                idx = next;
            }, 420);
        };
        pre.onerror = function() { idx = next; };
    }

    // Randomized interval to avoid synchronous swaps
    (function schedule() {
        const delay = 4000 + Math.floor(Math.random() * 5000);
        setTimeout(function() { rotate(); schedule(); }, delay);
    })();
});
</script>
@endpush

@endsection
