@extends('layouts.admin')

@section('page-title', 'Gallery')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 md:py-6">
	<div class="mb-4 md:mb-6">
		<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
			<div>
				<h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
					<span class="p-2 bg-gradient-to-br from-emerald-500 to-teal-600 dark:from-emerald-600 dark:to-teal-700 rounded-xl text-white shadow-lg">
						<svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
						</svg>
					</span>
					Kelola Galeri Foto
				</h1>
				<p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 mt-2 flex items-center gap-2">
					<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
						<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
					</svg>
					Kelola foto galeri yang ditampilkan di website
				</p>
			</div>
			<button id="create-gallery-btn" data-url="{{ route('admin.gallery.create') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 dark:hover:from-emerald-600 dark:hover:to-teal-600 text-white px-4 md:px-6 py-2.5 md:py-3 rounded-xl font-bold text-sm md:text-base shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5">
				<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
				</svg>
				<span class="hidden sm:inline">Tambah Foto Baru</span>
				<span class="sm:hidden">Tambah</span>
			</button>
		</div>
		<div class="mt-3 md:mt-4 h-1 w-24 md:w-32 bg-gradient-to-r from-emerald-600 to-teal-500 dark:from-emerald-500 dark:to-teal-400 rounded-full"></div>
	</div>

	@if($images->isEmpty())
		<div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-12 md:p-16 text-center">
			<div class="flex flex-col items-center justify-center">
				<div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/30 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
					<svg class="w-10 h-10 md:w-12 md:h-12 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
					</svg>
				</div>
				<h3 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-2">Belum ada foto di galeri</h3>
				<p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 mb-6">Tambahkan foto baru untuk ditampilkan di galeri website</p>
				<button id="create-gallery-empty" data-url="{{ route('admin.gallery.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 text-white px-4 md:px-6 py-2.5 md:py-3 rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 font-bold text-sm md:text-base">
					<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
					</svg>
					Upload Foto Pertama
				</button>
			</div>
		</div>
	@else
		<div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
			<div class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 border-b border-emerald-100 dark:border-gray-700 p-4 md:p-5">
				<div class="flex items-center gap-2 md:gap-4 flex-wrap">
					<label class="inline-flex items-center gap-2 text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 cursor-pointer hover:text-emerald-600 dark:hover:text-emerald-400 transition bg-white dark:bg-gray-700 px-3 md:px-4 py-2 rounded-lg shadow-sm">
						<input type="checkbox" id="gallery-select-all" data-select-all class="form-checkbox h-4 w-4 md:h-5 md:w-5 text-emerald-600 dark:text-emerald-500 rounded border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-emerald-500"> 
						<span class="hidden sm:inline">Pilih semua</span>
						<span class="sm:hidden">Semua</span>
					</label>

					<button id="delete-selected" data-bulk-delete="{{ route('admin.gallery.bulkDelete') }}" class="inline-flex items-center gap-1 md:gap-2 text-xs md:text-sm font-bold text-red-600 dark:text-red-400 hover:text-white hover:bg-red-600 dark:hover:bg-red-500 px-3 md:px-4 py-2 rounded-lg transition shadow-sm border border-red-200 dark:border-red-800 hover:border-red-600">
						<svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
						</svg>
						<span class="hidden sm:inline">Hapus Terpilih</span>
						<span class="sm:hidden">Hapus</span>
					</button>

					<button id="download-selected" data-bulk-download="{{ route('admin.gallery.bulkDownload') }}" class="inline-flex items-center gap-1 md:gap-2 text-xs md:text-sm font-bold text-emerald-600 dark:text-emerald-400 hover:text-white hover:bg-emerald-600 dark:hover:bg-emerald-500 px-3 md:px-4 py-2 rounded-lg transition shadow-sm border border-emerald-200 dark:border-emerald-800 hover:border-emerald-600">
						<svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
						</svg>
						<span class="dl-label hidden md:inline">Download Terpilih</span>
						<span class="dl-label md:hidden">Download</span>
						<svg class="dl-spinner hidden animate-spin h-4 w-4" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" stroke-linecap="round" opacity="0.25"/></svg>
					</button>

					<div class="ml-auto flex items-center gap-2 text-xs md:text-sm font-bold text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 px-3 md:px-4 py-2 rounded-xl shadow-sm border border-emerald-100 dark:border-gray-600">
						<svg class="w-4 h-4 md:w-5 md:h-5 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
						</svg>
						<span class="text-cyan-600">{{ $images->total() }}</span> foto
					</div>
				</div>
			</div>

			<div class="p-6">
				<div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
					@include('admin._gallery_grid', ['images' => $images])
				</div>

				<div id="gallery-pagination">@include('admin._gallery_pagination', ['images' => $images])</div>
			</div>

			<div class="mt-6 px-6 pb-6">{{ $images->links() }}</div>
		</div>
	@endif
</div>
@endsection

@push('scripts')
<script>
// Initialize gallery modal behaviors (dropzone, previews, AJAX submit)
function initGalleryModal(modalRoot){
	try {
		if (!modalRoot) return;
		// modalRoot might be the modal element returned by openModal
		const container = modalRoot.querySelector ? modalRoot : document;
		const drop = container.querySelector('#gallery-dropzone');
		const input = container.querySelector('#image-input');
		const preview = container.querySelector('#preview-images');
		const modalForm = container.querySelector('form');
		if (!drop || !input || !preview || !modalForm) return;

		// ensure click triggers file chooser
		if (!drop._wiredClick) { drop.addEventListener('click', function(){ input.click(); }); drop._wiredClick = true; }
		// file input change
		if (!input._wiredChange) { input.addEventListener('change', function(){ if (this.files && this.files.length) previewFiles(this.files); }); input._wiredChange = true; }
		// drag/drop
		if (!drop._wiredDrag) {
			drop.addEventListener('dragover', function(ev){ ev.preventDefault(); drop.classList.add('border-emerald-300'); });
			drop.addEventListener('dragleave', function(ev){ ev.preventDefault(); drop.classList.remove('border-emerald-300'); });
			drop.addEventListener('drop', function(ev){ ev.preventDefault(); drop.classList.remove('border-emerald-300'); const files = ev.dataTransfer && ev.dataTransfer.files; if (files && files.length) { previewFiles(files); } });
			drop._wiredDrag = true;
		}

		// Some browsers/DOM setups may deliver drag events to the overlaid input; mirror handlers on the input
		if (!input._wiredDrag) {
			input.addEventListener('dragover', function(ev){ ev.preventDefault(); drop.classList.add('border-emerald-300'); });
			input.addEventListener('dragleave', function(ev){ ev.preventDefault(); drop.classList.remove('border-emerald-300'); });
			input.addEventListener('drop', function(ev){ ev.preventDefault(); drop.classList.remove('border-emerald-300'); const files = ev.dataTransfer && ev.dataTransfer.files; if (files && files.length) { previewFiles(files); } });
			input._wiredDrag = true;
		}

		// prevent window-level drop while modal present
		if (!modalRoot._dropGuarded) {
			const preventWindowDrop = function(e){ e.preventDefault(); };
			window.addEventListener('dragover', preventWindowDrop);
			window.addEventListener('drop', preventWindowDrop);
			const observer = new MutationObserver(function(){ if (!document.body.contains(modalRoot)) { try { window.removeEventListener('dragover', preventWindowDrop); window.removeEventListener('drop', preventWindowDrop); } catch(e){} try { observer.disconnect(); } catch(e){} } });
			observer.observe(document.body, { childList: true, subtree: true });
			modalRoot._dropGuarded = true;
		}

		// wire form submit if not already wired
		if (modalForm && !modalForm._wiredGallerySubmit) {
			modalForm.addEventListener('submit', async function(ev){
				ev.preventDefault();
				const submitBtn = modalForm.querySelector('button[type=submit]');
				const originalText = submitBtn ? submitBtn.innerText : null;
				try {
					// clear any server-side errors
					modalForm.querySelectorAll('.text-xs.text-red-600').forEach(n=>n.remove());
					if (submitBtn) { submitBtn.disabled = true; submitBtn.innerText = 'Mengunggah...'; }

					const url = modalForm.getAttribute('action');
					const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

					const filesArr = (modalForm._filePreviews || []).map(p=>p.file);
					const previewsArr = (modalForm._filePreviews || []).map(p=>p.node);
					const totalBytes = filesArr.reduce((s,f)=>s+(f.size||0),0) || 1;
					let uploadedBefore = 0;
					const mergedRows = [];

					if (filesArr.length) {
						// show progress UI
						const progressWrap = document.getElementById('upload-progress');
						const progressFill = document.getElementById('upload-progress-fill');
						const progressText = document.getElementById('upload-progress-text');
						if (progressWrap) progressWrap.classList.remove('hidden');

						for (let i=0;i<filesArr.length;i++) {
							const file = filesArr[i];
							const previewNode = previewsArr[i];
							try {
								const json = await new Promise((resolve,reject)=>{
									const fd2 = new FormData();
									fd2.append('images[]', file);
									const captionEl = modalForm.querySelector('[name="caption"]');
									if (captionEl) fd2.append('caption', captionEl.value || '');
									const xhr = new XMLHttpRequest();
									xhr.open((modalForm.method || 'POST'), url);
									xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
									xhr.setRequestHeader('X-CSRF-TOKEN', token);
									xhr.upload.addEventListener('progress', function(e){
										const pct = e.lengthComputable ? Math.round((e.loaded / e.total) * 100) : 0;
										if (previewNode) {
											const bar = previewNode.querySelector('.file-progress');
											const txt = previewNode.querySelector('.file-progress-text');
											if (bar) bar.style.width = pct + '%';
											if (txt) txt.textContent = pct + '%';
										}
										const overall = Math.round(((uploadedBefore + (e.loaded||0)) / totalBytes) * 100);
										if (progressFill) progressFill.style.width = overall + '%';
										if (progressText) progressText.textContent = overall + '%';
									});
									xhr.onload = function(){
										const ct = (xhr.getResponseHeader('content-type') || '').toLowerCase();
										try {
											if (ct.includes('application/json')) resolve(JSON.parse(xhr.responseText));
											else resolve({});
										} catch (e) { reject(e); }
									};
									xhr.onerror = function(){ reject(new Error('Network error')); };
									xhr.send(fd2);
								});

								if (json && Array.isArray(json.rows) && json.rows.length) {
									const container = document.querySelector('.grid');
									const selectAll = document.querySelector('input[data-select-all]');
									const shouldCheck = selectAll && selectAll.checked;
									json.rows.forEach(html=>{
										try {
											const wrapper = document.createElement('div'); wrapper.className = 'group'; wrapper.innerHTML = html; document.querySelector('.grid')?.prepend(wrapper);
											const cb = wrapper.querySelector && wrapper.querySelector('input[data-bulk]'); if (cb) cb.checked = shouldCheck;
										} catch(e) {  }
									});
									mergedRows.push(...json.rows);
									if (previewNode) { const icon = previewNode.querySelector('.upload-status-icon'); if (icon) { icon.innerHTML = '<svg class="h-4 w-4 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>'; icon.classList.remove('hidden'); } }
								} else {
									if (previewNode) { const icon = previewNode.querySelector('.upload-status-icon'); if (icon) { icon.innerHTML = '<svg class="h-4 w-4 text-amber-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 8v.01"/></svg>'; icon.classList.remove('hidden'); } }
								}
							} catch (err) {
								
								const icon = previewsArr[i] && previewsArr[i].querySelector('.upload-status-icon'); if (icon) { icon.innerHTML = '<svg class="h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>'; icon.classList.remove('hidden'); }
							}
							uploadedBefore += (file.size || 0);
						}
					} else {
						// no files — normal form submit via AJAX
						const fd = new FormData(modalForm);
						const res = await fetch(url, { method: (modalForm.method || 'POST'), headers: { 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest' }, body: fd });
						const ct = (res.headers.get('content-type') || '').toLowerCase();
						if (!res.ok) {
							const txt = await res.text().catch(()=>null);
							try {
								const json = ct.includes('application/json') ? await res.json().catch(()=>null) : (txt ? JSON.parse(txt) : null);
								if (res.status === 422 && json && json.errors) { showFormErrors(modalForm, json.errors); return; }
							} catch(e) {}
							throw new Error('Server error');
						}
						if (ct.includes('application/json')) {
							const json = await res.json().catch(()=>null);
							if (json && Array.isArray(json.rows)) mergedRows.push(...json.rows);
						}
					}

					// if mergedRows from per-file flow exist, ensure any not yet inserted are inserted
					if (mergedRows.length) {
						// already inserted during per-file loop; nothing else to do
					}

					// close modal
					const modalRootEl = modalForm.closest && modalForm.closest('.admin-modal-root') ? modalForm.closest('.admin-modal-root') : document.querySelector('.admin-modal-root');
					if (modalRootEl) modalRootEl.querySelector('.modal-close-top')?.click();
					showToast(mergedRows.length ? (mergedRows.length + ' foto diunggah') : 'Foto berhasil diunggah', 'success');
				} catch (err) {
					
					showToast('Gagal mengunggah foto', 'error');
				} finally {
					if (submitBtn) { submitBtn.disabled = false; if (originalText) submitBtn.innerText = originalText; }
				}
			});
			modalForm._wiredGallerySubmit = true;
		}
	} catch (e) {  }
}

// Preview helpers (shared between initGalleryModal and fallback wiring)
const _previewObjectUrls = [];
function clearPreviews(){
	const preview = document.getElementById('preview-images');
	if (preview) preview.innerHTML = '';
}
function previewFiles(files){
	clearPreviews();
	const modalFormLocal = document.querySelector('.admin-modal-root form');
	if (modalFormLocal) modalFormLocal._filePreviews = [];
	const preview = document.getElementById('preview-images');
	if (!preview) return;
	const list = Array.from(files).slice(0,12);
	list.forEach((f, idx) => {
		const url = URL.createObjectURL(f);
		_previewObjectUrls.push(url);
		const wrapper = document.createElement('div');
		wrapper.className = 'w-full h-20 bg-gray-100 rounded overflow-hidden relative';
		wrapper.innerHTML = `
			<img src="${url}" class="w-full h-full object-cover" loading="lazy">
			<div class="absolute inset-0 flex items-center justify-center pointer-events-none">
				<div class="w-full px-2" style="max-width:120px">
					<div class="h-2 bg-black/20 rounded overflow-hidden"><div class="file-progress bg-emerald-600 h-2" style="width:0%"></div></div>
					<div class="text-xs text-white text-center mt-1 file-progress-text">0%</div>
				</div>
			</div>
			<div class="absolute top-1 right-1 w-7 h-7 rounded-full bg-white/90 flex items-center justify-center upload-status-icon hidden"></div>
		`;
		preview.appendChild(wrapper);
		if (modalFormLocal) modalFormLocal._filePreviews.push({ file: f, node: wrapper });
	});

	// revoke object URLs after images have loaded to avoid leaking memory
	setTimeout(() => {
		try {
			_previewObjectUrls.forEach(u => { try { URL.revokeObjectURL(u); } catch (e){} });
			_previewObjectUrls.length = 0;
		} catch (e) {}
	}, 2000);
}

// Create gallery modal trigger (reuses layout openModal)
document.getElementById('create-gallery-btn')?.addEventListener('click', function(e){
	e.preventDefault();
	const url = this.getAttribute('data-url');
	fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
		.then(r => r.text())
		.then(html => {
			const modal = openModal(html);
			try { initGalleryModal(modal); } catch (err) {  }
		})
		.catch(err => );
});

// select-all wiring
document.addEventListener('DOMContentLoaded', function(){
	const selectAll = document.getElementById('gallery-select-all');
	if (selectAll) {
		selectAll.addEventListener('change', function(){
			const boxes = Array.from(document.querySelectorAll('input[data-bulk]'));
			boxes.forEach(cb => cb.checked = selectAll.checked);
		});
	}

	// (removed unused debounced search and caption dropdown JS because the elements were removed)

	// Download selected images as ZIP
	const dlBtn = document.getElementById('download-selected');
	if (dlBtn) {
		dlBtn.addEventListener('click', async function(e){
			e.preventDefault();
			const checkboxes = Array.from(document.querySelectorAll('input[data-bulk]'));
			const ids = checkboxes.filter(cb => cb.checked).map(cb => cb.value);
			if (ids.length === 0) { showToast('Pilih minimal satu gambar.', 'error'); return; }
			const endpoint = dlBtn.getAttribute('data-bulk-download');
			// attempt AJAX POST and handle blob response
			try {
				// show spinner and disable
				dlBtn.disabled = true;
				const label = dlBtn.querySelector('.dl-label');
				const spinner = dlBtn.querySelector('.dl-spinner');
				if (label) label.classList.add('hidden');
				if (spinner) spinner.classList.remove('hidden');
				const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
				const res = await fetch(endpoint, { method: 'POST', headers: { 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/json' }, body: JSON.stringify({ ids }) });
				if (!res.ok) {
					// try to parse JSON error
					const ct = (res.headers.get('content-type')||'').toLowerCase();
					let msg = 'Gagal membuat zip.';
					if (ct.includes('application/json')) {
						const j = await res.json().catch(()=>null);
						if (j && j.message) msg = j.message;
					}
					showToast(msg, 'error');
					return;
				}
				const blob = await res.blob();
				// determine filename from content-disposition header if available
				const cd = res.headers.get('content-disposition') || '';
				let filename = 'gallery_export.zip';
				const m = /filename\*=UTF-8''([^;\n]+)/i.exec(cd) || /filename="?([^";]+)"?/i.exec(cd);
				if (m && m[1]) filename = decodeURIComponent(m[1].replace(/\+/g, ' '));
				// create temporary link to download blob
				const url = URL.createObjectURL(blob);
				const a = document.createElement('a');
				a.href = url; a.download = filename; document.body.appendChild(a); a.click();
				setTimeout(()=>{ try { a.remove(); URL.revokeObjectURL(url); } catch(e){} }, 2000);
			} catch (err) {
				// ensure spinner restored on error
				const label = dlBtn.querySelector('.dl-label');
				const spinner = dlBtn.querySelector('.dl-spinner');
				if (label) label.classList.remove('hidden');
				if (spinner) spinner.classList.add('hidden');
				
				// Fallback: navigate to endpoint with ids as query param
				const url = new URL(endpoint, window.location.origin);
				url.searchParams.set('ids', ids.join(','));
				window.location = url.toString();
			} finally { 
				dlBtn.disabled = false; 
				const label = dlBtn.querySelector('.dl-label');
				const spinner = dlBtn.querySelector('.dl-spinner');
				if (label) label.classList.remove('hidden');
				if (spinner) spinner.classList.add('hidden');
			}
		});
	}

	// delegated confirm-delete for single items
	document.addEventListener('submit', function(e){
		const form = e.target && e.target.matches && e.target.matches('.confirm-delete') ? e.target : null;
		if (!form) return;
		e.preventDefault();
		const container = form.closest('label') || form.closest('div') || form.closest('.group');
		let title = 'Foto';
		try { const cap = container && container.querySelector('.text-sm.font-semibold, .gallery-caption'); if (cap) title = cap.textContent.trim(); } catch (e) {}
		customConfirm('Hapus foto ini?', { title: 'Konfirmasi Hapus', confirmText: 'Hapus', cancelText: 'Batal', items: [{ title }] }).then(ok=>{
			if (!ok) return;
			// prefer data-gallery-id on the container; fallback to input[name=id]
			const gid = container ? container.getAttribute('data-gallery-id') : null;
			let id = gid || (form.querySelector('input[name="id"]') ? form.querySelector('input[name="id"]').value : null) || null;
			if (!id) {
				// As a last resort, attempt to read value from any input[data-bulk]
				const cb = form.querySelector('input[data-bulk]');
				if (cb) id = cb.value;
			}
			const thumbEl = container ? container.querySelector('img') : null;
			const thumb = thumbEl ? (thumbEl.getAttribute('data-src') || thumbEl.src) : null;
			const items = [{ title: title || ('#' + (id || '')) , thumb }];
			// call scheduleDelete (defined in layouts/admin.blade.php)
			scheduleDelete({ ids: [id], endpoint: form.getAttribute('action'), previewItems: items, undoSeconds: 6 })
			.then(result => {
				if (result && result.undone) {
					showToast('Penghapusan dibatalkan', 'info');
				} else {
					showToast('Foto dihapus', 'success');
				}
			}).catch(err => {
				
				showToast('Gagal menghapus foto', 'error');
			});
		});
	});

	// Wire modal dropzone preview and AJAX submit when modal opens (fallback)
	document.addEventListener('click', function(e){
		// try to initialize modal wiring if a modal is present
		setTimeout(function(){
			const modalRoot = document.querySelector('.admin-modal-root');
			if (modalRoot) initGalleryModal(modalRoot);
		}, 80);
	});

// Delegated gallery info modal
document.addEventListener('click', function(e){
	const btn = e.target && e.target.closest ? e.target.closest('.gallery-info') : null;
	if (!btn) return;
	e.preventDefault();
	const name = btn.getAttribute('data-file-name') || '—';
	const size = btn.getAttribute('data-file-size');
	let sizeLabel = '—';
	if (size) {
		const s = Number(size);
		if (!isNaN(s)) {
			if (s > 1024*1024) sizeLabel = (s/(1024*1024)).toFixed(2) + ' MB';
			else sizeLabel = (s/1024).toFixed(1) + ' KB';
		}
	}
	const caption = btn.getAttribute('data-caption') || '';
	const html = `<div class="p-4">
			<h3 class="text-lg font-semibold mb-2">Info Foto</h3>
			<div class="text-sm text-gray-700"><strong>Nama:</strong> ${name}</div>
			<div class="text-sm text-gray-700"><strong>Ukuran:</strong> ${sizeLabel}</div>
			<div class="text-sm text-gray-700 mt-2"><strong>Caption:</strong> ${caption || '—'}</div>
			<div class="mt-4 text-right"><button class="modal-cancel px-3 py-1 rounded bg-gray-100">Tutup</button></div>
		</div>`;
	openModal(html);
});

// Inline caption edit (delegated)
document.addEventListener('click', function(e){
	const cap = e.target && e.target.closest ? e.target.closest('.gallery-caption') : null;
	if (!cap) return;
	// prevent clicks on caption from bubbling to enclosing <label> which would toggle the checkbox
	try { e.stopPropagation(); } catch (er) {}
	// enter edit mode
	const parent = cap.closest('[data-gallery-id]');
	if (!parent) return;
	const id = parent.getAttribute('data-gallery-id');
	const current = cap.textContent.trim();
	const input = document.createElement('input');
	input.type = 'text';
	input.value = current;
	input.className = 'w-full border rounded px-2 py-1 text-sm';
	cap.replaceWith(input);
	input.focus();

	function cancel(){ input.replaceWith(cap); }
	function save(){
		const val = input.value.trim();
		const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
		fetch(`/admin/gallery/${id}`, { method: 'POST', headers: { 'X-CSRF-TOKEN': token, 'X-Requested-With': 'XMLHttpRequest', 'Content-Type': 'application/json' }, body: JSON.stringify({ _method: 'PATCH', caption: val }) })
			.then(r => r.json())
			.then(json => {
				if (json && json.caption !== undefined) {
					cap.textContent = json.caption;
				} else {
					cap.textContent = val;
				}
				input.replaceWith(cap);
			}).catch(err => {  input.replaceWith(cap); });
	}

	input.addEventListener('blur', function(){ save(); });
	input.addEventListener('keydown', function(ev){ if (ev.key === 'Enter') { ev.preventDefault(); save(); } if (ev.key === 'Escape') { cancel(); } });
});
});
</script>
@endpush

