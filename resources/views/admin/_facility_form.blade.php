@php
    $facility = $facility ?? null;
    $action = $action ?? (isset($facility) ? route('admin.facilities.update', $facility) : route('admin.facilities.store'));
    $method = $method ?? (isset($facility) ? 'PUT' : 'POST');
@endphp

<form action="{{ $action }}" method="post" enctype="multipart/form-data" class="space-y-6 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
    @csrf
    @if(in_array(strtoupper($method), ['PUT','PATCH','DELETE']))
        @method($method)
    @endif

    <div>
        <label class="block text-sm font-medium text-gray-700">Nama *</label>
        <input name="name" value="{{ old('name', $facility->name ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500" required>
        @error('name')<div class="text-xs text-red-600 mt-1">{{ $message }}</div>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" rows="4" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm focus:ring-emerald-500 focus:border-emerald-500">{{ old('description', $facility->description ?? '') }}</textarea>
        @error('description')<div class="text-xs text-red-600 mt-1">{{ $message }}</div>@enderror
    </div>

    <div class="flex items-center justify-end gap-3">
        <button type="button" class="modal-cancel text-sm text-gray-600">Batal</button>
        <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 dark:hover:from-emerald-600 dark:hover:to-teal-600 text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ strtoupper($method) === 'POST' ? 'Simpan Fasilitas' : 'Update Fasilitas' }}
        </button>
    </div>
</form>