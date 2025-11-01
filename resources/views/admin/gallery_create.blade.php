@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-semibold">Upload Gambar Galeri</h1>
<form action="{{ route('admin.gallery.store') }}" method="post" enctype="multipart/form-data" class="mt-4">
    @csrf
    <div><label>Gambar</label><input name="image" type="file" class="w-full border p-2" required></div>
    <div class="mt-2"><label>Caption (opsional)</label><input name="caption" class="w-full border p-2"></div>
    <div class="mt-4"><button class="bg-emerald-600 text-white px-4 py-2 rounded">Upload</button></div>
</form>
@endsection
