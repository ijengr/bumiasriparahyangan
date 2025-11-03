@extends('layouts.admin')

@section('page-title', 'Units')
@section('breadcrumbs')
<nav class="flex items-center gap-2 text-gray-500">
    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    <span>/</span>
    <span class="text-gray-700">Units</span>
</nav>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-6">
    @php
        /**
         * Helper to render sortable header links.
         * Usage: sort_link('field', 'Label')
         */
        $sort_link = function($field, $label) use ($sort, $direction) {
            $params = request()->query();
            $currentDir = ($sort === $field) ? $direction : null;
            $nextDir = $currentDir === 'asc' ? 'desc' : 'asc';
            $params['sort'] = $field;
            $params['direction'] = $nextDir;
            $url = url()->current() . '?' . http_build_query($params);
            $arrow = '';
            if ($sort === $field) {
                $arrow = $direction === 'asc' ? ' ▲' : ' ▼';
            }
            return '<a href="' . e($url) . '" class="flex items-center gap-1 hover:text-emerald-600 dark:hover:text-emerald-400 transition">' . e($label) . '<span class="text-xs text-gray-400 dark:text-gray-500">' . $arrow . '</span></a>';
        };
    @endphp
    {{-- Header with gradient accent --}}
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                    <span class="p-2 bg-gradient-to-br from-emerald-500 to-teal-600 dark:from-emerald-600 dark:to-teal-700 rounded-xl text-white shadow-lg">
                        <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </span>
                    Kelola Unit Properti
                </h1>
                <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 mt-2 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    Daftar unit properti di Bumi Asri Parahyangan
                </p>
            </div>
            <button id="create-unit-btn" data-url="{{ route('admin.units.create') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 dark:hover:from-emerald-600 dark:hover:to-teal-600 text-white px-4 md:px-6 py-2.5 md:py-3 rounded-xl font-bold text-sm md:text-base shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="hidden sm:inline">Tambah Unit Baru</span>
                <span class="sm:hidden">Tambah</span>
            </button>
        </div>
        <div class="mt-3 md:mt-4 h-1 w-24 md:w-32 bg-gradient-to-r from-emerald-600 to-teal-500 dark:from-emerald-500 dark:to-teal-400 rounded-full"></div>
    </div>

    {{-- Card with shadow and rounded corners --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
        {{-- Toolbar with better spacing and styling --}}
        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 border-b border-emerald-100 dark:border-gray-700">
            <div class="flex flex-col gap-3 p-4 md:p-5">
                {{-- Row 1: Bulk actions --}}
                <div class="flex items-center gap-2 md:gap-4 flex-wrap">
                    <label class="inline-flex items-center gap-2 text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 cursor-pointer hover:text-emerald-600 dark:hover:text-emerald-400 transition bg-white dark:bg-gray-700 px-3 md:px-4 py-2 rounded-lg shadow-sm">
                        <input type="checkbox" id="select-all" class="form-checkbox h-4 w-4 md:h-5 md:w-5 text-emerald-600 rounded border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1 transition"> 
                        <span class="hidden sm:inline">Pilih semua</span>
                        <span class="sm:hidden">Semua</span>
                    </label>
                    <button data-bulk-delete="{{ route('admin.units.bulkDelete') ?? '#' }}" class="inline-flex items-center gap-1 md:gap-2 text-xs md:text-sm font-bold text-red-600 dark:text-red-400 hover:text-white hover:bg-red-600 dark:hover:bg-red-500 px-3 md:px-4 py-2 rounded-lg transition shadow-sm border border-red-200 dark:border-red-800 hover:border-red-600">
                        <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        <span class="hidden sm:inline">Hapus Terpilih</span>
                        <span class="sm:hidden">Hapus</span>
                    </button>
                </div>
                {{-- Row 2: Search and count --}}
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="relative flex-1 min-w-[200px]">
                        <input type="search" placeholder="Cari nama unit, tipe..." class="block w-full pl-9 md:pl-10 pr-4 py-2 md:py-2.5 rounded-xl border border-emerald-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-xs md:text-sm font-medium placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-emerald-500 dark:focus:ring-emerald-400 focus:border-emerald-500 transition" id="admin-unit-search">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-emerald-400 dark:text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-xs md:text-sm font-bold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 px-3 md:px-4 py-2 md:py-2.5 rounded-xl shadow-sm border border-emerald-100 dark:border-gray-600">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        <span id="units-count" class="text-emerald-600 dark:text-emerald-400">{{ $units->total() }}</span> <span class="hidden sm:inline">unit</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table with enhanced styling --}}
        <div class="overflow-x-auto">
            @php $start = ($units->currentPage() - 1) * $units->perPage(); @endphp
            <table class="w-full" data-current-page="{{ $units->currentPage() }}" data-per-page="{{ $units->perPage() }}" data-start="{{ $start }}">
                <thead class="bg-gradient-to-r from-emerald-50 to-white dark:from-gray-700 dark:to-gray-800 sticky top-0 z-10">
                    <tr class="border-b border-gray-200 dark:border-gray-700">
                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider w-12 hidden">#</th>
                        <th class="px-2 md:px-4 py-2 md:py-3 w-10 md:w-12"></th>
                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">{!! $sort_link('title', 'Unit') !!}</th>
                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden md:table-cell">{!! $sort_link('type', 'Type') !!}</th>
                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">KT</th>
                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">KM</th>
                        <th class="col-land px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden lg:table-cell">Land</th>
                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden lg:table-cell">Floor</th>
                        <th class="col-parking px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden xl:table-cell">Parkir</th>
                        <th class="col-year px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider hidden xl:table-cell">Tahun</th>
                        <th class="px-3 md:px-4 py-2 md:py-3 text-left text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">{!! $sort_link('price', 'Price') !!}</th>
                        <th class="px-3 md:px-4 py-2 md:py-3 text-right text-xs font-semibold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($units as $unit)
                        @include('admin._unit_row', ['unit' => $unit, 'index' => $start + $loop->iteration])
                    @empty
                        <tr>
                            <td colspan="12" class="px-4 py-12 md:py-16">
                                <div class="flex flex-col items-center justify-center text-center">
                                    <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 md:w-12 md:h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                    </div>
                                    <h3 class="text-base md:text-lg font-semibold text-gray-900 dark:text-white mb-2">Belum ada unit</h3>
                                    <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 mb-4">Mulai dengan membuat unit baru untuk ditampilkan di sini.</p>
                                    <a href="{{ route('admin.units.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 text-white px-4 py-2 rounded-lg shadow-lg transition font-medium text-sm">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        Buat Unit Baru
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination footer with improved styling --}}
    @if($units->hasPages())
    <div id="units-pagination" class="bg-gray-50 dark:bg-gray-900/50 px-4 py-3 border-t border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="text-xs md:text-sm text-gray-600 dark:text-gray-400 text-center sm:text-left">
                    Showing <span class="font-medium text-gray-900 dark:text-white">{{ $units->firstItem() }}</span> to <span class="font-medium text-gray-900 dark:text-white">{{ $units->lastItem() }}</span> of <span class="font-medium text-gray-900 dark:text-white">{{ $units->total() }}</span> results
                </div>
                <div>
                    {{ $units->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
// Performance utilities
const debounce = (func, wait) => {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
};

// requestIdleCallback polyfill
if (!('requestIdleCallback' in window)) {
    window.requestIdleCallback = (cb, options) => setTimeout(cb, 1);
}

// Bulk delete handler
document.addEventListener('DOMContentLoaded', function(){
    // Select all checkboxes functionality
    const bulkBtn = document.querySelector('[data-bulk-delete]');
    const selectAll = document.getElementById('select-all');

    function getAllCheckboxes() {
        return document.querySelectorAll('input[data-bulk]');
    }

    function updateSelectAllState() {
        const checkboxes = getAllCheckboxes();
        const checkedCount = document.querySelectorAll('input[data-bulk]:checked').length;
        
        if (selectAll) {
            selectAll.checked = checkedCount > 0 && checkedCount === checkboxes.length;
            selectAll.indeterminate = checkedCount > 0 && checkedCount < checkboxes.length;
        }
        
        // Update row highlighting
        checkboxes.forEach(function(cb) {
            const row = cb.closest('tr');
            if (row) {
                if (cb.checked) {
                    row.classList.add('!bg-emerald-100', 'dark:!bg-emerald-900/30');
                } else {
                    row.classList.remove('!bg-emerald-100', 'dark:!bg-emerald-900/30');
                }
            }
        });
    }

    if (selectAll) {
        selectAll.addEventListener('change', function() {
            const checkboxes = getAllCheckboxes();
            checkboxes.forEach(function(cb) {
                cb.checked = selectAll.checked;
            });
            updateSelectAllState();
        });
    }
    
    // Listen to individual checkbox changes
    document.addEventListener('change', function(e) {
        if (e.target && e.target.hasAttribute('data-bulk')) {
            updateSelectAllState();
        }
    });
    
    // Initial state
    updateSelectAllState();

    // Bulk delete is handled centrally in layouts/admin.blade.php to avoid duplicate handlers

    // delegated handler for individual delete forms - pass unit title/thumb for nicer preview
    document.addEventListener('submit', function(e){
        const form = e.target && e.target.matches && e.target.matches('.confirm-delete') ? e.target : null;
        if (!form) return;
        e.preventDefault();
        try {
            const tr = form.closest('tr');
            let title = null;
            let thumb = null;
            if (tr) {
                const tEl = tr.querySelector('[data-unit-title]');
                if (tEl && tEl.textContent && tEl.textContent.trim()) title = tEl.textContent.trim();
                else {
                    const alt = tr.querySelector('td:nth-child(4)') || tr.querySelector('td');
                    if (alt && alt.textContent && alt.textContent.trim()) title = alt.textContent.trim();
                }
                const img = tr.querySelector('img[data-unit-thumb]') || tr.querySelector('img');
                if (img) thumb = img.getAttribute('data-unit-thumb') || img.src || null;
            }
            const items = [{ title: title || 'Unit #' + (form.querySelector('input[name="id"]')?.value || ''), thumb }];
            customConfirm('Hapus unit ini?', { title: 'Konfirmasi Hapus', confirmText: 'Hapus', cancelText: 'Batal', items }).then(ok => {
                if (!ok) return;
                form.submit();
            });
        } catch (err) {
            
            // fallback to original behavior
            customConfirm('Hapus unit ini?', { title: 'Konfirmasi Hapus', confirmText: 'Hapus', cancelText: 'Batal' }).then(ok => { if (ok) form.submit(); });
        }
    });

    // Search box wiring
    const searchInput = document.getElementById('admin-unit-search');
    if (searchInput) {
        // Optimized live search with debounce
        const doLiveSearch = debounce((q) => {
            const params = new URLSearchParams(window.location.search);
            if (q) params.set('q', q); else params.delete('q');
            params.delete('page');
            const url = window.location.pathname + '?' + params.toString();
            
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                .then(r => r.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newTbody = doc.querySelector('table.min-w-full tbody');
                    const tbody = document.querySelector('table.min-w-full tbody');
                    if (newTbody && tbody) tbody.innerHTML = newTbody.innerHTML;
                    
                    const count = doc.querySelector('#units-count');
                    if (count) document.getElementById('units-count').textContent = count.textContent;
                    
                    const pagination = doc.querySelector('#units-pagination');
                    const paginationEl = document.getElementById('units-pagination');
                    if (pagination && paginationEl) paginationEl.innerHTML = pagination.innerHTML;
                })
                .catch(function(err) {
                    console.error('Search error:', err);
                });
        }, 400); // Increased debounce time

        searchInput.addEventListener('input', function(e){
            const q = this.value.trim();
            doLiveSearch(q);
        });

        // AJAX pagination: use delegated event on pagination container only
        const paginationContainer = document.getElementById('units-pagination');
        if (paginationContainer) {
            paginationContainer.addEventListener('click', function(e){
                const a = e.target.closest('a');
                if (!a) return;
                
                e.preventDefault();
                const url = a.href;
                
                // Use requestIdleCallback for better performance
                const updateTable = () => {
                    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(r => r.text())
                        .then(html => {
                            const parser = new DOMParser();
                            const doc = parser.parseFromString(html, 'text/html');
                            const newTbody = doc.querySelector('table.min-w-full tbody');
                            const tbody = document.querySelector('table.min-w-full tbody');
                            if (newTbody && tbody) tbody.innerHTML = newTbody.innerHTML;
                            
                            const count = doc.querySelector('#units-count');
                            if (count) document.getElementById('units-count').textContent = count.textContent;
                            
                            const pagination = doc.querySelector('#units-pagination');
                            if (pagination) this.innerHTML = pagination.innerHTML;
                            
                            // update data attributes for page & start
                            const tableDoc = doc.querySelector('table.min-w-full');
                            const table = document.querySelector('table.min-w-full');
                            if (tableDoc && table) {
                                table.setAttribute('data-current-page', tableDoc.getAttribute('data-current-page') || '1');
                                table.setAttribute('data-per-page', tableDoc.getAttribute('data-per-page') || '12');
                                table.setAttribute('data-start', tableDoc.getAttribute('data-start') || '0');
                            }
                            
                            // push state
                            history.pushState({ ajax: true }, '', url);
                        })
                        .catch(function(err) {
                            console.error('Pagination error:', err);
                        });
                };
                
                // Use requestIdleCallback if available, otherwise setTimeout
                if ('requestIdleCallback' in window) {
                    requestIdleCallback(updateTable);
                } else {
                    setTimeout(updateTable, 0);
                }
            });
        }

        // prefill from query
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('q')) searchInput.value = urlParams.get('q');

            // handle back/forward navigation restoring ajax-loaded pages
            window.addEventListener('popstate', function(evt){
                try {
                    // only handle our ajax states
                    if (!evt.state || !evt.state.ajax) return;
                    const url = window.location.href;
                    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(r => r.text())
                        .then(html => {
                            try {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const newTbody = doc.querySelector('table.min-w-full tbody');
                                const tbody = document.querySelector('table.min-w-full tbody');
                                if (newTbody && tbody) tbody.innerHTML = newTbody.innerHTML;
                                const count = doc.querySelector('#units-count');
                                if (count) document.getElementById('units-count').textContent = count.textContent;
                                const pagination = doc.querySelector('#units-pagination');
                                const paginationEl = document.getElementById('units-pagination');
                                if (pagination && paginationEl) paginationEl.innerHTML = pagination.innerHTML;
                                // update table data attributes
                                const tableDoc = doc.querySelector('table.min-w-full');
                                const table = document.querySelector('table.min-w-full');
                                if (tableDoc && table) {
                                    table.setAttribute('data-current-page', tableDoc.getAttribute('data-current-page') || '1');
                                    table.setAttribute('data-per-page', tableDoc.getAttribute('data-per-page') || '12');
                                    table.setAttribute('data-start', tableDoc.getAttribute('data-start') || '0');
                                }
                            } catch (e) { console.error('Sort error:', e); }
                        }).catch(function(err) {
                            console.error('Sort fetch error:', err);
                        });
                } catch (e) {  }
            });
    }

    // Draggable column resize (mouse + touch) with double-click compact fallback.
    (function(){
        const table = document.querySelector('table.min-w-full');
        if (!table) return;
        const ths = table.querySelectorAll('thead th');
        const lastIdx = ths.length - 1; // skip last (actions)

        // helper to get all body cells for a column index
        const columnCells = (idx) => Array.from(table.querySelectorAll('tbody tr')).map(r => r.children[idx]);

        ths.forEach((th, idx) => {
            // basic styles
            th.style.position = 'relative';

            // don't add resizer to the last column (actions)
            if (idx === lastIdx) {
                // still allow double-click compact toggle on last if needed
                th.style.cursor = 'col-resize';
                th.addEventListener('dblclick', ()=>{
                    const cells = columnCells(idx);
                    const current = th.getAttribute('data-col-size') || 'normal';
                    if (current === 'normal') {
                        th.setAttribute('data-col-size', 'compact');
                        th.style.width = '80px';
                        cells.forEach(c=>c.style.width='80px');
                    } else {
                        th.setAttribute('data-col-size', 'normal');
                        th.style.width = '';
                        cells.forEach(c=>c.style.width='');
                    }
                });
                return;
            }

            // create resizer handle
            const resizer = document.createElement('div');
            resizer.className = 'col-resizer';
            resizer.style.cssText = 'position:absolute; top:0; right:0; width:8px; cursor:col-resize; user-select:none; height:100%; z-index:5;';
            // subtle visual indicator
            const bar = document.createElement('div');
            bar.style.cssText = 'position:absolute; top:10%; right:2px; width:2px; height:80%; background:rgba(107,114,128,0.35); border-radius:2px;';
            resizer.appendChild(bar);
            th.appendChild(resizer);

            let startX = 0, startWidth = 0, isResizing = false;
            let cachedCells = null; // Cache cells to avoid repeated queries
            const cells = () => {
                if (!cachedCells) cachedCells = columnCells(idx);
                return cachedCells;
            };

            // Throttle resize updates using requestAnimationFrame
            let rafId = null;
            const onMouseMove = (e) => {
                if (!isResizing) return;
                
                if (rafId) return; // Skip if already scheduled
                
                rafId = requestAnimationFrame(() => {
                    const clientX = e.clientX ?? (e.touches && e.touches[0] && e.touches[0].clientX);
                    const dx = clientX - startX;
                    let newWidth = startWidth + dx;
                    if (newWidth < 50) newWidth = 50;
                    th.style.width = newWidth + 'px';
                    cells().forEach(c=> c && (c.style.width = newWidth + 'px'));
                    rafId = null;
                });
            };

            const onMouseUp = () => {
                if (!isResizing) return;
                isResizing = false;
                cachedCells = null; // Clear cache
                
                if (rafId) {
                    cancelAnimationFrame(rafId);
                    rafId = null;
                }
                
                document.removeEventListener('mousemove', onMouseMove);
                document.removeEventListener('touchmove', onMouseMove);
                document.removeEventListener('mouseup', onMouseUp);
                document.removeEventListener('touchend', onMouseUp);
                document.body.style.userSelect = '';
                
                // persist column sizes on resize end
                requestIdleCallback(() => {
                    try {
                        const sizes = Array.from(table.querySelectorAll('thead th')).map(t => t.style.width || '');
                        localStorage.setItem('units_table_col_widths', JSON.stringify(sizes));
                    } catch (e) {}
                }, { timeout: 1000 });
            };

            const startResize = (clientX) => {
                isResizing = true;
                startX = clientX;
                startWidth = th.getBoundingClientRect().width;
                document.body.style.userSelect = 'none';
                document.addEventListener('mousemove', onMouseMove);
                document.addEventListener('touchmove', onMouseMove, {passive:false});
                document.addEventListener('mouseup', onMouseUp);
                document.addEventListener('touchend', onMouseUp);
            };

            resizer.addEventListener('mousedown', function(e){
                e.preventDefault();
                startResize(e.clientX);
            });

            // touch support
            resizer.addEventListener('touchstart', function(e){
                const t = e.touches && e.touches[0];
                if (!t) return;
                startResize(t.clientX);
            }, {passive:true});

            // keep double-click compact toggle as fallback
            th.style.cursor = 'col-resize';
            th.addEventListener('dblclick', ()=>{
                const cellsArr = cells();
                const current = th.getAttribute('data-col-size') || 'normal';
                if (current === 'normal') {
                    th.setAttribute('data-col-size', 'compact');
                    th.style.width = '80px';
                    cellsArr.forEach(c=>c && (c.style.width='80px'));
                } else {
                    th.setAttribute('data-col-size', 'normal');
                    th.style.width = '';
                    cellsArr.forEach(c=>c && (c.style.width=''));
                }
                // persist column sizes after toggling
                try {
                    const sizes = Array.from(table.querySelectorAll('thead th')).map(t => t.style.width || '');
                    localStorage.setItem('units_table_col_widths', JSON.stringify(sizes));
                } catch (e) {}
            });
        });
        
        // restore persisted column widths if present (non-blocking)
        requestIdleCallback(() => {
            try {
                const raw = localStorage.getItem('units_table_col_widths');
                if (raw) {
                    const sizes = JSON.parse(raw);
                    const ths = table.querySelectorAll('thead th');
                    const tbody = table.querySelector('tbody');
                    
                    ths.forEach((th, idx) => {
                        if (sizes[idx]) {
                            th.style.width = sizes[idx];
                            // Apply to body cells using cached selector
                            if (tbody) {
                                const rows = tbody.querySelectorAll('tr');
                                rows.forEach(r => {
                                    const c = r.children[idx];
                                    if (c) c.style.width = sizes[idx];
                                });
                            }
                        }
                    });
                }
            } catch (e) {}
        }, { timeout: 2000 });
    })();
});
</script>
@endpush

