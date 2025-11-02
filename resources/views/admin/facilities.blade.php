@extends('layouts.admin')

@section('page-title', 'Fasilitas')

@section('page-actions')
	<button id="create-facility-btn" data-url="{{ route('admin.facilities.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
		<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
			<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
		</svg>
		Tambah Fasilitas Baru
	</button>
@endsection

@section('content')
<div class="mb-6">
	<div class="flex items-center justify-between">
		<div>
			<h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
				<span class="p-2 bg-gradient-to-br from-teal-500 to-teal-600 dark:from-teal-600 dark:to-teal-700 rounded-xl text-white shadow-lg">
					<svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
					</svg>
				</span>
				Kelola Fasilitas
			</h1>
			<p class="text-sm text-gray-600 dark:text-gray-300 mt-2 flex items-center gap-2">
				<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
					<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
				</svg>
				Atur fasilitas yang tersedia di perumahan
			</p>
		</div>
	</div>
	<div class="mt-4 h-1 w-32 bg-gradient-to-r from-teal-600 to-cyan-500 rounded-full"></div>
</div>

	<div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg dark:shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700">
		<div class="bg-gradient-to-r from-teal-50 to-cyan-50 dark:from-teal-900/20 dark:to-cyan-900/20 border-b border-teal-100 dark:border-teal-800">
			<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 p-4 md:p-5">
				<div class="flex items-center gap-3 md:gap-4 flex-wrap">
					<label class="inline-flex items-center gap-2 text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-200 cursor-pointer hover:text-teal-600 dark:hover:text-teal-400 transition bg-white dark:bg-gray-700 px-3 md:px-4 py-2 rounded-lg shadow-sm">
						<input type="checkbox" id="select-all" class="form-checkbox h-4 w-4 md:h-5 md:w-5 text-teal-600 rounded border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-teal-500 focus:ring-offset-1 transition"> 
						<span>Pilih semua</span>
					</label>
					<button data-bulk-delete="{{ route('admin.facilities.bulkDelete') ?? '#' }}" data-bulk-name="fasilitas" class="inline-flex items-center gap-2 text-xs md:text-sm font-bold text-red-600 dark:text-red-400 hover:text-white hover:bg-red-600 dark:hover:bg-red-700 px-3 md:px-4 py-2 rounded-lg transition shadow-sm border border-red-200 dark:border-red-800 hover:border-red-600">
						<svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
						<span class="hidden sm:inline">Hapus Terpilih</span>
						<span class="sm:hidden">Hapus</span>
					</button>
				</div>
				<div class="flex items-center gap-3 w-full sm:w-auto">
					<div class="relative flex-1 sm:w-64">
						<input type="search" placeholder="Cari fasilitas..." class="block w-full pl-10 pr-4 py-2 md:py-2.5 rounded-lg md:rounded-xl border border-teal-200 dark:border-teal-700 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 text-sm font-medium focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition" id="admin-facility-search">
						<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
							<svg class="w-4 h-4 md:w-5 md:h-5 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
						</div>
					</div>
					<div class="flex items-center gap-2 text-xs md:text-sm font-bold text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 px-3 md:px-4 py-2 md:py-2.5 rounded-lg md:rounded-xl shadow-sm border border-teal-100 dark:border-teal-800">
						<svg class="w-4 h-4 md:w-5 md:h-5 text-teal-500 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
						<span id="facilities-count" class="text-teal-600 dark:text-teal-400">{{ $items->total() }}</span>
					</div>
				</div>
			</div>
		</div>

		<div class="overflow-x-auto table-responsive">
			@php $start = ($items->currentPage() - 1) * $items->perPage(); @endphp
			<table class="w-full table-auto" data-current-page="{{ $items->currentPage() }}" data-per-page="{{ $items->perPage() }}" data-start="{{ $start }}">
				<thead class="bg-gradient-to-r from-teal-50 to-cyan-50 dark:from-teal-900/20 dark:to-cyan-900/20 sticky top-0 z-10">
					<tr class="border-b border-teal-200 dark:border-teal-800">
						<th class="px-4 md:px-6 py-3 md:py-4 w-12"></th>
						<th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider">Nama Fasilitas</th>
						<th class="px-4 md:px-6 py-3 md:py-4 text-left text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider hidden md:table-cell">Deskripsi</th>
						<th class="px-4 md:px-6 py-3 md:py-4 text-right text-xs font-bold text-gray-700 dark:text-gray-200 uppercase tracking-wider w-24 md:w-36">Aksi</th>
					</tr>
				</thead>
				<tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
					@forelse($items as $i => $f)
						@include('admin._facility_row', ['facility' => $f, 'index' => $start + $loop->iteration])
					@empty
						<tr>
							<td colspan="4" class="px-4 py-12 md:py-16">
								<div class="flex flex-col items-center justify-center text-center">
									<div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-teal-100 to-cyan-100 dark:from-teal-900/30 dark:to-cyan-900/30 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
										<svg class="w-10 h-10 md:w-12 md:h-12 text-teal-500 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
									</div>
									<h3 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-2">Belum ada fasilitas</h3>
									<p class="text-sm text-gray-600 dark:text-gray-400 mb-6">Tambahkan fasilitas baru untuk ditampilkan di sini.</p>
									<a href="{{ route('admin.facilities.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-600 to-teal-700 hover:from-teal-700 hover:to-teal-800 text-white px-5 md:px-6 py-2.5 md:py-3 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 font-bold text-sm md:text-base">
										<svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
										Buat Fasilitas Baru
									</a>
								</div>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>

		@if($items->hasPages())
		<div id="facilities-pagination" class="bg-gray-50 dark:bg-gray-900/50 px-4 py-3 border-t border-gray-200 dark:border-gray-700">
			<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
				<div class="text-xs md:text-sm text-gray-600 dark:text-gray-400">
					Showing <span class="font-medium">{{ $items->firstItem() }}</span> to <span class="font-medium">{{ $items->lastItem() }}</span> of <span class="font-medium">{{ $items->total() }}</span> results
				</div>
				<div>
					{{ $items->links() }}
				</div>
			</div>
		</div>
		@endif
	</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
	// select-all checkbox wiring and individual delete confirmation
	const selectAll = document.getElementById('select-all');
	if (selectAll) {
		selectAll.addEventListener('change', function(){
			const checkboxes = Array.from(document.querySelectorAll('input[data-bulk]'));
			checkboxes.forEach(cb => cb.checked = selectAll.checked);
		});
	}

	// delegated handler for individual delete forms - reuse customConfirm for nicer preview
	document.addEventListener('submit', function(e){
		const form = e.target && e.target.matches && e.target.matches('.confirm-delete') ? e.target : null;
		if (!form) return;
		e.preventDefault();
		try {
			const tr = form.closest('tr');
			let title = null;
			let thumb = null;
			if (tr) {
				const tEl = tr.querySelector('[data-facility-name]') || tr.querySelector('[data-unit-title]');
				if (tEl && tEl.textContent && tEl.textContent.trim()) title = tEl.textContent.trim();
				const img = tr.querySelector('img[data-facility-thumb]') || tr.querySelector('img');
				if (img) thumb = img.getAttribute('data-facility-thumb') || img.src || null;
			}
			const items = [{ title: title || ('Fasilitas #' + (form.querySelector('input[name="id"]')?.value || '')), thumb }];
			customConfirm('Hapus fasilitas ini?', { title: 'Konfirmasi Hapus', confirmText: 'Hapus', cancelText: 'Batal', items }).then(ok => {
				if (!ok) return;
				form.submit();
			});
		} catch (err) {
			
			customConfirm('Hapus fasilitas ini?', { title: 'Konfirmasi Hapus', confirmText: 'Hapus', cancelText: 'Batal' }).then(ok => { if (ok) form.submit(); });
		}
	});
	// edit clicks are handled globally in the admin layout (avoid duplicate handlers)

	// live search + ajax pagination wiring (mirrors units implementation but scoped to facilities)
	const searchInput = document.getElementById('admin-facility-search');
	if (searchInput) {
		let searchTimer = null;
		function doLiveSearch(q) {
			const params = new URLSearchParams(window.location.search);
			if (q) params.set('q', q); else params.delete('q');
			params.delete('page');
			const url = window.location.pathname + '?' + params.toString();
			fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
				.then(r => r.text())
				.then(html => {
					try {
						const parser = new DOMParser();
						const doc = parser.parseFromString(html, 'text/html');
						const newTbody = doc.querySelector('table.min-w-full tbody');
						const tbody = document.querySelector('table.min-w-full tbody');
						if (newTbody && tbody) tbody.innerHTML = newTbody.innerHTML;
						const count = doc.querySelector('#facilities-count');
						if (count) document.getElementById('facilities-count').textContent = count.textContent;
						const pagination = doc.querySelector('#facilities-pagination');
						const paginationEl = document.getElementById('facilities-pagination');
						if (pagination && paginationEl) paginationEl.innerHTML = pagination.innerHTML;
					} catch (e) {  }
				}).catch(err => );
		}

		searchInput.addEventListener('input', function(e){
			const q = this.value.trim();
			clearTimeout(searchTimer);
			searchTimer = setTimeout(()=> doLiveSearch(q), 300);
		});

		// AJAX pagination
		document.addEventListener('click', function(e){
			const a = e.target.closest && e.target.closest('#facilities-pagination a');
			if (a) {
				e.preventDefault();
				const url = a.href;
				fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
					.then(r => r.text())
					.then(html => {
						try {
							const parser = new DOMParser();
							const doc = parser.parseFromString(html, 'text/html');
							const newTbody = doc.querySelector('table.min-w-full tbody');
							const tbody = document.querySelector('table.min-w-full tbody');
							if (newTbody && tbody) tbody.innerHTML = newTbody.innerHTML;
							const count = doc.querySelector('#facilities-count');
							if (count) document.getElementById('facilities-count').textContent = count.textContent;
							const pagination = doc.querySelector('#facilities-pagination');
							const paginationEl = document.getElementById('facilities-pagination');
							if (pagination && paginationEl) paginationEl.innerHTML = pagination.innerHTML;
							const table = document.querySelector('table.min-w-full');
							if (table) {
								table.setAttribute('data-current-page', doc.querySelector('table.min-w-full').getAttribute('data-current-page') || '1');
								table.setAttribute('data-per-page', doc.querySelector('table.min-w-full').getAttribute('data-per-page') || '12');
								table.setAttribute('data-start', doc.querySelector('table.min-w-full').getAttribute('data-start') || '0');
							}
							history.pushState({ ajax: true }, '', url);
						} catch (e) {  }
					}).catch(err => );
			}
		});

		// prefill
		const urlParams = new URLSearchParams(window.location.search);
		if (urlParams.has('q')) searchInput.value = urlParams.get('q');

		window.addEventListener('popstate', function(evt){
			try {
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
							const count = doc.querySelector('#facilities-count');
							if (count) document.getElementById('facilities-count').textContent = count.textContent;
							const pagination = doc.querySelector('#facilities-pagination');
							const paginationEl = document.getElementById('facilities-pagination');
							if (pagination && paginationEl) paginationEl.innerHTML = pagination.innerHTML;
							const tableDoc = doc.querySelector('table.min-w-full');
							const table = document.querySelector('table.min-w-full');
							if (tableDoc && table) {
								table.setAttribute('data-current-page', tableDoc.getAttribute('data-current-page') || '1');
								table.setAttribute('data-per-page', tableDoc.getAttribute('data-per-page') || '12');
								table.setAttribute('data-start', tableDoc.getAttribute('data-start') || '0');
							}
						} catch (e) {  }
					}).catch(err => );
			} catch (e) {  }
		});
	}
});
</script>
@endpush

