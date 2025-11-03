@extends('layouts.admin')

@section('content')
<div class="mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 flex items-center gap-3">
                <span class="p-2 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl text-white shadow-lg">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
                Detail Pesan
            </h1>
            <div class="text-sm text-gray-600 mt-2 flex items-center gap-2 flex-wrap">
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-semibold text-gray-800">{{ $message->name }}</span>
                </span>
                <span class="text-gray-400">•</span>
                <span class="flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ $message->created_at->format('d M Y, H:i') }} WIB
                </span>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border-2 border-gray-200 text-gray-700 hover:border-emerald-300 hover:text-emerald-600 rounded-xl font-bold text-sm transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
            <form action="{{ route('admin.messages.destroy', $message) }}" method="post" onsubmit="event.preventDefault(); showConfirm('Hapus pesan ini?').then(ok => { if (ok) this.submit(); });">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus Pesan
                </button>
            </form>
        </div>
    </div>
    <div class="mt-4 h-1 w-32 bg-gradient-to-r from-emerald-600 to-teal-500 rounded-full"></div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Content - Message Body -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border-2 border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border-b-2 border-emerald-100 p-6">
            <div class="flex items-start gap-4">
                <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white font-bold text-2xl shadow-lg shadow-emerald-200/50">
                    {{ strtoupper(substr($message->name, 0, 1)) }}
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-gray-900 mb-1">{{ $message->name }}</h2>
                    <div class="text-sm text-gray-600 flex items-center gap-3 flex-wrap">
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            {{ $message->email }}
                        </span>
                        @if(!empty($message->phone))
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            {{ $message->phone }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6">
            @if(!empty($message->subject))
                <div class="mb-6">
                    <div class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-2">Subjek</div>
                    <h3 class="text-2xl font-bold text-gray-900">{{ $message->subject }}</h3>
                </div>
            @endif

            <div class="mb-4">
                <div class="text-xs font-bold text-emerald-600 uppercase tracking-wider mb-2">Isi Pesan</div>
                <div class="prose max-w-none text-gray-700 bg-gray-50 rounded-xl p-6 border-2 border-gray-100 leading-relaxed text-base">
                    {!! nl2br(e($message->message)) !!}
                </div>
            </div>

            <div class="mt-6 pt-6 border-t-2 border-gray-100">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Diterima pada <span class="font-semibold text-gray-700">{{ $message->created_at->format('d M Y, H:i') }} WIB</span>
                    <span class="text-gray-400">•</span>
                    <span class="text-gray-600">{{ $message->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar - Contact Info & Actions -->
    <aside class="space-y-4">
        <!-- Contact Card -->
        <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-100 p-6">
            <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Informasi Pengirim
            </h3>

            <div class="space-y-4">
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border-2 border-gray-100">
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Nama Lengkap</div>
                    <div class="font-bold text-gray-900">{{ $message->name }}</div>
                </div>

                <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border-2 border-gray-100">
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Email</div>
                    <a href="mailto:{{ $message->email }}" class="font-bold text-emerald-600 hover:text-emerald-700 break-all">
                        {{ $message->email }}
                    </a>
                </div>

                @if(!empty($message->phone))
                <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border-2 border-gray-100">
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">No. Telepon</div>
                    <a href="tel:{{ $message->phone }}" class="font-bold text-emerald-600 hover:text-emerald-700">
                        {{ $message->phone }}
                    </a>
                </div>
                @endif

                <div class="bg-gradient-to-br from-gray-50 to-white rounded-xl p-4 border-2 border-gray-100">
                    <div class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Waktu Diterima</div>
                    <div class="font-bold text-gray-900">{{ $message->created_at->format('d M Y') }}</div>
                    <div class="text-sm text-gray-600">{{ $message->created_at->format('H:i') }} WIB</div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl shadow-lg border-2 border-emerald-100 p-6">
            <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                Aksi Cepat
            </h3>
            
            <div class="space-y-3">
                <a href="mailto:{{ $message->email }}" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 text-white rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Balas via Email
                </a>

                @if(!empty($message->phone))
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white rounded-xl font-bold text-sm shadow-lg hover:shadow-xl transition-all">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Chat WhatsApp
                </a>
                @endif
            </div>
        </div>
    </aside>
</div>

@endsection
