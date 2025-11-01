<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Halaman Tidak Ditemukan | {{ config('app.name') }}</title>
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        {!! \App\Helpers\ThemeHelper::generateCSSVariables() !!}
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-emerald-50 to-teal-50 min-h-screen flex items-center justify-center px-4">
    <div class="max-w-2xl w-full text-center">
        <!-- Error Code -->
        <div class="mb-8">
            <h1 class="text-9xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 animate-pulse">
                404
            </h1>
        </div>

        <!-- Error Message -->
        <div class="bg-white rounded-2xl shadow-2xl p-8 md:p-12 mb-8">
            <svg class="w-24 h-24 mx-auto mb-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Halaman Tidak Ditemukan
            </h2>
            
            <p class="text-lg text-gray-600 mb-8">
                Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin halaman telah dipindahkan atau URL yang Anda masukkan salah.
            </p>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl hover:shadow-lg hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Kembali ke Beranda
                </a>
                
                <a href="{{ url('/units') }}" 
                   class="inline-flex items-center justify-center px-8 py-4 bg-white text-emerald-600 font-semibold rounded-xl border-2 border-emerald-600 hover:bg-emerald-50 hover:scale-105 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Lihat Unit Tersedia
                </a>
            </div>
        </div>

        <!-- Helpful Links -->
        <div class="text-sm text-gray-600">
            <p class="mb-2">Halaman populer:</p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ url('/') }}" class="hover:text-emerald-600 transition-colors">Beranda</a>
                <span>•</span>
                <a href="{{ url('/units') }}" class="hover:text-emerald-600 transition-colors">Unit</a>
                <span>•</span>
                <a href="{{ url('/gallery') }}" class="hover:text-emerald-600 transition-colors">Galeri</a>
                <span>•</span>
                <a href="{{ url('/facilities') }}" class="hover:text-emerald-600 transition-colors">Fasilitas</a>
                <span>•</span>
                <a href="{{ url('/contact') }}" class="hover:text-emerald-600 transition-colors">Kontak</a>
            </div>
        </div>
    </div>
</body>
</html>
