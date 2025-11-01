@props(['options' => [5,10,20,50,100], 'current' => 5])

<div x-data="{ open:false, current: {{ $current }}, options: @json($options), route: '{{ route('admin.messages.setPerPage') }}', select(val){ this.current = val; this.open = false; fetch(this.route, { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=\'csrf-token\']').getAttribute('content'), 'X-Requested-With': 'XMLHttpRequest' }, body: JSON.stringify({ per_page: val }) }).then(()=>{ const params = new URLSearchParams(window.location.search); params.set('per_page', val); window.location.search = params.toString(); }); } }" x-cloak class="relative inline-block">
    <button type="button" @click="open = !open" :aria-expanded="open.toString()" class="perpage-trigger inline-flex items-center justify-between w-20 px-3 py-1 border rounded text-sm bg-white">
        <span class="perpage-value" x-text="current">{{ $current }}</span>
        <svg class="w-4 h-4 text-gray-500 ml-2" viewBox="0 0 20 20" fill="none" stroke="currentColor"><path d="M6 8l4 4 4-4" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>
    </button>

    <ul x-show="open" x-transition class="absolute right-0 mt-1 w-28 bg-white border rounded shadow z-50" role="listbox" aria-hidden="false">
        <template x-for="opt in options" :key="opt">
            <li role="option" tabindex="0" @click="select(opt)" @keydown.enter.prevent="select(opt)" class="px-3 py-2 hover:bg-emerald-50 text-sm" x-text="opt"></li>
        </template>
    </ul>
</div>
