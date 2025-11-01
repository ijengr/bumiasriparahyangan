@extends('layouts.admin')

@section('content')
<h1 class="text-2xl font-semibold">Tambah Fasilitas</h1>
<form action="{{ route('admin.facilities.store') }}" method="post" class="mt-4">
    @csrf
    <div><label>Nama</label><input name="name" class="w-full border p-2" required></div>
    <div class="mt-2"><label>Deskripsi</label><textarea name="description" class="w-full border p-2"></textarea></div>
    <div class="mt-4"><button class="bg-emerald-600 text-white px-4 py-2 rounded">Simpan</button></div>
</form>
@endsection
