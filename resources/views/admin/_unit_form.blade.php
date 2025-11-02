@php
    $unit = $unit ?? null;
    $action = $action ?? (isset($unit) ? route('admin.units.update', $unit) : route('admin.units.store'));
    $method = $method ?? (isset($unit) ? 'PUT' : 'POST');
    $priceValue = old('price', $unit->price ?? '');
    $priceDisplay = $priceValue !== '' ? number_format($priceValue,0,',','.') : '';
    $titleValue = old('title', $unit->title ?? '');
@endphp

<form action="{{ $action }}" method="post" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-2xl shadow-sm border border-gray-100" data-unit-id="{{ $unit->id ?? '' }}">
    @csrf
    @if(in_array(strtoupper($method), ['PUT','PATCH','DELETE']))
        @method($method)
    @endif
    
    @if(isset($unit) && $unit->id)
        <input type="hidden" name="id" value="{{ $unit->id }}">
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Judul *</label>
            <input name="title" value="{{ $titleValue }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500" required>
            @error('title')<div class="text-xs text-red-600 mt-1">{{ $message }}</div>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Type</label>
            <input name="type" value="{{ old('type', $unit->type ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Luas Tanah (m²)</label>
            <input name="land_area" type="number" value="{{ old('land_area', $unit->land_area ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Luas Bangunan (m²)</label>
            <input name="floor_area" type="number" value="{{ old('floor_area', $unit->floor_area ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Harga (IDR)</label>
            <input id="price-input" name="price" type="text" value="{{ $priceDisplay }}" inputmode="numeric" pattern="[0-9.]*" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Tahun Dibangun</label>
            <input name="built_year" type="number" value="{{ old('built_year', $unit->built_year ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kamar Tidur</label>
            <input name="bedrooms" type="number" value="{{ old('bedrooms', $unit->bedrooms ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Kamar Mandi</label>
            <input name="bathrooms" type="number" value="{{ old('bathrooms', $unit->bathrooms ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Parkir</label>
            <input name="parking" type="number" value="{{ old('parking', $unit->parking ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Gambar Utama</label>
        <div class="mt-2 flex items-center gap-4">
            @php
                $publicFallback = asset('images/placeholder-square.svg');
                $previewSrc = $publicFallback;
                if (!empty($unit->image ?? '')) {
                    $pubCandidate = public_path(ltrim($unit->image, '/'));
                    if (file_exists($pubCandidate)) {
                        $previewSrc = asset(ltrim($unit->image, '/'));
                    } else {
                        $basename = basename($unit->image);
                        $samplePub = public_path('images/samples/' . $basename);
                        if (file_exists($samplePub)) {
                            $previewSrc = asset('images/samples/' . $basename);
                        } else {
                            $storedPath = storage_path('app/public/' . ltrim($unit->image, '/'));
                            if (file_exists($storedPath)) {
                                $previewSrc = asset('storage/' . ltrim($unit->image, '/'));
                            }
                        }
                    }
                }
            @endphp
            <img id="preview-image" src="{{ $previewSrc }}" alt="preview" class="w-32 h-24 object-cover rounded-md border border-gray-200">
            <input name="image" type="file" accept="image/*" id="image-input" class="block">
        </div>
        <p class="text-xs text-gray-500 mt-2">Unggah gambar baru untuk mengganti yang lama. Maks 2MB.</p>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Gambar Tambahan</label>
        <div class="mt-2">
            <input name="additional_images[]" type="file" accept="image/*" id="additional-images-input" multiple class="block w-full text-sm text-gray-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-md file:border-0
                file:text-sm file:font-semibold
                file:bg-emerald-50 file:text-emerald-700
                hover:file:bg-emerald-100">
        </div>
        <p class="text-xs text-gray-500 mt-2">Unggah beberapa gambar sekaligus. Maks 2MB per gambar.</p>
        
        @if(isset($unit) && !empty($unit->images))
        <div class="mt-4">
            <p class="text-sm font-medium text-gray-700 mb-2">Gambar Yang Ada:</p>
            <div id="existing-images-grid" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($unit->images as $imagePath)
                    @php
                        $imageUrl = asset('storage/' . ltrim($imagePath, '/'));
                    @endphp
                    <div class="relative group" data-image-path="{{ $imagePath }}">
                        <img src="{{ $imageUrl }}" alt="additional image" class="w-full h-32 object-cover rounded-md border border-gray-200">
                        <button type="button" 
                                onclick="deleteAdditionalImage(this, '{{ $imagePath }}')"
                                class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white rounded-full p-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('description', $unit->description ?? '') }}</textarea>
    </div>

    <div class="flex items-center justify-end gap-3">
        <button type="button" class="modal-cancel text-sm text-gray-600">Batal</button>
        <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 dark:hover:from-emerald-600 dark:hover:to-teal-600 text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ strtoupper($method) === 'POST' ? 'Simpan Unit' : 'Update Unit' }}
        </button>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Client-side image compression for main image
    const imageInput = document.getElementById('image-input');
    const previewImage = document.getElementById('preview-image');
    
    if (imageInput && previewImage) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;
            
            // Show loading
            previewImage.src = 'data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 50"><text y="30" font-size="10">Compressing...</text></svg>';
            
            new Compressor(file, {
                quality: 0.85,
                maxWidth: 1920,
                maxHeight: 1920,
                success(result) {
                    // Preview compressed image
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(result);
                    
                    // Replace file input with compressed version
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(new File([result], file.name, {
                        type: result.type,
                        lastModified: Date.now()
                    }));
                    imageInput.files = dataTransfer.files;
                },
                error(err) {
                    // Fallback to original
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    }
    
    // Client-side compression for additional images
    const additionalInput = document.getElementById('additional-images-input');
    if (additionalInput) {
        additionalInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            if (files.length === 0) return;
            
            const dataTransfer = new DataTransfer();
            let processed = 0;
            
            files.forEach((file, index) => {
                new Compressor(file, {
                    quality: 0.85,
                    maxWidth: 1920,
                    success(result) {
                        dataTransfer.items.add(new File([result], file.name, {
                            type: result.type
                        }));
                        processed++;
                        
                        if (processed === files.length) {
                            additionalInput.files = dataTransfer.files;
                        }
                    },
                    error(err) {
                        dataTransfer.items.add(file);
                        processed++;
                        
                        if (processed === files.length) {
                            additionalInput.files = dataTransfer.files;
                        }
                    }
                });
            });
        });
    }
});
</script>

