<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $siteSettings['meta_title'] ?? ($siteSettings['company_name'] ?? config('app.name', 'Laravel')) }}</title>
        
        <!-- Performance Optimization: Resource Hints -->
        <link rel="dns-prefetch" href="https://fonts.bunny.net">
        <link rel="dns-prefetch" href="https://unpkg.com">
        <link rel="dns-prefetch" href="https://images.unsplash.com">
        <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
        
        <!-- Preload Critical Assets -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- SEO Meta Tags -->
        <meta name="description" content="{{ $siteSettings['meta_description'] ?? 'Hunian nyaman dan asri untuk keluarga Anda' }}">
        <meta name="keywords" content="{{ $siteSettings['meta_keywords'] ?? 'properti, rumah, perumahan, hunian' }}">
        <meta name="author" content="{{ $siteSettings['company_name'] ?? config('app.name') }}">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="{{ url()->current() }}">
        
        <!-- Schema.org JSON-LD for Organization -->
        @php
            $schemaData = [
                '@context' => 'https://schema.org',
                '@type' => 'RealEstateAgent',
                'name' => $siteSettings['company_name'] ?? config('app.name'),
                'description' => $siteSettings['meta_description'] ?? 'Hunian nyaman dan asri untuk keluarga Anda',
                'url' => url('/'),
                'priceRange' => '$$',
            ];
            
            if (!empty($siteSettings['phone'])) {
                $schemaData['telephone'] = $siteSettings['phone'];
            }
            if (!empty($siteSettings['email'])) {
                $schemaData['email'] = $siteSettings['email'];
            }
            if (!empty($siteSettings['address'])) {
                $schemaData['address'] = [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $siteSettings['address'],
                ];
            }
            if (!empty($siteSettings['og_image'])) {
                $schemaData['image'] = asset($siteSettings['og_image']);
            }
        @endphp
        <script type="application/ld+json">{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
        
        <!-- Additional Head Content from Child Views -->
        @yield('head')
        
        <!-- Favicon -->
        @if(!empty($siteSettings['favicon']))
        <link rel="icon" type="image/x-icon" href="{{ asset($siteSettings['favicon']) }}">
        @endif
        
        <!-- Theme Color for Mobile Browsers -->
        <meta name="theme-color" content="{{ $siteSettings['theme_color'] ?? '#10b981' }}">
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="{{ $siteSettings['meta_title'] ?? ($siteSettings['company_name'] ?? config('app.name')) }}">
        <meta property="og:description" content="{{ $siteSettings['meta_description'] ?? 'Hunian nyaman dan asri untuk keluarga Anda' }}">
        @if(!empty($siteSettings['og_image']))
        <meta property="og:image" content="{{ asset($siteSettings['og_image']) }}">
        @endif
        
        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="{{ $siteSettings['meta_title'] ?? ($siteSettings['company_name'] ?? config('app.name')) }}">
        <meta property="twitter:description" content="{{ $siteSettings['meta_description'] ?? 'Hunian nyaman dan asri untuk keluarga Anda' }}">
        @if(!empty($siteSettings['og_image']))
        <meta property="twitter:image" content="{{ asset($siteSettings['og_image']) }}">
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- AOS for simple scroll animations -->
        <link rel="preload" href="https://unpkg.com/aos@2.3.1/dist/aos.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript><link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"></noscript>
        
        {{-- Inject Theme CSS Variables --}}
        <style>
            {!! \App\Helpers\ThemeHelper::generateCSSVariables() !!}
            
            /* Apply theme colors to utility classes */
            .bg-primary { background-color: var(--theme-primary) !important; }
            .bg-secondary { background-color: var(--theme-secondary) !important; }
            .bg-accent { background-color: var(--theme-accent) !important; }
            .text-primary { color: var(--theme-primary) !important; }
            .text-secondary { color: var(--theme-secondary) !important; }
            .border-primary { border-color: var(--theme-primary) !important; }
            
            /* Override Tailwind emerald/teal with theme colors */
            .from-emerald-600 { --tw-gradient-from: var(--theme-primary) !important; }
            .to-teal-600 { --tw-gradient-to: var(--theme-secondary) !important; }
            .via-emerald-700 { --tw-gradient-via: var(--theme-primary) !important; }
            .bg-emerald-600 { background-color: var(--theme-primary) !important; }
            .bg-emerald-700 { background-color: var(--theme-primary) !important; }
            .bg-teal-600 { background-color: var(--theme-secondary) !important; }
            .bg-teal-700 { background-color: var(--theme-secondary) !important; }
            .text-emerald-600 { color: var(--theme-primary) !important; }
            .text-emerald-700 { color: var(--theme-primary) !important; }
            .text-teal-600 { color: var(--theme-secondary) !important; }
            .border-emerald-600 { border-color: var(--theme-primary) !important; }
            .border-emerald-100 { border-color: var(--theme-primary-light) !important; }
            .border-teal-600 { border-color: var(--theme-secondary) !important; }
            
            /* Gradient backgrounds */
            .from-emerald-50 { --tw-gradient-from: var(--theme-primary-light) !important; }
            .to-teal-50 { --tw-gradient-to: var(--theme-secondary-light) !important; }
            .from-emerald-100 { --tw-gradient-from: var(--theme-primary-light) !important; }
            .to-teal-100 { --tw-gradient-to: var(--theme-secondary-light) !important; }
            
            /* Hover states */
            .hover\:bg-emerald-50:hover { background-color: var(--theme-primary-light) !important; }
            .hover\:bg-emerald-700:hover { background-color: var(--theme-primary) !important; }
            .hover\:text-emerald-600:hover { color: var(--theme-primary) !important; }
            .hover\:border-emerald-700:hover { border-color: var(--theme-primary) !important; }
            
            /* Apply custom border radius */
            .rounded-xl { border-radius: var(--theme-radius) !important; }
            .rounded-2xl { border-radius: calc(var(--theme-radius) * 1.5) !important; }
            .rounded-3xl { border-radius: calc(var(--theme-radius) * 2) !important; }
            
            /* Skip to content link */
            .skip-to-content {
                position: absolute;
                top: -40px;
                left: 0;
                background: var(--theme-primary);
                color: white;
                padding: 8px 16px;
                text-decoration: none;
                border-radius: 0 0 4px 0;
                z-index: 9999;
            }
            .skip-to-content:focus {
                top: 0;
            }
            
            /* Smooth scroll */
            html {
                scroll-behavior: smooth;
            }
            
            /* Scroll to top button */
            #scroll-to-top {
                position: fixed;
                bottom: 2rem;
                right: 2rem;
                width: 3.5rem;
                height: 3.5rem;
                background: linear-gradient(135deg, var(--theme-primary), var(--theme-secondary));
                color: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                opacity: 0;
                visibility: hidden;
                transform: translateY(100px);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
                z-index: 998;
                border: none;
            }
            #scroll-to-top.show {
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
            #scroll-to-top:hover {
                transform: translateY(-5px) scale(1.05);
                box-shadow: 0 8px 25px rgba(16, 185, 129, 0.5);
            }
            #scroll-to-top:active {
                transform: translateY(-2px) scale(0.98);
            }
        </style>
    </head>
    <body class="font-sans antialiased overflow-x-hidden">
        <!-- Skip to main content link for accessibility -->
        <a href="#main-content" class="skip-to-content">Skip to main content</a>
        
        @include('layouts.landing-navigation')
        
        <div class="min-h-screen bg-gray-100">

            {{-- Global flash/status (visible on top of pages) --}}
            @if(session('status'))
                <div id="global-status" class="max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
                    <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-lg" role="status" aria-live="polite">
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-green-800 font-medium">{{ session('status') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main id="main-content" role="main" tabindex="-1">
                @if (isset($slot) && trim($slot) !== '')
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>

            <!-- Footer -->
            <footer class="bg-gradient-to-br from-gray-900 via-gray-800 to-emerald-900 text-gray-300">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                        <!-- Brand Section -->
                        <div class="lg:col-span-1">
                            <div class="flex items-center gap-3 mb-4">
                                @if(!empty($siteSettings['company_logo'] ?? null))
                                <!-- Custom Logo -->
                                <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center p-1">
                                    <img src="{{ $siteSettings['company_logo'] }}" alt="{{ $siteSettings['company_name'] ?? 'Logo' }}" class="w-full h-full object-contain">
                                </div>
                                @else
                                <!-- Default Icon -->
                                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                    </svg>
                                </div>
                                @endif
                                <h3 class="text-xl font-bold text-white">{{ $siteSettings['company_name'] ?? 'Bumi Asri Parahyangan' }}</h3>
                            </div>
                            <p class="text-sm text-gray-400 mb-6 leading-relaxed">
                                {{ $siteSettings['company_description'] ?? 'Hunian nyaman dan asri dengan lingkungan hijau, fasilitas modern, dan komunitas yang ramah untuk keluarga Indonesia.' }}
                            </p>
                            <!-- Social Media -->
                            <div class="flex gap-3">
                                @if(!empty($siteSettings['social_facebook']))
                                <a href="{{ $siteSettings['social_facebook'] }}" target="_blank" class="w-9 h-9 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition-all transform hover:-translate-y-1">
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                </a>
                                @endif
                                @if(!empty($siteSettings['social_instagram']))
                                <a href="{{ $siteSettings['social_instagram'] }}" target="_blank" class="w-9 h-9 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition-all transform hover:-translate-y-1">
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                </a>
                                @endif
                                @if(!empty($siteSettings['social_whatsapp']))
                                <a href="{{ $siteSettings['social_whatsapp'] }}" target="_blank" class="w-9 h-9 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition-all transform hover:-translate-y-1">
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                </a>
                                @endif
                                @if(!empty($siteSettings['social_twitter']))
                                <a href="{{ $siteSettings['social_twitter'] }}" target="_blank" class="w-9 h-9 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition-all transform hover:-translate-y-1">
                                    <svg class="w-4 h-4 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                </a>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Links -->
                        <div>
                            <h4 class="text-white font-bold mb-4">Menu Utama</h4>
                            <ul class="space-y-3">
                                <li><a href="{{ route('landing.index') }}" class="text-sm hover:text-emerald-400 transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    Beranda
                                </a></li>
                                <li><a href="{{ route('landing.units') }}" class="text-sm hover:text-emerald-400 transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    Unit Tersedia
                                </a></li>
                                <li><a href="{{ route('landing.gallery') }}" class="text-sm hover:text-emerald-400 transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    Galeri
                                </a></li>
                                <li><a href="{{ route('landing.contact') }}" class="text-sm hover:text-emerald-400 transition-colors flex items-center gap-2 group">
                                    <svg class="w-4 h-4 text-emerald-500 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    Kontak
                                </a></li>
                            </ul>
                        </div>

                        <!-- Kontak Info -->
                        <div>
                            <h4 class="text-white font-bold mb-4">Hubungi Kami</h4>
                            <ul class="space-y-3">
                                <li class="flex items-start gap-3 text-sm">
                                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="text-gray-400">{!! nl2br(e($siteSettings['contact_address'] ?? 'Jl. Parahyangan No. 123, Bandung, Jawa Barat 40164')) !!}</span>
                                </li>
                                <li class="flex items-center gap-3 text-sm">
                                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    <a href="tel:{{ str_replace([' ', '-', '(', ')'], '', $siteSettings['contact_phone'] ?? '') }}" class="text-gray-400 hover:text-emerald-400 transition-colors">{{ $siteSettings['contact_phone'] ?? '+62 22 1234 5678' }}</a>
                                </li>
                                <li class="flex items-center gap-3 text-sm">
                                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <a href="mailto:{{ $siteSettings['contact_email'] ?? 'info@bumiasriparahyangan.com' }}" class="text-gray-400 hover:text-emerald-400 transition-colors">{{ $siteSettings['contact_email'] ?? 'info@bumiasriparahyangan.com' }}</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Jam Operasional -->
                        <div>
                            <h4 class="text-white font-bold mb-4">Jam Operasional</h4>
                            <ul class="space-y-3 text-sm">
                                <li class="flex justify-between items-center">
                                    <span class="text-gray-400">Senin - Jumat</span>
                                    <span class="text-white font-semibold">{{ $siteSettings['operating_hours_weekday'] ?? '08:00 - 17:00' }}</span>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class="text-gray-400">Sabtu</span>
                                    <span class="text-white font-semibold">{{ $siteSettings['operating_hours_saturday'] ?? '08:00 - 14:00' }}</span>
                                </li>
                                <li class="flex justify-between items-center">
                                    <span class="text-gray-400">Minggu</span>
                                    <span class="text-emerald-400 font-semibold">{{ $siteSettings['operating_hours_sunday'] ?? 'Tutup' }}</span>
                                </li>
                            </ul>
                            <div class="mt-6 p-4 bg-gradient-to-br from-emerald-600 to-teal-600 rounded-xl">
                                <p class="text-white text-xs font-semibold mb-2">Butuh Konsultasi?</p>
                                <a href="{{ route('landing.contact') }}" class="inline-flex items-center gap-2 bg-white text-emerald-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-emerald-50 transition-all w-full justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                                    Hubungi Kami
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom Bar -->
                    <div class="border-t border-gray-700 mt-12 pt-8">
                        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                            <p class="text-sm text-gray-400">
                                &copy; {{ date('Y') }} <span class="text-emerald-400 font-semibold">{{ $siteSettings['company_name'] ?? 'Bumi Asri Parahyangan' }}</span>. All rights reserved.
                            </p>
                            <div class="flex gap-6 text-sm">
                                <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Kebijakan Privasi</a>
                                <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Syarat & Ketentuan</a>
                                <a href="#" class="text-gray-400 hover:text-emerald-400 transition-colors">Sitemap</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        
        <!-- Scroll to Top Button -->
        <button id="scroll-to-top" aria-label="Kembali ke atas" title="Kembali ke atas">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
            </svg>
        </button>
        
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function(){ 
                AOS.init({duration:600}); 
                
                // Scroll to Top Button
                const scrollBtn = document.getElementById('scroll-to-top');
                
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 400) {
                        scrollBtn.classList.add('show');
                    } else {
                        scrollBtn.classList.remove('show');
                    }
                });
                
                scrollBtn.addEventListener('click', function() {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            });
        </script>
        {{-- Render any pushed scripts from views (e.g. contact auto-dismiss) --}}
        @stack('scripts')
    </body>
</html>
