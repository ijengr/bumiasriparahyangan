<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 - Terjadi Kesalahan | {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        {!! \App\Helpers\ThemeHelper::generateCSSVariables() !!}
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-red-50 to-orange-50 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-2xl w-full text-center">
        <!-- Error Code -->
        <div class="mb-8">
            <h1 class="text-9xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-600 animate-pulse">
                500
            </h1>
        </div>

        <!-- Error Message -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 mb-8">
            <svg class="w-24 h-24 mx-auto mb-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Terjadi Kesalahan Server
            </h2>
            
            <p class="text-lg text-gray-600 mb-4">
                Maaf, terjadi kesalahan pada server kami. Tim kami telah diberitahu dan sedang memperbaikinya.
            </p>
            
            <p class="text-sm text-gray-500 mb-8">
                Silakan coba beberapa saat lagi atau hubungi kami jika masalah terus berlanjut.
            </p>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="window.location.reload()" 
                        class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Muat Ulang Halaman
                </button>
                
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-white text-emerald-600 font-semibold rounded-xl border-2 border-emerald-600 hover:bg-emerald-50 hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        <!-- Support Info -->
        <div class="bg-white/50 backdrop-blur-sm rounded-xl p-6">
            <p class="text-sm text-gray-600 mb-2">Butuh bantuan segera?</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ url('/contact') }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    Hubungi Kami
                </a>
                
                @if(!empty($siteSettings['phone']))
                <span class="hidden sm:inline text-gray-400">•</span>
                <a href="tel:{{ $siteSettings['phone'] ?? '' }}" class="inline-flex items-center text-emerald-600 hover:text-emerald-700 font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    {{ $siteSettings['phone'] ?? '' }}
                </a>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
