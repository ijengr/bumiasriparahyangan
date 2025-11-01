@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold">Tambah Unit</h1>
        <p class="text-sm text-gray-600">Isi detail unit baru. Field bertanda * wajib diisi.</p>
    </div>

    @include('admin._unit_form')
</div>

@push('scripts')
<script>
document.getElementById('image-input')?.addEventListener('change', function(e){
    const file = e.target.files[0];
    if (!file) return;
    const url = URL.createObjectURL(file);
    document.getElementById('preview-image').src = url;
});
// Format price input with thousand separators (.) while typing
(function initPriceFormatting(){
    const price = document.getElementById('price-input');
    const form = price ? price.closest('form') : null;
    function formatRupiah(v){
        if (!v) return '';
        const digits = v.toString().replace(/\D/g,'');
        return digits.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
    if (!price) return;
    price.addEventListener('input', function(e){
        try {
            const pos = this.selectionStart;
            const raw = this.value;
            const formatted = formatRupiah(raw);
            this.value = formatted;
            // try keep caret near end (simple heuristic)
            this.selectionStart = this.selectionEnd = Math.max(0, this.value.length - (raw.length - pos));
        } catch (err) {
            // silent fail on older browsers
        }
    });
    if (form){
        form.addEventListener('submit', function(){
            // strip non-digits so server receives plain number
            price.value = price.value.replace(/\D/g, '') || '';
        });
    }
})();
</script>
@endpush
@endsection
