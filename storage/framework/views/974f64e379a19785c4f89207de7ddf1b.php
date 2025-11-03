

<?php $__env->startSection('content'); ?>
<!-- Header Dashboard -->
<div class="mb-6 md:mb-8">
	<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
		<div>
			<h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
				<span class="p-2 bg-gradient-to-br from-emerald-500 to-emerald-600 dark:from-emerald-600 dark:to-emerald-700 rounded-xl text-white shadow-lg">
					<svg class="w-6 h-6 md:w-8 md:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1v-3z"/>
					</svg>
				</span>
				Dashboard Admin
			</h1>
			<p class="mt-2 text-sm md:text-base text-gray-600 dark:text-gray-300 flex items-center gap-2">
				<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
					<path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
				</svg>
				<span class="hidden sm:inline">Ringkasan dan statistik perumahan Bumi Asri Parahyangan</span>
				<span class="sm:hidden">Ringkasan & Statistik</span>
			</p>
		</div>
		<div class="text-left md:text-right">
			<div class="text-xs md:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Waktu Server</div>
			<div class="text-base md:text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
				<svg class="w-4 h-4 md:w-5 md:h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
				</svg>
				<?php echo e(now()->format('d M Y, H:i')); ?>

			</div>
		</div>
	</div>
</div>

<!-- Quick Stats Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
	<!-- Card Pesan -->
	<div class="group relative bg-white dark:bg-gray-800 p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md dark:shadow-xl hover:shadow-xl dark:hover:shadow-2xl border border-emerald-100 dark:border-emerald-800 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
		<div class="absolute top-0 right-0 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-emerald-100/50 dark:from-emerald-900/20 to-transparent rounded-full -mr-12 md:-mr-16 -mt-12 md:-mt-16"></div>
		<div class="relative">
			<div class="flex items-start justify-between mb-3 md:mb-4">
				<div class="p-2 md:p-3 bg-gradient-to-br from-emerald-500 to-emerald-600 dark:from-emerald-600 dark:to-emerald-700 rounded-xl md:rounded-2xl text-white shadow-lg shadow-emerald-200/50 dark:shadow-emerald-900/30 group-hover:shadow-emerald-300/70 group-hover:scale-110 transition-all">
					<svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
					</svg>
				</div>
				<?php if($unreadMessages > 0): ?>
				<span class="px-2 md:px-3 py-1 bg-gradient-to-r from-red-500 to-red-600 text-white text-xs font-bold rounded-full shadow-lg animate-pulse"><?php echo e($unreadMessages); ?></span>
				<?php endif; ?>
			</div>
			<div>
				<div class="text-xs md:text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wide">Pesan Masuk</div>
				<div class="text-2xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-2"><?php echo e($totalMessages); ?></div>
				<div class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold bg-emerald-50 dark:bg-emerald-900/20 rounded-lg px-2 md:px-3 py-1.5 md:py-2 inline-flex items-center gap-1">
					<svg class="w-3 h-3 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/></svg>
					<?php echo e($unreadMessages); ?> belum dibaca
				</div>
			</div>
		</div>
	</div>

	<!-- Card Unit -->
	<div class="group relative bg-white dark:bg-gray-800 p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md dark:shadow-xl hover:shadow-xl dark:hover:shadow-2xl border border-blue-100 dark:border-blue-800 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
		<div class="absolute top-0 right-0 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-blue-100/50 dark:from-blue-900/20 to-transparent rounded-full -mr-12 md:-mr-16 -mt-12 md:-mt-16"></div>
		<div class="relative">
			<div class="flex items-start justify-between mb-3 md:mb-4">
				<div class="p-2 md:p-3 bg-gradient-to-br from-blue-500 to-blue-600 dark:from-blue-600 dark:to-blue-700 rounded-xl md:rounded-2xl text-white shadow-lg shadow-blue-200/50 dark:shadow-blue-900/30 group-hover:shadow-blue-300/70 group-hover:scale-110 transition-all">
					<svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
					</svg>
				</div>
			</div>
			<div>
				<div class="text-xs md:text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wide">Unit Properti</div>
				<div class="text-2xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-2"><?php echo e($totalUnits); ?></div>
				<div class="text-xs text-blue-600 dark:text-blue-400 font-semibold bg-blue-50 dark:bg-blue-900/20 rounded-lg px-2 md:px-3 py-1.5 md:py-2 inline-flex items-center gap-1">
					<svg class="w-3 h-3 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
					Total unit tersedia
				</div>
			</div>
		</div>
	</div>

	<!-- Card Pengguna -->
	<div class="group relative bg-white dark:bg-gray-800 p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md dark:shadow-xl hover:shadow-xl dark:hover:shadow-2xl border border-amber-100 dark:border-amber-800 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
		<div class="absolute top-0 right-0 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-amber-100/50 dark:from-amber-900/20 to-transparent rounded-full -mr-12 md:-mr-16 -mt-12 md:-mt-16"></div>
		<div class="relative">
			<div class="flex items-start justify-between mb-3 md:mb-4">
				<div class="p-2 md:p-3 bg-gradient-to-br from-amber-500 to-amber-600 dark:from-amber-600 dark:to-amber-700 rounded-xl md:rounded-2xl text-white shadow-lg shadow-amber-200/50 dark:shadow-amber-900/30 group-hover:shadow-amber-300/70 group-hover:scale-110 transition-all">
					<svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
					</svg>
				</div>
			</div>
			<div>
				<div class="text-xs md:text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wide">Total Pengguna</div>
				<div class="text-2xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-2"><?php echo e($totalUsers); ?></div>
				<div class="text-xs text-amber-600 dark:text-amber-400 font-semibold bg-amber-50 dark:bg-amber-900/20 rounded-lg px-2 md:px-3 py-1.5 md:py-2 inline-flex items-center gap-1">
					<svg class="w-3 h-3 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/></svg>
					Pengguna terdaftar
				</div>
			</div>
		</div>
	</div>

	<!-- Card Fasilitas -->
	<div class="group relative bg-white dark:bg-gray-800 p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md dark:shadow-xl hover:shadow-xl dark:hover:shadow-2xl border border-purple-100 dark:border-purple-800 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
		<div class="absolute top-0 right-0 w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-purple-100/50 dark:from-purple-900/20 to-transparent rounded-full -mr-12 md:-mr-16 -mt-12 md:-mt-16"></div>
		<div class="relative">
			<div class="flex items-start justify-between mb-3 md:mb-4">
				<div class="p-2 md:p-3 bg-gradient-to-br from-purple-500 to-purple-600 dark:from-purple-600 dark:to-purple-700 rounded-xl md:rounded-2xl text-white shadow-lg shadow-purple-200/50 dark:shadow-purple-900/30 group-hover:shadow-purple-300/70 group-hover:scale-110 transition-all">
					<svg class="w-5 h-5 md:w-7 md:h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
					</svg>
				</div>
			</div>
			<div>
				<div class="text-xs md:text-sm font-semibold text-gray-500 dark:text-gray-400 mb-1 uppercase tracking-wide">Total Fasilitas</div>
				<div class="text-2xl md:text-4xl font-extrabold text-gray-900 dark:text-white mb-2"><?php echo e(\App\Models\Facility::count()); ?></div>
				<div class="text-xs text-purple-600 dark:text-purple-400 font-semibold bg-purple-50 dark:bg-purple-900/20 rounded-lg px-2 md:px-3 py-1.5 md:py-2 inline-flex items-center gap-1">
					<svg class="w-3 h-3 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
					Fasilitas tersedia
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Chart & Activity Section -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6 mb-6 md:mb-8">
	<!-- Chart - 2 columns -->
	<div class="lg:col-span-2 bg-white dark:bg-gray-800 p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md dark:shadow-xl border border-gray-100 dark:border-gray-700">
		<div class="flex items-center justify-between mb-4 md:mb-6">
			<div>
				<h3 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
					<svg class="w-5 h-5 md:w-6 md:h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
					</svg>
					Statistik Pesan Bulanan
				</h3>
				<p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 mt-1">Grafik pesan masuk 6 bulan terakhir</p>
			</div>
		</div>
		<div class="bg-gradient-to-br from-gray-50 to-white dark:from-gray-900/50 dark:to-gray-800/50 rounded-xl p-3 md:p-4 border border-gray-100 dark:border-gray-700">
			<canvas id="messagesChart" height="120"></canvas>
		</div>
	</div>

	<!-- Quick Links - 1 column -->
	<div class="bg-gradient-to-br from-emerald-500 to-emerald-600 dark:from-emerald-700 dark:to-emerald-800 p-4 md:p-6 rounded-xl md:rounded-2xl shadow-lg text-white">
		<h3 class="text-lg md:text-xl font-bold mb-3 md:mb-4 flex items-center gap-2">
			<svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
			</svg>
			Akses Cepat
		</h3>
		<div class="space-y-2 md:space-y-3">
			<a href="<?php echo e(route('admin.units.index')); ?>" class="block bg-white/10 hover:bg-white/20 dark:bg-white/5 dark:hover:bg-white/10 backdrop-blur-sm rounded-lg md:rounded-xl p-3 md:p-4 transition-all group">
				<div class="flex items-center gap-2 md:gap-3">
					<div class="p-1.5 md:p-2 bg-white/20 rounded-lg group-hover:scale-110 transition-transform">
						<svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
						</svg>
					</div>
					<div class="flex-1">
						<div class="font-semibold text-sm md:text-base">Kelola Unit</div>
						<div class="text-xs text-white/70">Tambah & edit properti</div>
					</div>
					<svg class="w-4 h-4 md:w-5 md:h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
				</div>
			</a>
			<a href="<?php echo e(route('admin.facilities.index')); ?>" class="block bg-white/10 hover:bg-white/20 dark:bg-white/5 dark:hover:bg-white/10 backdrop-blur-sm rounded-lg md:rounded-xl p-3 md:p-4 transition-all group">
				<div class="flex items-center gap-2 md:gap-3">
					<div class="p-1.5 md:p-2 bg-white/20 rounded-lg group-hover:scale-110 transition-transform">
						<svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
						</svg>
					</div>
					<div class="flex-1">
						<div class="font-semibold text-sm md:text-base">Kelola Fasilitas</div>
						<div class="text-xs text-white/70">Atur fasilitas tersedia</div>
					</div>
					<svg class="w-4 h-4 md:w-5 md:h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
				</div>
			</a>
			<a href="<?php echo e(route('admin.messages.index')); ?>" class="block bg-white/10 hover:bg-white/20 dark:bg-white/5 dark:hover:bg-white/10 backdrop-blur-sm rounded-lg md:rounded-xl p-3 md:p-4 transition-all group">
				<div class="flex items-center gap-2 md:gap-3">
					<div class="p-1.5 md:p-2 bg-white/20 rounded-lg group-hover:scale-110 transition-transform">
						<svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
						</svg>
					</div>
					<div class="flex-1">
						<div class="font-semibold text-sm md:text-base">Lihat Pesan</div>
						<div class="text-xs text-white/70"><?php echo e($unreadMessages); ?> pesan baru</div>
					</div>
					<svg class="w-4 h-4 md:w-5 md:h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
				</div>
			</a>
			<a href="<?php echo e(route('admin.settings.index')); ?>" class="block bg-white/10 hover:bg-white/20 dark:bg-white/5 dark:hover:bg-white/10 backdrop-blur-sm rounded-lg md:rounded-xl p-3 md:p-4 transition-all group">
				<div class="flex items-center gap-2 md:gap-3">
					<div class="p-1.5 md:p-2 bg-white/20 rounded-lg group-hover:scale-110 transition-transform">
						<svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
						</svg>
					</div>
					<div class="flex-1">
						<div class="font-semibold text-sm md:text-base">Pengaturan</div>
						<div class="text-xs text-white/70">Konfigurasi website</div>
					</div>
					<svg class="w-4 h-4 md:w-5 md:h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
					</svg>
				</div>
			</a>
		</div>
	</div>
</div>

<!-- Latest Activity -->
<div class="mt-4 md:mt-6 bg-white dark:bg-gray-800 p-4 md:p-6 rounded-xl md:rounded-2xl shadow-md dark:shadow-xl border border-gray-100 dark:border-gray-700">
	<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 md:gap-4 mb-4 md:mb-6">
		<div>
			<h4 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
				<svg class="w-5 h-5 md:w-6 md:h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
				</svg>
				Aktivitas Terbaru
			</h4>
			<p class="text-xs md:text-sm text-gray-500 dark:text-gray-400 mt-1">Pesan masuk terbaru dari calon pembeli</p>
		</div>
		<a href="<?php echo e(route('admin.messages.index')); ?>" class="px-3 md:px-4 py-2 bg-emerald-50 hover:bg-emerald-100 dark:bg-emerald-900/20 dark:hover:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-lg md:rounded-xl font-semibold text-xs md:text-sm transition-all flex items-center gap-2 w-fit">
			Lihat Semua
			<svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
			</svg>
		</a>
	</div>
	<?php if(isset($latestMessages) && $latestMessages->count()): ?>
		<div class="space-y-3">
			<?php $__currentLoopData = $latestMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="group bg-gradient-to-r from-gray-50 to-white dark:from-gray-700/30 dark:to-gray-800/30 hover:from-emerald-50 hover:to-white dark:hover:from-emerald-900/20 dark:hover:to-gray-800/40 border border-gray-100 dark:border-gray-700 hover:border-emerald-200 dark:hover:border-emerald-800 rounded-lg md:rounded-xl p-3 md:p-4 transition-all hover:shadow-md dark:hover:shadow-lg">
					<div class="flex items-start gap-3 md:gap-4">
						<div class="flex-shrink-0">
							<div class="w-10 h-10 md:w-12 md:h-12 rounded-lg md:rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 dark:from-emerald-600 dark:to-emerald-700 text-white flex items-center justify-center font-bold text-base md:text-lg shadow-lg shadow-emerald-200/50 dark:shadow-emerald-900/30">
								<?php echo e(strtoupper(substr($m->name ?? 'U',0,1))); ?>

							</div>
						</div>
						<div class="flex-1 min-w-0">
							<div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 mb-2">
								<div class="flex-1">
									<div class="text-sm md:text-base font-bold text-gray-900 dark:text-white flex items-center gap-2 flex-wrap">
										<?php echo e($m->subject ?? '— (Tanpa subjek)'); ?>

										<?php if(!$m->is_read): ?>
											<span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-red-500 text-white animate-pulse">Baru</span>
										<?php endif; ?>
									</div>
									<div class="text-xs md:text-sm text-gray-600 dark:text-gray-300 font-medium mt-1 flex items-center gap-2">
										<svg class="w-3 h-3 md:w-4 md:h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
										</svg>
										<?php echo e($m->name); ?>

									</div>
								</div>
								<div class="text-xs text-gray-400 dark:text-gray-500 whitespace-nowrap flex items-center gap-1">
									<svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
									</svg>
									<?php echo e($m->created_at->diffForHumans()); ?>

								</div>
							</div>
							<div class="text-xs md:text-sm text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-900/40 rounded-lg p-2 md:p-3 border border-gray-100 dark:border-gray-700">
								<?php echo e(Str::limit($m->message, 150)); ?>

							</div>
							<div class="mt-2 md:mt-3 flex flex-wrap items-center gap-2 md:gap-3">
								<?php if($m->email): ?>
								<div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
									<svg class="w-3 h-3 md:w-4 md:h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
									</svg>
									<span class="truncate max-w-[150px] sm:max-w-none"><?php echo e($m->email); ?></span>
								</div>
								<?php endif; ?>
								<?php if($m->phone): ?>
								<div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
									<svg class="w-3 h-3 md:w-4 md:h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
									</svg>
									<?php echo e($m->phone); ?>

								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	<?php else: ?>
		<div class="text-center py-8 md:py-12">
			<div class="inline-flex items-center justify-center w-12 h-12 md:w-16 md:h-16 bg-gray-100 dark:bg-gray-700 rounded-full mb-3 md:mb-4">
				<svg class="w-6 h-6 md:w-8 md:h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
				</svg>
			</div>
			<div class="text-sm md:text-base text-gray-500 dark:text-gray-400 font-medium">Belum ada aktivitas pesan</div>
			<div class="text-xs md:text-sm text-gray-400 dark:text-gray-500 mt-1">Pesan dari calon pembeli akan muncul di sini</div>
		</div>
	<?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script id="dashboard-data" type="application/json"><?php echo json_encode(['months' => $months, 'counts' => $counts, 'unreadCounts' => $unreadCounts]); ?></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\BumiAsriParahyangan\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>