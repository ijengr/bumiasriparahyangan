@extends('layouts.app')

@section('content')
{{-- Hero Header --}}
<section class="relative bg-gradient-to-br from-green-50 via-white to-emerald-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-16 lg:py-20 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 text-sm font-semibold rounded-full mb-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                {{ $siteSettings['badge_facilities'] ?? 'FASILITAS LENGKAP' }}
            </div>
            <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 dark:text-white mb-4">
                {{ $siteSettings['facilities_title'] ?? 'Nikmati Fasilitas Premium' }}
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                {{ $siteSettings['facilities_subtitle'] ?? 'Berbagai fasilitas modern dan lengkap untuk mendukung gaya hidup aktif dan sehat bagi seluruh keluarga.' }}
            </p>
        </div>
    </div>
</section>

{{-- Facilities Grid --}}
<section class="py-16 lg:py-20 bg-white dark:bg-gray-900 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($facilities->count() > 0)
            {{-- Dynamic Facilities from Database --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @php
                    $colors = [
                        ['from-green-400', 'to-emerald-500', 'text-green-600', 'dark:text-green-400', 'dark:group-hover:text-green-400'],
                        ['from-blue-400', 'to-cyan-500', 'text-blue-600', 'dark:text-blue-400', 'dark:group-hover:text-blue-400'],
                        ['from-purple-400', 'to-pink-500', 'text-purple-600', 'dark:text-purple-400', 'dark:group-hover:text-purple-400'],
                        ['from-orange-400', 'to-red-500', 'text-orange-600', 'dark:text-orange-400', 'dark:group-hover:text-orange-400'],
                        ['from-teal-400', 'to-cyan-500', 'text-teal-600', 'dark:text-teal-400', 'dark:group-hover:text-teal-400'],
                        ['from-indigo-400', 'to-purple-500', 'text-indigo-600', 'dark:text-indigo-400', 'dark:group-hover:text-indigo-400'],
                    ];
                @endphp
                @foreach($facilities as $index => $facility)
                    @php
                        $colorSet = $colors[$index % count($colors)];
                    @endphp
                    <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/50 hover:shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index % 6) * 100 }}">
                        <div class="relative h-48 bg-gradient-to-br {{ $colorSet[0] }} {{ $colorSet[1] }} overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                @if($facility->icon)
                                    {!! $facility->icon !!}
                                @else
                                    <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                @endif
                            </div>
                            <div class="absolute top-4 right-4 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:{{ $colorSet[2] }} {{ $colorSet[4] }} transition-colors">{{ $facility->name }}</h3>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">{{ $facility->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Default/Example Facilities (shown when DB is empty) --}}
            <div class="mb-8 text-center" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300 text-sm font-semibold rounded-full">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Contoh Fasilitas - Kelola dari Admin Panel
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            {{-- Taman --}}
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/50 hover:shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="0">
                <div class="relative h-48 bg-gradient-to-br from-green-400 to-emerald-500 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                    </div>
                    <div class="absolute top-4 right-4 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-green-600 dark:group-hover:text-green-400 transition-colors">Taman & Ruang Hijau</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">Area taman hijau yang asri untuk bersantai dan bermain bersama keluarga dengan udara segar.</p>
                </div>
            </div>

            {{-- Security --}}
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/50 hover:shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="relative h-48 bg-gradient-to-br from-blue-400 to-cyan-500 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <div class="absolute top-4 right-4 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">Keamanan 24 Jam</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">Sistem keamanan terpadu dengan petugas 24/7 dan CCTV di setiap sudut untuk ketenangan Anda.</p>
                </div>
            </div>

            {{-- Masjid --}}
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/50 hover:shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="relative h-48 bg-gradient-to-br from-purple-400 to-pink-500 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <div class="absolute top-4 right-4 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">Masjid & Mushola</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">Tempat ibadah yang nyaman dan bersih untuk menjalankan aktivitas keagamaan bersama komunitas.</p>
                </div>
            </div>

            {{-- Playground --}}
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/50 hover:shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="relative h-48 bg-gradient-to-br from-orange-400 to-red-500 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="absolute top-4 right-4 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-orange-600 dark:group-hover:text-orange-400 transition-colors">Playground Anak</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">Area bermain anak yang aman dan menyenangkan dengan berbagai permainan edukatif dan modern.</p>
                </div>
            </div>

            {{-- Jogging Track --}}
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/50 hover:shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
                <div class="relative h-48 bg-gradient-to-br from-teal-400 to-cyan-500 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <div class="absolute top-4 right-4 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">Jogging Track</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">Jalur jogging yang nyaman untuk olahraga pagi atau sore dengan pemandangan hijau yang menyegarkan.</p>
                </div>
            </div>

            {{-- Clubhouse --}}
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg dark:shadow-gray-900/50 hover:shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="500">
                <div class="relative h-48 bg-gradient-to-br from-indigo-400 to-purple-500 overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-24 h-24 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div class="absolute top-4 right-4 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">Clubhouse</h3>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">Tempat berkumpul dan bersosialisasi dengan komunitas untuk acara bersama dan kegiatan sosial.</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

{{-- CTA Section --}}
<section class="py-16 bg-gradient-to-br from-green-600 to-emerald-600 dark:from-green-700 dark:to-emerald-700 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-white/10 rounded-full -ml-48 -mt-48"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/10 rounded-full -mr-48 -mb-48"></div>
    
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center" data-aos="zoom-in">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
            {{ $siteSettings['facilities_cta_title'] ?? 'Ingin Tahu Lebih Banyak?' }}
        </h2>
        <p class="text-xl text-green-100 mb-8 max-w-2xl mx-auto">
            {{ $siteSettings['facilities_cta_subtitle'] ?? 'Kunjungi lokasi kami dan rasakan langsung kenyamanan fasilitas yang tersedia.' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('landing.contact') }}" class="inline-flex items-center gap-2 bg-white text-green-600 hover:bg-green-50 px-8 py-4 rounded-xl font-bold shadow-xl hover:shadow-2xl transition-all transform hover:-translate-y-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $siteSettings['btn_schedule_visit'] ?? 'Jadwalkan Kunjungan' }}
            </a>
            <a href="{{ route('landing.units') }}" class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-8 py-4 rounded-xl font-bold shadow-lg transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                {{ $siteSettings['btn_view_units'] ?? 'Lihat Unit' }}
            </a>
        </div>
    </div>
</section>
@endsection

