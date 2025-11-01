@extends('layouts.app')

@section('content')
{{-- Hero Header --}}
<section class="relative bg-gradient-to-br from-emerald-50 via-white to-teal-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-16 lg:py-20 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-sm font-semibold rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                SEMUA UNIT
            </div>
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
                {{ $siteSettings['units_title'] ?? 'Temukan Hunian Impian Anda' }}
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                {{ $siteSettings['units_subtitle'] ?? 'Berbagai pilihan unit dengan desain modern, lokasi strategis, dan harga kompetitif untuk keluarga Indonesia.' }}
            </p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-12 max-w-5xl mx-auto" data-aos="fade-up" data-aos-delay="200">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/50 p-6 border border-gray-100 dark:border-gray-700 text-center transform hover:scale-105 transition-all">
                <div class="text-3xl font-bold text-emerald-600 dark:text-emerald-400">{{ $units->total() }}+</div>
                <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">Unit Tersedia</div>
            </div>
            @php
                $stats = [
                    ['key' => 'units_stat1', 'default' => '100+|Keluarga Bahagia', 'color' => 'blue'],
                    ['key' => 'units_stat2', 'default' => '24/7|Keamanan', 'color' => 'purple'],
                    ['key' => 'units_stat3', 'default' => '10+|Fasilitas Lengkap', 'color' => 'green'],
                ];
            @endphp
            @foreach($stats as $stat)
                @php
                    $statValue = $siteSettings[$stat['key']] ?? $stat['default'];
                    [$value, $label] = explode('|', $statValue . '|');
                @endphp
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg dark:shadow-gray-900/50 p-6 border border-gray-100 dark:border-gray-700 text-center transform hover:scale-105 transition-all">
                    <div class="text-3xl font-bold text-{{ $stat['color'] }}-600 dark:text-{{ $stat['color'] }}-400">{{ $value }}</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $label }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Units Grid --}}
<section class="py-16 lg:py-20 bg-white dark:bg-gray-900 transition-colors" 
         x-data="{ loading: true }" 
         x-init="setTimeout(() => loading = false, 300)">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Filter & Sort (Optional - untuk future enhancement) --}}
        <div class="mb-8 flex flex-col sm:flex-row gap-4 justify-between items-center" data-aos="fade-up">
            <div class="text-gray-700 dark:text-gray-300 font-medium">
                <span x-show="!loading">
                    Menampilkan <span class="text-emerald-600 dark:text-emerald-400 font-bold">{{ $units->count() }}</span> dari <span class="text-emerald-600 dark:text-emerald-400 font-bold">{{ $units->total() }}</span> unit
                </span>
                <span x-show="loading" class="inline-block h-6 bg-gray-200 dark:bg-gray-700 rounded w-48 animate-pulse"></span>
            </div>
        </div>

        <!-- Skeleton Loaders -->
        <div x-show="loading" x-transition class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @for($i = 0; $i < 6; $i++)
                <x-skeleton-unit-card />
            @endfor
        </div>

        <!-- Actual Content -->
        <div x-show="!loading" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             id="units-grid" 
             class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @include('landing._unit_cards', ['units' => $units])
        </div>

        {{-- Pagination --}}
        @if($units->hasPages())
        <div class="mt-12" data-aos="fade-up">
            <div class="space-y-4">
                <div class="flex justify-center">
                    {{ $units->links() }}
                </div>
                <div class="text-center text-sm text-gray-600 dark:text-gray-400">
                    Menampilkan <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $units->firstItem() }}</span> 
                    sampai <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $units->lastItem() }}</span> 
                    dari <span class="font-semibold text-emerald-600 dark:text-emerald-400">{{ $units->total() }}</span> hasil
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- CTA Section --}}
<section class="py-16 bg-gradient-to-br from-emerald-600 to-teal-600 dark:from-emerald-700 dark:to-teal-700 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -mr-48 -mt-48"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/10 rounded-full -ml-40 -mb-40"></div>
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
            {{ $siteSettings['units_cta_title'] ?? 'Butuh Bantuan Memilih Unit?' }}
        </h2>
        <p class="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto">
            {{ $siteSettings['units_cta_subtitle'] ?? 'Tim kami siap membantu Anda menemukan hunian yang sempurna sesuai kebutuhan dan budget.' }}
        </p>
        <a href="{{ route('landing.contact') }}" class="inline-flex items-center gap-2 bg-white text-emerald-600 hover:bg-emerald-50 px-8 py-4 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all transform hover:-translate-y-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            {{ $siteSettings['btn_contact_us'] ?? 'Hubungi Kami Sekarang' }}
        </a>
    </div>
</section>
@endsection

