@extends('layouts.app')

@section('content')
{{-- Hero Header with Parallax Effect --}}
<section class="relative bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-700 py-20 lg:py-28 overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;1&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-4xl mx-auto" data-aos="fade-up">
            <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/20 backdrop-blur-sm border border-white/30 text-white text-sm font-semibold rounded-full mb-6 shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>TENTANG KAMI</span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6 leading-tight">
                {{ $siteSettings['about_title'] ?? 'Tentang Kami' }}
            </h1>
            <p class="text-xl lg:text-2xl text-emerald-50 leading-relaxed max-w-3xl mx-auto">
                {{ $siteSettings['company_tagline'] ?? 'Hunian Nyaman & Asri untuk Keluarga' }}
            </p>
            
            {{-- Decorative Line --}}
            <div class="mt-8 flex items-center justify-center gap-3">
                <div class="h-1 w-20 bg-white/40 rounded-full"></div>
                <div class="h-2 w-2 bg-white rounded-full"></div>
                <div class="h-1 w-20 bg-white/40 rounded-full"></div>
            </div>
        </div>
    </div>
    
    {{-- Wave Divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
            <path d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z" fill="white"/>
        </svg>
    </div>
</section>

{{-- Main Content Section --}}
<section class="py-20 lg:py-28 bg-white relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            {{-- Text Content --}}
            <div data-aos="fade-right">
                <div class="mb-8">
                    <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full uppercase tracking-wide mb-4">
                        Cerita Kami
                    </span>
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-6">
                        Membangun Impian,<br/>Menciptakan Rumah
                    </h2>
                </div>
                
                <div class="prose prose-lg max-w-none mb-8">
                    <p class="text-gray-700 leading-relaxed text-lg">
                        {{ $siteSettings['about_content'] ?? 'Bumi Asri Parahyangan adalah pengembang properti terpercaya yang fokus menghadirkan hunian berkualitas dengan konsep modern dan lingkungan yang asri. Kami berkomitmen untuk menciptakan komunitas yang nyaman dan ramah bagi keluarga Indonesia.' }}
                    </p>
                    
                    @if(!empty($siteSettings['company_description']))
                    <p class="text-gray-600 leading-relaxed mt-6">
                        {{ $siteSettings['company_description'] }}
                    </p>
                    @endif
                </div>

                {{-- Statistics --}}
                <div class="grid grid-cols-3 gap-6 py-8 border-y border-gray-200">
                    @php
                        $stats = [
                            ['key' => 'about_stat1', 'default' => '100+|Unit Terjual'],
                            ['key' => 'about_stat2', 'default' => '5+|Tahun Pengalaman'],
                            ['key' => 'about_stat3', 'default' => '98%|Kepuasan Klien'],
                        ];
                    @endphp
                    @foreach($stats as $index => $stat)
                        @php
                            $statValue = $siteSettings[$stat['key']] ?? $stat['default'];
                            [$value, $label] = explode('|', $statValue . '|');
                        @endphp
                        <div class="text-center" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                            <div class="text-4xl font-extrabold text-emerald-600 mb-2">{{ $value }}</div>
                            <div class="text-sm text-gray-600 font-medium">{{ $label }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Image with Decorative Elements --}}
            <div class="relative" data-aos="fade-left">
                <div class="relative">
                    {{-- Decorative Blur --}}
                    <div class="absolute -inset-6 bg-gradient-to-r from-emerald-400 via-teal-400 to-emerald-500 rounded-3xl blur-3xl opacity-20"></div>
                    
                    {{-- Main Image --}}
                    <div class="relative bg-white rounded-3xl shadow-2xl overflow-hidden border-8 border-white">
                        @if(!empty($siteSettings['about_image']))
                        <img src="{{ asset($siteSettings['about_image']) }}" 
                             alt="About {{ $siteSettings['company_name'] ?? 'Bumi Asri Parahyangan' }}" 
                             class="w-full h-[500px] object-cover">
                        @else
                        <div class="w-full h-[500px] bg-gradient-to-br from-emerald-100 via-teal-50 to-emerald-100 flex flex-col items-center justify-center">
                            <svg class="w-32 h-32 text-emerald-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <p class="text-emerald-400 font-medium">Gambar Tentang Kami</p>
                        </div>
                        @endif
                    </div>
                    
                    {{-- Floating Badge --}}
                    <div class="absolute -bottom-6 -right-6 bg-white rounded-2xl shadow-xl p-6 border border-gray-100" data-aos="zoom-in" data-aos-delay="400">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900">Terpercaya</div>
                                <div class="text-sm text-gray-500">Sejak 2019</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Values Section --}}
<section class="py-20 bg-gradient-to-br from-gray-50 to-emerald-50/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full uppercase tracking-wide mb-4">
                Nilai-Nilai Kami
            </span>
            <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-4">
                Mengapa Memilih Kami?
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Komitmen kami adalah memberikan yang terbaik untuk Anda
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Value Card 1 --}}
            <div class="group" data-aos="fade-up" data-aos-delay="100">
                <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 h-full">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-bl-full"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Kualitas Terjamin</h3>
                        <p class="text-gray-600 leading-relaxed">Material berkualitas tinggi dengan standar konstruksi terbaik</p>
                    </div>
                </div>
            </div>

            {{-- Value Card 2 --}}
            <div class="group" data-aos="fade-up" data-aos-delay="200">
                <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 h-full">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-teal-500/10 to-transparent rounded-bl-full"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Harga Kompetitif</h3>
                        <p class="text-gray-600 leading-relaxed">Harga terbaik di kelasnya dengan berbagai pilihan pembayaran</p>
                    </div>
                </div>
            </div>

            {{-- Value Card 3 --}}
            <div class="group" data-aos="fade-up" data-aos-delay="300">
                <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 h-full">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-500/10 to-transparent rounded-bl-full"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Komunitas Ramah</h3>
                        <p class="text-gray-600 leading-relaxed">Lingkungan yang nyaman dengan komunitas yang saling peduli</p>
                    </div>
                </div>
            </div>

            {{-- Value Card 4 --}}
            <div class="group" data-aos="fade-up" data-aos-delay="400">
                <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 h-full">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-500/10 to-transparent rounded-bl-full"></div>
                    <div class="relative">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Lingkungan Asri</h3>
                        <p class="text-gray-600 leading-relaxed">Ruang hijau yang luas untuk kenyamanan keluarga Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="py-16 bg-gradient-to-br from-emerald-600 to-teal-600">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl lg:text-4xl font-extrabold text-white mb-4" data-aos="fade-up">
            {{ $siteSettings['cta_title'] ?? 'Siap Memiliki Hunian Impian?' }}
        </h2>
        <p class="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
            {{ $siteSettings['cta_subtitle'] ?? 'Hubungi kami sekarang untuk informasi lebih lanjut dan penawaran menarik' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('landing.units') }}" class="inline-flex items-center justify-center gap-2 bg-white text-emerald-600 hover:bg-emerald-50 px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Lihat Unit Tersedia
            </a>
            <a href="{{ route('landing.contact') }}" class="inline-flex items-center justify-center gap-2 bg-emerald-800 hover:bg-emerald-900 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                {{ $siteSettings['cta_button'] ?? 'Hubungi Kami' }}
            </a>
        </div>
    </div>
</section>
@endsection
