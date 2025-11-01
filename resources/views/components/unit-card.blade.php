
@props([
    'id' => null,
    'image' => null,
    'title' => 'Unit',
    'type' => null,
    // accept both snake_case and camelCase attribute names
    'land_area' => null,
    'landArea' => null,
    'price' => null,
    'bedrooms' => null,
    'bedRooms' => null,
    'bathrooms' => null,
    'bathRooms' => null,
    'floor_area' => null,
    'floorArea' => null,
    'parking' => null,
    'built_year' => null,
    'builtYear' => null,
])

    @php
        // normalize possible camelCase props into canonical snake_case variables
        $land_area = $land_area ?? $landArea ?? null;
        $bedrooms = $bedrooms ?? $bedRooms ?? null;
        $bathrooms = $bathrooms ?? $bathRooms ?? null;
        $floor_area = $floor_area ?? $floorArea ?? null;
        $built_year = $built_year ?? $builtYear ?? null;
        // parking stays as-is
        $parking = $parking ?? null;

        // image selection (simple fallback - keep this lightweight)
        $fallback_public = asset('images/placeholder-square.svg');
        $imgSrc = $fallback_public;
        if (!empty($image)) {
            if (preg_match('/^https?:\/\//i', $image)) {
                $imgSrc = $image;
            } else {
                $imgPath = preg_replace('#^/+#', '', trim($image));
                $imgPath = preg_replace('#^(?:storage/)+#i', '', $imgPath);
                $publicCandidate = public_path($imgPath);
                if (file_exists($publicCandidate)) {
                    $imgSrc = asset($imgPath);
                } else {
                    $basename = basename($imgPath);
                    $sampleCandidate = public_path('images/samples/' . $basename);
                    if (file_exists($sampleCandidate)) {
                        $imgSrc = asset('images/samples/' . $basename);
                    } else {
                        $storedPath = storage_path('app/public/' . $imgPath);
                        if (file_exists($storedPath)) {
                            $imgSrc = asset('storage/' . $imgPath);
                        }
                    }
                }
            }
        }
        // normalize price: remove leading 'Rp' if present and trim
        if (!empty($price)) {
            // if price is string and contains 'Rp', strip it
            if (is_string($price)) {
                $price = trim(preg_replace('/^Rp\s*/i', '', $price));
            }

            // if numeric, format with thousand separator (no currency)
            if (is_numeric($price)) {
                $price = number_format((int)$price, 0, ',', '.');
            }
        }
    @endphp




<article {{ $attributes->merge(['class' => 'group bg-white rounded-2xl shadow-md border border-emerald-100/50 hover:shadow-2xl hover:border-emerald-200 transition-all duration-300 flex flex-col overflow-hidden hover:-translate-y-2']) }}>
    <!-- header image / badge area -->
    <div class="relative rounded-t-2xl overflow-hidden bg-gradient-to-br from-emerald-50 to-teal-50">
        <img src="{{ $imgSrc }}" alt="{{ $title }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy" onerror="this.onerror=null;this.src='{{ asset('images/placeholder-square.svg') }}';">
        
        <!-- Gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        
        @if($type)
            <span class="absolute top-3 left-3 inline-flex items-center gap-1.5 bg-gradient-to-r from-emerald-600 to-emerald-700 backdrop-blur-sm rounded-lg text-xs font-bold text-white shadow-lg px-3 py-1.5 border border-white/20">
                <!-- Building2 (type) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21V3h18v18H3zM9 21V9h6v12"/></svg>
                <span>{{ ucfirst($type) }}</span>
            </span>
        @endif

        <!-- Favorite/bookmark icon -->
        <div class="absolute top-3 right-3 w-9 h-9 bg-white/95 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 cursor-pointer hover:bg-emerald-50">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
            </svg>
        </div>
    </div>

    <div class="p-5 flex-1 flex flex-col">
        <h3 class="text-xl font-bold text-gray-900 mb-2 truncate group-hover:text-emerald-700 transition-colors">{{ $title }}</h3>
        
        <!-- Location/Land Area -->
        <div class="flex items-center gap-2 mb-4 text-gray-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-emerald-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9V3h6M21 15v6h-6M3 15v6h6M21 9V3h-6" />
            </svg>
            <span class="text-sm font-semibold">{{ $land_area ? $land_area . ' m²' : '-' }}</span>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-3 gap-3 mb-5">
            <!-- Bedrooms -->
            <div class="flex flex-col items-center gap-2 p-3 bg-gradient-to-br from-emerald-50 to-teal-50/50 rounded-xl border border-emerald-100/50 group-hover:border-emerald-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M5 10v6a1 1 0 001 1h12a1 1 0 001-1v-6M7 10V7a2 2 0 012-2h6a2 2 0 012 2v3" />
                </svg>
                <span class="text-sm font-bold text-gray-900">{{ $bedrooms ?? '-' }}</span>
            </div>

            <!-- Bathrooms -->
            <div class="flex flex-col items-center gap-2 p-3 bg-gradient-to-br from-emerald-50 to-teal-50/50 rounded-xl border border-emerald-100/50 group-hover:border-emerald-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M4 21h16M8 21v-2a4 4 0 014-4h0a4 4 0 014 4v2M12 11v-1" />
                </svg>
                <span class="text-sm font-bold text-gray-900">{{ $bathrooms ?? '-' }}</span>
            </div>

            <!-- Floor Area -->
            <div class="flex flex-col items-center gap-2 p-3 bg-gradient-to-br from-emerald-50 to-teal-50/50 rounded-xl border border-emerald-100/50 group-hover:border-emerald-200 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 21V9l9-6 9 6v12M9 22V12h6v10" />
                </svg>
                <span class="text-xs font-bold text-gray-900 whitespace-nowrap">{{ $floor_area ?? '-' }} m²</span>
            </div>
        </div>

        <!-- Price & Details -->
        <div class="mt-auto pt-4 border-t border-gray-100">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <div class="text-xs text-gray-500 mb-1">Harga</div>
                    <div class="text-emerald-700 font-bold text-xl">Rp {{ $price ?? '-' }}</div>
                </div>
            </div>

            <!-- Meta Info -->
            <div class="flex items-center gap-4 text-xs text-gray-500 mb-4">
                <!-- Built Year -->
                <span class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-medium">{{ $built_year ?? '-' }}</span>
                </span>

                <!-- Parking -->
                <span class="flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 13l1.5-4.5A2 2 0 016.3 7h11.4a2 2 0 011.8 1.5L21 13v6a1 1 0 01-1 1h-1a1 1 0 01-1-1v-1H7v1a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM7 13v-2M17 13v-2" />
                    </svg>
                    <span class="font-medium">{{ $parking ?? '-' }}</span>
                </span>
            </div>

            @if($id)
                <a href="{{ route('landing.units.show', $id) }}" class="flex items-center justify-center gap-2 w-full text-sm font-bold bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white px-4 py-3 rounded-xl shadow-md hover:shadow-lg transition-all">
                    Lihat Detail
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </a>
            @endif
        </div>
    </div>
</article>
