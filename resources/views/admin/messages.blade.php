@extends('layouts.admin')

@section('content')
<div class="mb-4 md:mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                <span class="p-2 bg-gradient-to-br from-emerald-500 to-teal-600 dark:from-emerald-600 dark:to-teal-700 rounded-xl text-white shadow-lg">
                    <svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
                Pesan Pengunjung
            </h1>
            <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 mt-2 flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                Kelola pesan dan pertanyaan dari calon pembeli
            </p>
        </div>
    </div>
    <div class="mt-3 md:mt-4 h-1 w-24 md:w-32 bg-gradient-to-r from-emerald-600 to-teal-500 dark:from-emerald-500 dark:to-teal-400 rounded-full"></div>
</div>

<!-- Filter tabs -->
<div class="mb-4 md:mb-6">
    <nav class="flex space-x-2 overflow-x-auto pb-2">
        @php $active = $filter ?? request()->query('filter', 'all'); @endphp
        <a href="{{ route('admin.messages.index', ['filter' => 'all']) }}" class="px-4 md:px-5 py-2 md:py-2.5 rounded-xl font-bold text-xs md:text-sm transition-all whitespace-nowrap {{ $active === 'all' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-500 dark:to-teal-500 text-white shadow-lg' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:border-emerald-300 dark:hover:border-emerald-600' }}">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Semua
            </span>
        </a>
        <a href="{{ route('admin.messages.index', ['filter' => 'unread']) }}" class="px-4 md:px-5 py-2 md:py-2.5 rounded-xl font-bold text-xs md:text-sm transition-all whitespace-nowrap {{ $active === 'unread' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-500 dark:to-teal-500 text-white shadow-lg' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:border-emerald-300 dark:hover:border-emerald-600' }}">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Belum Dibaca
            </span>
        </a>
        <a href="{{ route('admin.messages.index', ['filter' => 'read']) }}" class="px-4 md:px-5 py-2 md:py-2.5 rounded-xl font-bold text-xs md:text-sm transition-all whitespace-nowrap {{ $active === 'read' ? 'bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-500 dark:to-teal-500 text-white shadow-lg' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:border-emerald-300 dark:hover:border-emerald-600' }}">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                Sudah Dibaca
            </span>
        </a>
    </nav>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 border-b border-emerald-100 dark:border-gray-700 p-4 md:p-5">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 md:gap-4">
                    <div class="text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Menampilkan <span class="text-emerald-600 dark:text-emerald-400">{{ $messages->firstItem() ?? 0 }} - {{ $messages->lastItem() ?? 0 }}</span> dari <span class="text-emerald-600 dark:text-emerald-400">{{ $messages->total() }}</span> pesan
                    </div>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-2 md:gap-3">
                        <form id="admin-search-form" method="get" class="flex items-center gap-2 w-full sm:w-auto">
                            <input type="hidden" name="filter" value="{{ request()->query('filter', 'all') }}">
                            <div class="relative flex-1 sm:flex-initial">
                                <input name="q" type="search" value="{{ request()->query('q') }}" placeholder="Cari..." class="pl-9 md:pl-10 pr-4 py-2 md:py-2.5 rounded-xl border border-emerald-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-xs md:text-sm font-medium placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition w-full sm:w-48 md:w-64">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-4 h-4 md:w-5 md:h-5 text-emerald-400 dark:text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M11 19a8 8 0 100-16 8 8 0 000 16z"/></svg>
                                </div>
                            </div>
                            <button type="submit" class="px-3 md:px-4 py-2 md:py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-500 dark:to-teal-500 text-white font-bold text-xs md:text-sm shadow-lg hover:shadow-xl transition-all whitespace-nowrap">Cari</button>
                        </form>

                        <div class="flex items-center gap-2 text-xs md:text-sm">
                            <label class="font-semibold text-gray-600 dark:text-gray-400 hidden md:inline">Per halaman</label>
                            <x-perpage-dropdown :options="[5,10,20,50,100]" :current="$perPage ?? 5" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 md:p-6">
                @if($messages->isEmpty())
                    <div class="py-12 md:py-16 text-center">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-emerald-100 to-teal-100 dark:from-emerald-900/30 dark:to-teal-900/30 rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                                <svg class="w-10 h-10 md:w-12 md:h-12 text-emerald-500 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                </svg>
                            </div>
                            <h3 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-2">Belum ada pesan</h3>
                            <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400">Pesan dari pengunjung akan muncul di sini</p>
                        </div>
                    </div>
                @else
                    <div class="space-y-3 md:space-y-4">
                        @foreach($messages as $m)
                            <div class="bg-gradient-to-r from-gray-50 to-white dark:from-gray-700 dark:to-gray-800 hover:from-emerald-50 hover:to-white dark:hover:from-emerald-900/20 dark:hover:to-gray-800 rounded-xl shadow-sm hover:shadow-md border {{ !$m->is_read ? 'border-emerald-300 dark:border-emerald-600 bg-emerald-50/30 dark:bg-emerald-900/10' : 'border-gray-100 dark:border-gray-700' }} p-4 md:p-5 transition-all">
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 md:gap-4">
                                    <div class="flex-1">
                                        <div class="flex items-start gap-3">
                                            <div class="w-10 h-10 md:w-12 md:h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 dark:from-emerald-600 dark:to-teal-700 flex items-center justify-center text-white font-bold text-base md:text-lg shadow-lg shadow-emerald-200/50 dark:shadow-emerald-900/50 flex-shrink-0">
                                                {{ strtoupper(substr($m->name,0,1)) }}
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <div class="flex items-center gap-2 flex-wrap">
                                                    <div class="font-bold text-gray-800 dark:text-white text-sm md:text-base">{{ $m->name }}</div>
                                                    @if(!$m->is_read)
                                                        <span class="inline-flex items-center px-2 md:px-3 py-0.5 md:py-1 rounded-full bg-gradient-to-r from-red-500 to-red-600 dark:from-red-600 dark:to-red-700 text-white text-xs font-bold shadow animate-pulse">Baru</span>
                                                    @endif
                                                </div>
                                                <div class="text-xs md:text-sm text-gray-600 dark:text-gray-400 mt-1 flex items-center gap-2 flex-wrap">
                                                    <span class="flex items-center gap-1 break-all">
                                                        <svg class="w-3 h-3 md:w-4 md:h-4 text-gray-400 dark:text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                                        <span class="truncate">{{ $m->email }}</span>
                                                    </span>
                                                    @if(!empty($m->phone))
                                                        <span class="flex items-center gap-1">
                                                            <svg class="w-3 h-3 md:w-4 md:h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                                            {{ $m->phone }}
                                                        </span>
                                                    @endif
                                                    <span class="flex items-center gap-1 text-gray-400 dark:text-gray-500">
                                                        <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                        {{ $m->created_at->diffForHumans() }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-3 md:mt-4">
                                            @if(!empty($m->subject))
                                                <div class="font-bold text-gray-900 dark:text-white mb-2 text-sm md:text-base">{{ $m->subject }}</div>
                                            @endif
                                            <div class="text-xs md:text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900/50 rounded-lg p-3 border border-gray-100 dark:border-gray-700">
                                                {{ Str::limit($m->message, 200) }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex sm:flex-col gap-2">
                                        <a href="{{ route('admin.messages.show', $m) }}" class="inline-flex items-center justify-center gap-1 md:gap-2 px-3 md:px-4 py-2 md:py-2.5 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 dark:hover:from-emerald-600 dark:hover:to-teal-600 text-white rounded-xl font-bold text-xs md:text-sm shadow-lg hover:shadow-xl transition-all whitespace-nowrap">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            <span class="hidden sm:inline">Lihat</span>
                                        </a>
                                        <form action="{{ route('admin.messages.destroy', $m) }}" method="post" onsubmit="event.preventDefault(); showConfirm('Hapus pesan ini?').then(ok => { if (ok) this.submit(); });">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="inline-flex items-center justify-center gap-1 md:gap-2 px-3 md:px-4 py-2 md:py-2.5 bg-white dark:bg-gray-700 border border-red-200 dark:border-red-800 text-red-600 dark:text-red-400 hover:bg-red-600 hover:text-white dark:hover:bg-red-600 hover:border-red-600 rounded-xl font-bold text-xs md:text-sm transition-all whitespace-nowrap w-full">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                <span class="hidden sm:inline">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">{{ $messages->links() }}</div>
                @endif
            </div>
        </div>
    </div>

    <!-- Right column: quick stats / filters -->
    <aside class="lg:sticky lg:top-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-4 md:p-6">
            <h3 class="text-sm md:text-base font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 md:w-5 md:h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Statistik Pesan
            </h3>
            <div class="space-y-3 md:space-y-4">
                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-emerald-900/20 dark:to-teal-900/20 rounded-xl p-4 border border-emerald-100 dark:border-emerald-800">
                    <div class="text-2xl md:text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">{{ $messages->total() }}</div>
                    <div class="text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mt-1">Total Pesan</div>
                </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-4 mt-4">
            <h3 class="text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">Tindakan Cepat</h3>
            <form action="{{ route('admin.messages.bulkDelete') }}" method="post" onsubmit="return confirm('Hapus semua pesan? Ini tidak dapat dibatalkan.');">
                @csrf
                <button type="submit" class="w-full inline-flex justify-center px-3 py-2 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 dark:from-red-500 dark:to-red-600 dark:hover:from-red-600 dark:hover:to-red-700 text-white rounded-lg text-xs md:text-sm font-bold shadow-lg hover:shadow-xl transition-all">Hapus Semua</button>
            </form>
        </div>
    </aside>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function(){
    const perSelect = document.getElementById('per-page-select');
    if (perSelect) {
        perSelect.addEventListener('change', function(){
            const per = this.value;
            // send AJAX POST to persist preference
            fetch("{{ route('admin.messages.setPerPage') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ per_page: per })
            }).then(res => res.json()).then(data => {
                // reload the page with per_page in querystring for immediate effect
                const params = new URLSearchParams(window.location.search);
                params.set('per_page', per);
                window.location.search = params.toString();
            }).catch(()=>{
                // fallback: full GET with per_page
                const params = new URLSearchParams(window.location.search);
                params.set('per_page', per);
                window.location.search = params.toString();
            });
        });
    }
});
</script>
@endpush

{{-- per-page select styles moved to resources/css/app.css as .admin-perpage-select --}}

