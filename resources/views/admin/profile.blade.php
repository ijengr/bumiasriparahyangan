@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-emerald-50/30 to-teal-50/30 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Profil Saya</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-400">Kelola informasi profil dan keamanan akun Anda</p>
        </div>

        <!-- Success Message -->
        @if(session('status'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-xl p-4 flex items-center gap-3">
            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <p class="text-green-800 dark:text-green-300 font-medium">{{ session('status') }}</p>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Avatar & Info -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
                    <!-- Avatar Section -->
                    <div class="text-center">
                        <div class="relative inline-block">
                            <div class="w-32 h-32 rounded-full overflow-hidden bg-gradient-to-br from-emerald-500 to-teal-500 p-1">
                                <div class="w-full h-full rounded-full overflow-hidden bg-white dark:bg-gray-900 flex items-center justify-center">
                                    @if($user->avatar)
                                        <img id="avatar-preview" src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div id="avatar-placeholder" class="w-full h-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center">
                                            <span class="text-4xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Edit Icon -->
                            <button onclick="document.getElementById('avatar-input').click()" class="absolute bottom-0 right-0 bg-emerald-600 hover:bg-emerald-700 text-white rounded-full p-2 shadow-lg transition-all transform hover:scale-110">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <input type="file" id="avatar-input" class="hidden" accept="image/*" onchange="uploadAvatar(this)">
                        
                        <h2 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                        <span class="inline-block mt-2 px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full text-sm font-semibold">
                            {{ ucfirst($user->role) }}
                        </span>

                        @if($user->avatar)
                        <button onclick="deleteAvatar()" class="mt-4 text-sm text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors">
                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            Hapus Foto
                        </button>
                        @endif
                    </div>

                    <!-- User Info -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700 space-y-3">
                        <div class="flex items-center text-sm">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">Bergabung {{ $user->created_at->locale('id')->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center text-sm">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-600 dark:text-gray-400">Login terakhir: {{ now()->locale('id')->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Forms -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Profile Information Form -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Informasi Profil</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Update informasi akun Anda</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 transition-all">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Email
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 transition-all">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Change Password Form -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-100 dark:border-gray-700 p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Ubah Password</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Pastikan password Anda kuat dan aman</p>
                        </div>
                    </div>

                    <form action="{{ route('admin.profile.password') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label for="current_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Password Saat Ini
                            </label>
                            <input type="password" name="current_password" id="current_password" autocomplete="current-password" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-100 dark:focus:ring-blue-900/50 transition-all">
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Password Baru
                            </label>
                            <input type="password" name="password" id="password" autocomplete="new-password" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-100 dark:focus:ring-blue-900/50 transition-all">
                            @error('password')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimal 8 karakter</p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                Konfirmasi Password Baru
                            </label>
                            <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-blue-500 dark:focus:border-blue-400 focus:ring-2 focus:ring-blue-100 dark:focus:ring-blue-900/50 transition-all">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Upload Avatar
function uploadAvatar(input) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        
        // Validate file type
        if (!file.type.match('image.*')) {
            alert('File harus berupa gambar!');
            return;
        }
        
        // Validate file size (3MB)
        if (file.size > 3 * 1024 * 1024) {
            alert('Ukuran file maksimal 3MB!');
            return;
        }
        
        const formData = new FormData();
        formData.append('avatar', file);
        formData.append('_token', '{{ csrf_token() }}');
        
        // Show loading state
        const preview = document.getElementById('avatar-preview');
        const placeholder = document.getElementById('avatar-placeholder');
        
        fetch('{{ route('admin.profile.avatar') }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update avatar preview
                if (placeholder) {
                    placeholder.outerHTML = `<img id="avatar-preview" src="${data.avatar_url}" alt="Avatar" class="w-full h-full object-cover">`;
                } else if (preview) {
                    preview.src = data.avatar_url;
                }
                
                // Show success message
                showNotification(data.message, 'success');
                
                // Reload page after 1 second
                setTimeout(() => location.reload(), 1000);
            }
        })
        .catch(error => {
            
            showNotification('Terjadi kesalahan saat upload avatar', 'error');
        });
    }
}

// Delete Avatar
function deleteAvatar() {
    if (!confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
        return;
    }
    
    fetch('{{ route('admin.profile.avatar.delete') }}', {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            setTimeout(() => location.reload(), 1000);
        }
    })
    .catch(error => {
        
        showNotification('Terjadi kesalahan', 'error');
    });
}

// Show Notification
function showNotification(message, type = 'success') {
    const colors = {
        success: 'bg-green-50 dark:bg-green-900/20 border-green-200 dark:border-green-800 text-green-800 dark:text-green-300',
        error: 'bg-red-50 dark:bg-red-900/20 border-red-200 dark:border-red-800 text-red-800 dark:text-red-300'
    };
    
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 ${colors[type]} border rounded-xl p-4 shadow-lg z-50 animate-fade-in-down`;
    notification.innerHTML = `
        <div class="flex items-center gap-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${type === 'success' 
                    ? '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                    : '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                }
            </svg>
            <p class="font-medium">${message}</p>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>

<style>
@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-down {
    animation: fade-in-down 0.3s ease-out;
}
</style>
@endsection

