@php
    // $units may be a Collection or Paginator
    $loopIndex = 0;
@endphp
@forelse($units as $index => $unit)
    <div data-aos="fade-up" data-aos-delay="{{ ($loopIndex++ % 6) * 100 }}">
        <x-unit-card
            :id="$unit->id"
            :image="$unit->image"
            :title="$unit->title"
            :type="$unit->type"
            :land_area="$unit->land_area"
            :price="$unit->price"
            :bedrooms="$unit->bedrooms"
            :bathrooms="$unit->bathrooms"
            :floor_area="$unit->floor_area"
            :parking="$unit->parking"
            :built_year="$unit->built_year"
        />
    </div>
@empty
    <div class="col-span-full">
        <div class="text-center py-16 bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-2xl border-2 border-dashed border-gray-300 dark:border-gray-600">
            <div class="w-16 h-16 bg-gray-200 dark:bg-gray-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">{{ $siteSettings['empty_units'] ?? 'Belum Ada Unit' }}</h3>
            <p class="text-gray-500 dark:text-gray-400">{{ $siteSettings['empty_units_desc'] ?? 'Belum ada unit yang tersedia saat ini. Silakan cek kembali nanti.' }}</p>
        </div>
    </div>
@endforelse
