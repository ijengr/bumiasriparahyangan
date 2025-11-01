@php $image = $image ?? null; $action = $action ?? (isset($image) ? route('admin.gallery.update', $image) : route('admin.gallery.store')); $method = $method ?? (isset($image) ? 'PUT' : 'POST'); @endphp

<form action="{{ $action }}" method="post" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
    @csrf
    @if(in_array(strtoupper($method), ['PUT','PATCH','DELETE']))
        @method($method)
    @endif

    <div>
        <label class="block text-sm font-medium text-gray-700">Caption</label>
        <input name="caption" value="{{ old('caption', $image->caption ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Images</label>
        <div id="gallery-dropzone" class="relative mt-1 block w-full rounded-md border-dashed border-2 border-gray-200 p-4 text-center cursor-pointer">
            <input id="image-input" name="images[]" type="file" accept="image/*" multiple class="opacity-0 absolute inset-0 w-full h-full cursor-pointer">
            <div id="gallery-dropzone-inner" class="relative">
                <div class="text-sm text-gray-600">Tarik dan lepaskan gambar di sini, atau klik untuk pilih (bisa pilih lebih dari satu)</div>
                <div id="preview-images" class="mt-3 grid grid-cols-4 gap-2"></div>
            </div>
        </div>
        <div id="upload-progress" class="hidden mt-3">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 flex items-center justify-center">
                    <svg id="upload-spinner" class="animate-spin h-5 w-5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path></svg>
                </div>
                <div class="flex-1">
                    <div class="w-full bg-gray-100 rounded h-2 overflow-hidden">
                        <div id="upload-progress-fill" class="bg-emerald-600 h-2 w-0"></div>
                    </div>
                    <div id="upload-progress-text" class="text-xs text-gray-600 mt-1">0%</div>
                    <div id="upload-progress-label" class="text-xs text-gray-500 mt-1">Menunggu...</div>
                </div>
            </div>
        </div>
        @if(isset($image) && $image->path)
            <p class="text-xs text-gray-500 mt-2">Current: {{ basename($image->path) }}</p>
        @endif
    </div>

    <div class="flex items-center justify-end gap-3">
        <button type="button" class="modal-cancel text-sm text-gray-600">Batal</button>
        <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 dark:hover:from-emerald-600 dark:hover:to-teal-600 text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ strtoupper($method) === 'POST' ? 'Simpan Foto' : 'Update Foto' }}
        </button>
    </div>
</form>