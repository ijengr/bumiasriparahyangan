@extends('layouts.app')

@section('head')
<!-- Schema.org JSON-LD for Real Estate Listing -->
@php
    $schemaData = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'category' => 'RealEstate',
        'name' => $unit->title,
        'description' => strip_tags($unit->description),
        'offers' => [
            '@type' => 'Offer',
            'price' => $unit->price,
            'priceCurrency' => 'IDR',
            'availability' => 'https://schema.org/InStock',
            'url' => route('landing.units.show', $unit->id),
        ],
        'additionalProperty' => [
            [
                '@type' => 'PropertyValue',
                'name' => 'Tipe',
                'value' => $unit->type,
            ],
            [
                '@type' => 'PropertyValue',
                'name' => 'Luas Tanah',
                'value' => $unit->land_size . ' m²',
            ],
            [
                '@type' => 'PropertyValue',
                'name' => 'Luas Bangunan',
                'value' => $unit->building_size . ' m²',
            ],
            [
                '@type' => 'PropertyValue',
                'name' => 'Kamar Tidur',
                'value' => $unit->bedrooms,
            ],
            [
                '@type' => 'PropertyValue',
                'name' => 'Kamar Mandi',
                'value' => $unit->bathrooms,
            ],
        ],
    ];
    
    if (!empty($unit->main_image)) {
        $schemaData['image'] = asset($unit->main_image);
    }
@endphp
<script type="application/ld+json">{!! json_encode($schemaData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-emerald-50/30 to-teal-50/30 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <!-- Breadcrumb -->
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="{{ route('landing.index') }}" class="text-gray-500 dark:text-gray-400 hover:text-emerald-700 dark:hover:text-emerald-400 transition-colors">Beranda</a>
                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <a href="{{ route('landing.units') }}" class="text-gray-500 dark:text-gray-400 hover:text-emerald-700 dark:hover:text-emerald-400 transition-colors">Unit</a>
                <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                <span class="text-emerald-700 dark:text-emerald-400 font-medium">{{ $unit->title }}</span>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
        <!-- Page Header -->
        <div class="mb-8" data-aos="fade-up">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-3">{{ $unit->title }}</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300">{{ $unit->address ?? 'Bumi Asri Parahyangan' }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Image & Gallery -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Main Image Gallery -->
                <div class="relative overflow-hidden rounded-2xl shadow-2xl" data-aos="fade-up">
                    @php
                        // Get all images (main + additional)
                        $allImages = $unit->getAllImages();
                        $publicFallback = asset('images/placeholder-square.svg');
                        
                        // Process all images
                        $imageUrls = [];
                        foreach ($allImages as $imagePath) {
                            $imageUrl = $publicFallback;
                            $pubCandidate = public_path(ltrim($imagePath, '/'));
                            if (file_exists($pubCandidate)) {
                                $imageUrl = asset(ltrim($imagePath, '/'));
                            } else {
                                $basename = basename($imagePath);
                                $samplePub = public_path('images/samples/' . $basename);
                                if (file_exists($samplePub)) {
                                    $imageUrl = asset('images/samples/' . $basename);
                                } else {
                                    $storedPath = storage_path('app/public/' . ltrim($imagePath, '/'));
                                    if (file_exists($storedPath)) {
                                        $imageUrl = asset('storage/' . ltrim($imagePath, '/'));
                                    }
                                }
                            }
                            $imageUrls[] = $imageUrl;
                        }
                        
                        // If no images, use placeholder
                        if (empty($imageUrls)) {
                            $imageUrls = [$publicFallback];
                        }
                        $mainImg = $imageUrls[0];
                    @endphp
                    
                    <!-- Main Image Display -->
                    <div class="relative group bg-gray-900 dark:bg-gray-950 cursor-pointer" onclick="openLightbox(0)">
                        <img id="main-gallery-image" src="{{ $mainImg }}" alt="{{ $unit->name }}" class="w-full h-[400px] md:h-[500px] lg:h-[600px] object-cover" fetchpriority="high" loading="eager">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        
                        <!-- Zoom Icon -->
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="bg-white/90 rounded-full p-4 shadow-2xl">
                                <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v6m3-3H7"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Type Badge -->
                        @php
                            $badgeClass = 'inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold shadow-lg backdrop-blur-sm text-white ';
                            if ($unit->type === 'rumah') {
                                $badgeClass .= 'bg-emerald-500/90 hover:bg-emerald-600/90';
                            } elseif ($unit->type === 'kavling') {
                                $badgeClass .= 'bg-teal-500/90 hover:bg-teal-600/90';
                            } else {
                                $badgeClass .= 'bg-gray-500/90 hover:bg-gray-600/90';
                            }
                        @endphp
                        <div class="absolute top-4 md:top-6 left-4 md:left-6">
                            <span class="{{ $badgeClass }}">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                {{ ucfirst($unit->type) }}
                            </span>
                        </div>
                        
                        <!-- Navigation Arrows (if multiple images) -->
                        @if(count($imageUrls) > 1)
                        <button onclick="previousImage()" class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 bg-white/95 hover:bg-white text-gray-800 rounded-full p-2 md:p-3 shadow-xl transition-all hover:scale-110 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button onclick="nextImage()" class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 bg-white/95 hover:bg-white text-gray-800 rounded-full p-2 md:p-3 shadow-xl transition-all hover:scale-110 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                            <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                        
                        <!-- Image Counter -->
                        <div class="absolute bottom-4 md:bottom-6 right-4 md:right-6 bg-black/80 text-white px-3 md:px-4 py-2 rounded-full text-xs md:text-sm font-semibold backdrop-blur-sm shadow-lg">
                            <span id="current-image-index">1</span> / {{ count($imageUrls) }}
                        </div>
                        @endif
                    </div>
                    
                    <!-- Thumbnail Gallery (if multiple images) -->
                    @if(count($imageUrls) > 1)
                    <div class="mt-3 md:mt-4 p-1 grid grid-cols-4 sm:grid-cols-5 md:grid-cols-6 lg:grid-cols-8 gap-2">
                        @foreach($imageUrls as $index => $imageUrl)
                        <button onclick="showImage({{ $index }})" class="thumbnail-btn relative rounded-lg border-2 {{ $index === 0 ? 'border-emerald-500 ring-2 ring-emerald-200 dark:ring-emerald-700' : 'border-gray-200 dark:border-gray-700' }} hover:border-emerald-400 transition-all transform hover:scale-105 group">
                            <img src="{{ $imageUrl }}" alt="Thumbnail {{ $index + 1 }}" class="w-full h-16 md:h-20 object-cover rounded-md" loading="lazy" decoding="async">
                            <div class="absolute inset-0 bg-black/0 hover:bg-black/10 transition-colors rounded-md"></div>
                            <!-- Mini zoom icon on hover -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <svg class="w-5 h-5 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </button>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Description Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 md:mr-3 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Deskripsi
                    </h2>
                    <div class="prose prose-emerald dark:prose-invert max-w-none">
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $unit->description ?: ($settings['unit_detail_default_description'] ?? 'Unit properti berkualitas dengan lokasi strategis di kawasan Bumi Asri Parahyangan. Lingkungan asri, aman, dan nyaman untuk keluarga.') }}
                        </p>
                    </div>
                </div>

                <!-- Specifications Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="200">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 md:mr-3 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                        Spesifikasi Unit
                    </h2>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
                        <!-- Land Size -->
                        <div class="flex flex-col items-center text-center p-4 rounded-xl bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 border border-emerald-100 dark:border-emerald-800">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-5v4m0-4h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 font-medium mb-1">Luas Tanah</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">{{ $unit->land_area ?? '-' }}<span class="text-sm text-gray-600 dark:text-gray-400 font-normal ml-1">m²</span></p>
                            </div>
                        </div>

                        <!-- Floor Area -->
                        <div class="flex flex-col items-center text-center p-4 rounded-xl bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-teal-900/20 dark:to-emerald-900/20 border border-teal-100 dark:border-teal-800">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 font-medium mb-1">Luas Bangunan</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">{{ $unit->floor_area ?? '-' }}<span class="text-sm text-gray-600 dark:text-gray-400 font-normal ml-1">m²</span></p>
                            </div>
                        </div>
                        
                        <!-- Bedrooms -->
                        <div class="flex flex-col items-center text-center p-4 rounded-xl bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 border border-emerald-100 dark:border-emerald-800">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M5 10v7a1 1 0 001 1h12a1 1 0 001-1v-7M7 10V7a2 2 0 012-2h6a2 2 0 012 2v3" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 font-medium mb-1">Kamar Tidur</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">{{ $unit->bedrooms ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Bathrooms -->
                        <div class="flex flex-col items-center text-center p-4 rounded-xl bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-teal-900/20 dark:to-emerald-900/20 border border-teal-100 dark:border-teal-800">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11v6" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 font-medium mb-1">Kamar Mandi</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">{{ $unit->bathrooms ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Parking -->
                        <div class="flex flex-col items-center text-center p-4 rounded-xl bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 border border-emerald-100 dark:border-emerald-800">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 font-medium mb-1">Parkir</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">{{ $unit->parking ?? '-' }}</p>
                            </div>
                        </div>

                        <!-- Built Year -->
                        <div class="flex flex-col items-center text-center p-4 rounded-xl bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-teal-900/20 dark:to-emerald-900/20 border border-teal-100 dark:border-teal-800">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-teal-500 to-emerald-500 rounded-xl flex items-center justify-center shadow-lg mb-3">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs text-gray-600 dark:text-gray-400 font-medium mb-1">Tahun</p>
                                <p class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white">{{ $unit->built_year ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 md:p-8 border border-gray-100 dark:border-gray-700" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="text-xl md:text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <svg class="w-5 h-5 md:w-6 md:h-6 mr-2 md:mr-3 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Fitur & Keunggulan
                    </h2>
                    
                    @php
                        $features = [
                            $settings['unit_detail_feature_1'] ?? 'Lokasi Strategis',
                            $settings['unit_detail_feature_2'] ?? 'Keamanan 24 Jam',
                            $settings['unit_detail_feature_3'] ?? 'Lingkungan Asri',
                            $settings['unit_detail_feature_4'] ?? 'Akses Mudah',
                            $settings['unit_detail_feature_5'] ?? 'Fasilitas Lengkap',
                            $settings['unit_detail_feature_6'] ?? 'SHM & IMB Lengkap',
                        ];
                    @endphp
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 md:gap-4">
                        @foreach($features as $feature)
                        <div class="flex items-center space-x-3 p-3 rounded-lg hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors group">
                            <div class="flex-shrink-0 w-8 h-8 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center group-hover:bg-emerald-200 dark:group-hover:bg-emerald-800/50 transition-colors">
                                <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300">{{ $feature }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Share Card -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 border border-gray-100 dark:border-gray-700" data-aos="fade-up">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                        </svg>
                        Bagikan Unit
                    </h3>
                    <div class="grid grid-cols-3 gap-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" 
                           class="flex flex-col items-center justify-center px-3 py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-all transform hover:scale-105">
                            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            <span class="text-xs">Facebook</span>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($unit->title) }}" target="_blank"
                           class="flex flex-col items-center justify-center px-3 py-3 bg-blue-400 hover:bg-blue-500 text-white rounded-lg transition-all transform hover:scale-105">
                            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            <span class="text-xs">Twitter</span>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($unit->title . ' - ' . request()->url()) }}" target="_blank"
                           class="flex flex-col items-center justify-center px-3 py-3 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-all transform hover:scale-105">
                            <svg class="w-6 h-6 mb-1" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            <span class="text-xs">WhatsApp</span>
                        </a>
                    </div>
                </div>
                
                <!-- Price & Contact Card -->
                <div class="bg-gradient-to-br from-emerald-600 to-teal-600 dark:from-emerald-700 dark:to-teal-700 rounded-2xl shadow-2xl p-6 md:p-8 text-white lg:sticky lg:top-20" data-aos="fade-up" data-aos-delay="100" data-aos-once="true">
                    <div class="text-center mb-6">
                        <p class="text-emerald-100 dark:text-emerald-200 text-sm font-medium uppercase tracking-wider mb-2">Harga Unit</p>
                        <div class="text-3xl md:text-4xl font-bold mb-2">
                            Rp {{ number_format($unit->price / 1000000, 0) }} <span class="text-2xl">jt</span>
                        </div>
                        <div class="inline-flex items-center px-3 py-1 bg-emerald-500/30 rounded-full">
                            <svg class="w-4 h-4 mr-1.5 text-emerald-200" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-emerald-100 text-sm font-medium">Tersedia</span>
                        </div>
                    </div>

                    <div class="border-t border-emerald-400/30 pt-6 space-y-3">
                        <a href="{{ route('landing.contact') }}" 
                           class="block w-full px-6 py-3.5 bg-white text-emerald-700 rounded-xl text-center font-semibold shadow-lg hover:shadow-xl hover:bg-emerald-50 transform hover:-translate-y-0.5 transition-all duration-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span>Hubungi Kami</span>
                            </div>
                        </a>

                        @php
                            $whatsappNumber = $settings['contact_whatsapp'] ?? '6281234567890';
                            // Remove any non-numeric characters except the leading '+'
                            $whatsappNumber = preg_replace('/[^0-9+]/', '', $whatsappNumber);
                            // If doesn't start with country code, add 62
                            if (!str_starts_with($whatsappNumber, '62') && !str_starts_with($whatsappNumber, '+62')) {
                                $whatsappNumber = '62' . ltrim($whatsappNumber, '0');
                            }
                            $whatsappNumber = ltrim($whatsappNumber, '+');
                        @endphp
                        <a href="https://wa.me/{{ $whatsappNumber }}?text=Halo,%20saya%20tertarik%20dengan%20{{ urlencode($unit->title) }}" 
                           target="_blank"
                           class="block w-full px-6 py-3.5 bg-green-500 hover:bg-green-600 text-white rounded-xl text-center font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                <span>Chat WhatsApp</span>
                            </div>
                        </a>
                    </div>

                    <div class="border-t border-emerald-400/30 mt-6 pt-6 space-y-3">
                        @if(!empty($settings['contact_phone']))
                        <div class="flex items-center space-x-3 text-emerald-50">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <span class="text-sm">{{ $settings['contact_phone'] }}</span>
                        </div>
                        @endif
                        @if(!empty($settings['contact_email']))
                        <div class="flex items-center space-x-3 text-emerald-50">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-sm break-all">{{ $settings['contact_email'] }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Units -->
        @if($relatedUnits->count() > 0)
        <div class="mt-16" data-aos="fade-up">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-gray-900">Unit Sejenis</h2>
                <a href="{{ route('landing.units') }}" class="text-emerald-700 hover:text-emerald-800 font-medium flex items-center space-x-2 group">
                    <span>Lihat Semua</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedUnits as $related)
                <a href="{{ route('landing.units.show', $related->id) }}" class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative h-48 overflow-hidden">
                        @php
                            // Related unit image selection: public -> public samples -> storage -> placeholder
                            $relPublicFallback = asset('images/placeholder-square.svg');
                            $relImg = $relPublicFallback;
                            if (!empty($related->image)) {
                                $pubCandidate = public_path(ltrim($related->image, '/'));
                                if (file_exists($pubCandidate)) {
                                    $relImg = asset(ltrim($related->image, '/'));
                                } else {
                                    $basename = basename($related->image);
                                    $samplePub = public_path('images/samples/' . $basename);
                                    if (file_exists($samplePub)) {
                                        $relImg = asset('images/samples/' . $basename);
                                    } else {
                                        $storedPath = storage_path('app/public/' . ltrim($related->image, '/'));
                                        if (file_exists($storedPath)) {
                                            $relImg = asset('storage/' . ltrim($related->image, '/'));
                                        }
                                    }
                                }
                            }
                        @endphp
                        <img src="{{ $relImg }}" alt="{{ $related->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        @php
                            $relBadgeClass = 'absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-semibold backdrop-blur-sm text-white ';
                            if ($related->type === 'rumah') {
                                $relBadgeClass .= 'bg-emerald-500/90';
                            } else {
                                $relBadgeClass .= 'bg-teal-500/90';
                            }
                        @endphp
                        <span class="{{ $relBadgeClass }}">{{ ucfirst($related->type) }}</span>
                    </div>
                    <div class="p-5">
                        <h3 class="font-bold text-gray-900 mb-2 group-hover:text-emerald-700 transition-colors">{{ $related->title }}</h3>
                        <div class="flex items-center justify-between text-sm text-gray-600 mb-3">
                            <span>{{ $related->land_area ?? '-' }}m²</span>
                        </div>
                        <div class="text-2xl font-bold text-emerald-700">
                            Rp {{ number_format($related->price / 1000000, 0) }}jt
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- CTA Section -->
    <div class="bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-700 dark:to-teal-700 py-12 md:py-16" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-3 md:mb-4">Tertarik dengan Unit Ini?</h2>
            <p class="text-emerald-100 dark:text-emerald-200 text-base md:text-lg mb-6 md:mb-8 max-w-2xl mx-auto">Hubungi kami sekarang untuk informasi lebih lanjut dan jadwalkan kunjungan langsung ke unit</p>
            <div class="flex flex-col sm:flex-row gap-3 md:gap-4 justify-center max-w-lg mx-auto">
                <a href="{{ route('landing.contact') }}" 
                   class="px-6 md:px-8 py-3 md:py-4 bg-white text-emerald-700 rounded-xl font-semibold shadow-lg hover:shadow-xl hover:bg-emerald-50 transform hover:-translate-y-0.5 transition-all duration-200">
                    Hubungi Kami
                </a>
                <a href="{{ route('landing.units') }}" 
                   class="px-6 md:px-8 py-3 md:py-4 bg-emerald-500/80 hover:bg-emerald-500 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 border-2 border-white/30">
                    Lihat Unit Lainnya
                </a>
            </div>
        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="lightbox" class="fixed inset-0 bg-black/95 z-50 hidden items-center justify-center p-4">
        <!-- Close Button -->
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 p-2 rounded-full hover:bg-white/10 transition-all z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>

        <!-- Navigation Buttons -->
        <button onclick="lightboxPrevious()" class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 p-2 md:p-3 rounded-full hover:bg-white/10 transition-all z-10 bg-black/30">
            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button onclick="lightboxNext()" class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 p-2 md:p-3 rounded-full hover:bg-white/10 transition-all z-10 bg-black/30">
            <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Image Container -->
        <div class="relative w-full h-full flex items-center justify-center px-12 md:px-20 py-16 md:py-20">
            <img id="lightbox-image" src="" alt="Lightbox Image" class="max-w-full max-h-full object-contain mx-auto rounded-lg shadow-2xl">
            <!-- Image Counter -->
            <div class="absolute bottom-4 md:bottom-8 left-1/2 -translate-x-1/2 bg-black/80 text-white px-4 py-2 rounded-full text-sm font-semibold backdrop-blur-sm">
                <span id="lightbox-counter">1 / 1</span>
            </div>
        </div>
    </div>
</div>

<script>
// Gallery navigation
const imageUrls = @json($imageUrls);
let currentImageIndex = 0;

function showImage(index) {
    currentImageIndex = index;
    updateGallery();
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % imageUrls.length;
    updateGallery();
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + imageUrls.length) % imageUrls.length;
    updateGallery();
}

function updateGallery() {
    const mainImage = document.getElementById('main-gallery-image');
    const counter = document.getElementById('current-image-index');
    const thumbnails = document.querySelectorAll('.thumbnail-btn');
    
    if (mainImage) {
        // Fade effect
        mainImage.style.opacity = '0.5';
        setTimeout(() => {
            mainImage.src = imageUrls[currentImageIndex];
            mainImage.style.opacity = '1';
        }, 150);
    }
    
    if (counter) {
        counter.textContent = currentImageIndex + 1;
    }
    
    // Update thumbnail borders with ring effect
    thumbnails.forEach((thumbnail, index) => {
        if (index === currentImageIndex) {
            thumbnail.classList.remove('border-gray-200', 'dark:border-gray-700');
            thumbnail.classList.add('border-emerald-500', 'ring-2', 'ring-emerald-200', 'dark:ring-emerald-700');
        } else {
            thumbnail.classList.remove('border-emerald-500', 'ring-2', 'ring-emerald-200', 'dark:ring-emerald-700');
            thumbnail.classList.add('border-gray-200', 'dark:border-gray-700');
        }
    });
}

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    const isLightboxOpen = !lightbox.classList.contains('hidden');
    
    if (isLightboxOpen) {
        if (e.key === 'ArrowLeft') {
            lightboxPrevious();
        } else if (e.key === 'ArrowRight') {
            lightboxNext();
        } else if (e.key === 'Escape') {
            closeLightbox();
        }
    } else {
        if (e.key === 'ArrowLeft') {
            previousImage();
        } else if (e.key === 'ArrowRight') {
            nextImage();
        }
    }
});

// Smooth transition for main image
const mainImage = document.getElementById('main-gallery-image');
if (mainImage) {
    mainImage.style.transition = 'opacity 0.3s ease-in-out';
}

// ============ LIGHTBOX FUNCTIONS ============
let lightboxIndex = 0;

function openLightbox(index) {
    lightboxIndex = index !== undefined ? index : currentImageIndex;
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCounter = document.getElementById('lightbox-counter');
    
    lightboxImage.src = imageUrls[lightboxIndex];
    lightboxCounter.textContent = `${lightboxIndex + 1} / ${imageUrls.length}`;
    
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    document.body.style.overflow = 'hidden'; // Prevent body scroll
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
    document.body.style.overflow = ''; // Restore body scroll
}

function lightboxNext() {
    lightboxIndex = (lightboxIndex + 1) % imageUrls.length;
    updateLightbox();
}

function lightboxPrevious() {
    lightboxIndex = (lightboxIndex - 1 + imageUrls.length) % imageUrls.length;
    updateLightbox();
}

function updateLightbox() {
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCounter = document.getElementById('lightbox-counter');
    
    // Fade effect
    lightboxImage.style.opacity = '0.3';
    setTimeout(() => {
        lightboxImage.src = imageUrls[lightboxIndex];
        lightboxImage.style.opacity = '1';
    }, 150);
    
    lightboxCounter.textContent = `${lightboxIndex + 1} / ${imageUrls.length}`;
}

// Close lightbox when clicking outside image
document.getElementById('lightbox')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Add smooth transition to lightbox image
const lightboxImg = document.getElementById('lightbox-image');
if (lightboxImg) {
    lightboxImg.style.transition = 'opacity 0.3s ease-in-out';
}

</script>

@endsection
