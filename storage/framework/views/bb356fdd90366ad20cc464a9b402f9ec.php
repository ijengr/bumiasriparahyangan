

<?php $__env->startSection('page-title', 'Pengaturan'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-4 md:mb-6">
    
    <?php if(session('status')): ?>
    <div class="mb-4 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 px-4 py-3 rounded-xl relative" role="alert">
        <span class="block sm:inline"><?php echo e(session('status')); ?></span>
    </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div class="mb-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 px-4 py-3 rounded-xl relative" role="alert">
        <strong class="font-bold">Error!</strong>
        <ul class="mt-2 list-disc list-inside">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
    <?php endif; ?>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">Pengaturan Website</h1>
            <p class="text-xs md:text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola informasi perusahaan yang ditampilkan di website</p>
        </div>
        <div class="flex gap-2">
            <?php if($settings->isEmpty()): ?>
                <form action="<?php echo e(route('admin.settings.seed')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 text-white px-4 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition text-sm md:text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        <span class="hidden sm:inline">Inisialisasi Pengaturan Default</span>
                        <span class="sm:hidden">Init</span>
                    </button>
                </form>
            <?php else: ?>
                <form action="<?php echo e(route('admin.settings.seed')); ?>" method="POST" onsubmit="event.preventDefault(); showConfirm('Update/tambahkan settings yang belum ada ke database?').then(ok => { if (ok) this.submit(); });">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 dark:from-blue-500 dark:to-indigo-500 text-white px-4 py-2 rounded-xl font-bold shadow-lg hover:shadow-xl transition text-sm md:text-base">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        <span class="hidden sm:inline">Seed Default Settings</span>
                        <span class="sm:hidden">Seed</span>
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-3 md:mt-4 h-1 w-20 md:w-24 bg-gradient-to-r from-emerald-600 to-teal-500 dark:from-emerald-500 dark:to-teal-400 rounded-full"></div>
</div>

<?php if($settings->isEmpty()): ?>
    <div class="bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-8 md:p-12 text-center">
        <div class="w-20 h-20 md:w-24 md:h-24 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 md:w-12 md:h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h3 class="text-lg md:text-xl font-bold text-gray-900 dark:text-white mb-2">Belum Ada Pengaturan</h3>
        <p class="text-sm md:text-base text-gray-600 dark:text-gray-400 mb-6">Klik tombol di atas untuk membuat pengaturan default.</p>
    </div>
<?php else: ?>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 mb-6 overflow-hidden">
        <div class="flex overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 scrollbar-track-gray-100 dark:scrollbar-track-gray-800">
            <button type="button" data-tab="general" class="settings-tab-btn flex-1 min-w-[140px] px-4 md:px-6 py-3 md:py-4 flex items-center justify-center gap-2 font-semibold text-sm md:text-base transition-all border-b-2 bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-500 dark:to-teal-500 text-white border-emerald-600 dark:border-emerald-500">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                <span class="hidden sm:inline">Informasi Umum</span>
                <span class="sm:hidden">Umum</span>
            </button>
            <button type="button" data-tab="seo" class="settings-tab-btn flex-1 min-w-[140px] px-4 md:px-6 py-3 md:py-4 flex items-center justify-center gap-2 font-semibold text-sm md:text-base transition-all border-b-2 text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 border-transparent hover:border-emerald-300 dark:hover:border-emerald-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <span class="hidden sm:inline">SEO & Meta Tag</span>
                <span class="sm:hidden">SEO</span>
            </button>
            <button type="button" data-tab="contact" class="settings-tab-btn flex-1 min-w-[140px] px-4 md:px-6 py-3 md:py-4 flex items-center justify-center gap-2 font-semibold text-sm md:text-base transition-all border-b-2 text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 border-transparent hover:border-emerald-300 dark:hover:border-emerald-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                <span class="hidden sm:inline">Kontak</span>
                <span class="sm:hidden">Kontak</span>
            </button>
            <button type="button" data-tab="social" class="settings-tab-btn flex-1 min-w-[140px] px-4 md:px-6 py-3 md:py-4 flex items-center justify-center gap-2 font-semibold text-sm md:text-base transition-all border-b-2 text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 border-transparent hover:border-emerald-300 dark:hover:border-emerald-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span class="hidden sm:inline">Media Sosial</span>
                <span class="sm:hidden">Sosial</span>
            </button>
            <button type="button" data-tab="theme" class="settings-tab-btn flex-1 min-w-[140px] px-4 md:px-6 py-3 md:py-4 flex items-center justify-center gap-2 font-semibold text-sm md:text-base transition-all border-b-2 text-gray-600 dark:text-gray-400 border-transparent hover:text-purple-600 dark:hover:text-purple-400 hover:border-purple-300 dark:hover:border-purple-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                <span class="hidden sm:inline">Tema & Warna</span>
                <span class="sm:hidden">Tema</span>
            </button>
        </div>
    </div>

    <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" class="space-y-4 md:space-y-6" id="settings-form">
        <?php echo csrf_field(); ?>
        
        
        <div id="tab-general" class="settings-tab-content bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg border border-emerald-100 dark:border-gray-700 overflow-hidden">
        <?php if($settings->has('general') && $settings->get('general')->isNotEmpty()): ?>
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-700 dark:to-teal-700 px-4 md:px-6 py-3 md:py-4 flex items-center justify-between">
                <h2 class="text-lg md:text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Informasi Umum
                </h2>
                <a href="<?php echo e(route('landing.index')); ?>" target="_blank" class="inline-flex items-center gap-1 md:gap-2 px-3 py-1.5 md:px-4 md:py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all text-xs md:text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span class="hidden sm:inline">Lihat di Homepage</span>
                    <span class="sm:hidden">Preview</span>
                </a>
            </div>
            <div class="p-4 md:p-6 space-y-4 md:space-y-5">
                <?php
                    // Group settings by category for better organization
                    $generalSettings = collect($settings['general']);
                    
                    // Define setting keys with proper hierarchy (Title → Subtitle → Content → Image → Stats)
                    $companyInfo = ['company_name', 'company_tagline', 'company_description', 'company_logo'];
                    $heroSection = ['hero_title', 'hero_subtitle', 'hero_image'];
                    $featurePills = ['feature1_title', 'feature1_subtitle', 'feature2_title', 'feature2_subtitle', 'feature3_title', 'feature3_subtitle'];
                    $communityCard = ['community_card_title', 'community_card_description', 'community_card_stat'];
                    $featuredUnits = ['featured_title', 'featured_subtitle'];
                    $unitsPage = ['units_title', 'units_subtitle', 'units_stat1', 'units_stat2', 'units_stat3'];
                    $galleryPage = ['gallery_title', 'gallery_subtitle'];
                    $facilitiesPage = ['facilities_title', 'facilities_subtitle', 'facilities_cta_title', 'facilities_cta_subtitle'];
                    $aboutPage = ['about_title', 'about_content', 'about_image', 'about_stat1', 'about_stat2', 'about_stat3'];
                    $ctaSection = ['cta_title', 'cta_subtitle', 'cta_button'];
                    $contactPage = ['contact_badge', 'contact_title', 'contact_subtitle'];
                    $buttonTexts = ['btn_view_units', 'btn_contact_us', 'btn_view_other_units', 'btn_whatsapp', 'btn_schedule_visit'];
                    $badgeTexts = ['badge_facilities', 'badge_gallery'];
                    $unitsCTA = ['units_cta_title', 'units_cta_subtitle'];
                    $emptyStates = ['empty_units', 'empty_units_desc', 'empty_facilities'];
                    $unitDetail = ['unit_detail_default_description', 'unit_detail_feature_1', 'unit_detail_feature_2', 'unit_detail_feature_3', 'unit_detail_feature_4', 'unit_detail_feature_5', 'unit_detail_feature_6'];
                    
                    $sections = [
                        ['id' => 'company', 'title' => 'Info Perusahaan', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => 'emerald', 'keys' => $companyInfo],
                        ['id' => 'hero', 'title' => 'Bagian Hero', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'color' => 'blue', 'keys' => $heroSection],
                        ['id' => 'features', 'title' => 'Poin Fitur', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01', 'color' => 'purple', 'keys' => $featurePills],
                        ['id' => 'community', 'title' => 'Kartu Komunitas', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'color' => 'teal', 'keys' => $communityCard],
                        ['id' => 'featured', 'title' => 'Unit Unggulan', 'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z', 'color' => 'indigo', 'keys' => $featuredUnits],
                        ['id' => 'units', 'title' => 'Halaman Unit', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => 'orange', 'keys' => $unitsPage],
                        ['id' => 'gallery', 'title' => 'Halaman Galeri', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z', 'color' => 'pink', 'keys' => $galleryPage],
                        ['id' => 'facilities', 'title' => 'Halaman Fasilitas', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'color' => 'green', 'keys' => $facilitiesPage],
                        ['id' => 'about', 'title' => 'Halaman Tentang', 'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'cyan', 'keys' => $aboutPage],
                        ['id' => 'cta', 'title' => 'Bagian CTA', 'icon' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9', 'color' => 'red', 'keys' => $ctaSection],
                        ['id' => 'contact', 'title' => 'Halaman Kontak', 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'yellow', 'keys' => $contactPage],
                        ['id' => 'buttons', 'title' => 'Teks Tombol', 'icon' => 'M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122', 'color' => 'gray', 'keys' => $buttonTexts],
                        ['id' => 'badges', 'title' => 'Lencana Halaman', 'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z', 'color' => 'violet', 'keys' => $badgeTexts],
                        ['id' => 'unitscta', 'title' => 'CTA Unit', 'icon' => 'M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z', 'color' => 'amber', 'keys' => $unitsCTA],
                        ['id' => 'emptystates', 'title' => 'Status Kosong', 'icon' => 'M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4', 'color' => 'slate', 'keys' => $emptyStates],
                        ['id' => 'unitdetail', 'title' => 'Detail Unit', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'color' => 'sky', 'keys' => $unitDetail],
                    ];
                ?>
                
                
                <div class="mb-4">
                    <div class="relative">
                        <input 
                            type="text" 
                            id="settings-search" 
                            placeholder="🔍 Cari pengaturan..." 
                            class="w-full px-4 py-2.5 pl-10 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 dark:focus:ring-emerald-400 focus:border-emerald-500 dark:focus:border-emerald-400 transition-all"
                            oninput="filterSettings(this.value)"
                        >
                        <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <p id="search-result-info" class="hidden text-xs text-gray-500 dark:text-gray-400 mt-2"></p>
                </div>
                
                
                <div id="sub-tabs-container" class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-2">
                                🏠 Homepage
                            </label>
                            <select onchange="switchSubTab(this.value)" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                <option value="company">Info Perusahaan (<?php echo e(count($companyInfo ?? [])); ?>)</option>
                                <option value="hero">Bagian Hero (<?php echo e(count($heroSection ?? [])); ?>)</option>
                                <option value="features">Poin Fitur (<?php echo e(count($featurePills ?? [])); ?>)</option>
                                <option value="community">Kartu Komunitas (<?php echo e(count($communityCard ?? [])); ?>)</option>
                                <option value="featured">Unit Unggulan (<?php echo e(count($featuredUnits ?? [])); ?>)</option>
                                <option value="cta">Bagian CTA (<?php echo e(count($ctaSection ?? [])); ?>)</option>
                            </select>
                        </div>
                        
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-2">
                                📄 Halaman
                            </label>
                            <select onchange="switchSubTab(this.value)" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                <option value="">Pilih halaman...</option>
                                <option value="units">Halaman Unit (<?php echo e(count($unitsPage ?? [])); ?>)</option>
                                <option value="unitdetail">Detail Unit (<?php echo e(count($unitDetail ?? [])); ?>)</option>
                                <option value="gallery">Galeri (<?php echo e(count($galleryPage ?? [])); ?>)</option>
                                <option value="facilities">Fasilitas (<?php echo e(count($facilitiesPage ?? [])); ?>)</option>
                                <option value="about">Tentang (<?php echo e(count($aboutPage ?? [])); ?>)</option>
                                <option value="contact">Kontak (<?php echo e(count($contactPage ?? [])); ?>)</option>
                            </select>
                        </div>
                        
                        
                        <div>
                            <label class="block text-xs font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider mb-2">
                                🧩 Komponen
                            </label>
                            <select onchange="switchSubTab(this.value)" class="w-full px-3 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all">
                                <option value="">Pilih komponen...</option>
                                <option value="buttons">Tombol (<?php echo e(count($buttonTexts ?? [])); ?>)</option>
                                <option value="badges">Lencana (<?php echo e(count($badgeTexts ?? [])); ?>)</option>
                                <option value="unitscta">CTA Unit (<?php echo e(count($unitsCTA ?? [])); ?>)</option>
                                <option value="emptystates">Status Kosong (<?php echo e(count($emptyStates ?? [])); ?>)</option>
                            </select>
                        </div>
                    </div>
                </div>

                
                <div id="subtab-company" class="subtab-content border-l-4 border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20 p-4 rounded-r-lg transition-opacity duration-300 opacity-100">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            Informasi Perusahaan
                        </h3>
                        <button type="button" onclick="togglePreview('preview-company')" class="text-xs text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-company" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-emerald-200 dark:border-emerald-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📍 Footer, About Page, Meta Tags</p>
                        <ul class="space-y-1 text-gray-600 dark:text-gray-400 text-[11px]">
                            <li>• <strong>Nama:</strong> Header, footer, title browser</li>
                            <li>• <strong>Tagline:</strong> Slogan di about page</li>
                            <li>• <strong>Deskripsi:</strong> Konten about page</li>
                            <li>• <strong>Logo:</strong> Header (misal: /images/logo.png)</li>
                        </ul>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $companySettings = $generalSettings->whereIn('key', $companyInfo)
                                ->sortBy(function($setting) use ($companyInfo) {
                                    return array_search($setting->key, $companyInfo);
                                }); 
                        ?>
                        <?php if($companySettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $companySettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-hero" class="subtab-content hidden border-l-4 border-blue-500 bg-blue-50 dark:bg-blue-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-blue-700 dark:text-blue-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Hero Section (Homepage)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-hero')" class="text-xs text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-hero" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-blue-200 dark:border-blue-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📍 Homepage - Section paling atas</p>
                        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-gray-700 dark:to-gray-800 p-3 rounded-lg space-y-1.5">
                            <div class="inline-block px-2 py-0.5 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 rounded-full text-[9px] font-semibold">🏠 Badge</div>
                            <p class="text-base font-bold text-gray-900 dark:text-white">📝 [Hero Title]</p>
                            <p class="text-[10px] text-gray-600 dark:text-gray-300">📝 [Hero Subtitle]</p>
                            <div class="flex gap-1.5 pt-1">
                                <span class="px-2 py-1 bg-emerald-600 text-white rounded text-[8px] font-semibold">Lihat Unit</span>
                                <span class="px-2 py-1 border border-emerald-600 text-emerald-600 rounded text-[8px] font-semibold">Hubungi</span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $heroSettings = $generalSettings->whereIn('key', $heroSection)
                                ->sortBy(function($setting) use ($heroSection) {
                                    return array_search($setting->key, $heroSection);
                                }); 
                        ?>
                        <?php if($heroSettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $heroSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-features" class="subtab-content hidden border-l-4 border-purple-500 bg-purple-50 dark:bg-purple-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-purple-700 dark:text-purple-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                            Feature Pills - 3 Cards (Homepage)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-features')" class="text-xs text-purple-600 dark:text-purple-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-features" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-purple-200 dark:border-purple-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📍 Homepage - 3 card horizontal di bawah Hero</p>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="bg-white dark:bg-gray-700 p-2 rounded-lg shadow border border-gray-200 dark:border-gray-600">
                                <div class="w-7 h-7 bg-gradient-to-br from-emerald-100 to-emerald-200 rounded-lg flex items-center justify-center mb-1">🗺️</div>
                                <p class="font-bold text-gray-900 dark:text-white text-[9px] leading-tight">📝 Judul 1</p>
                                <p class="text-gray-600 dark:text-gray-400 text-[8px] leading-tight">📝 Subjudul 1</p>
                            </div>
                            <div class="bg-white dark:bg-gray-700 p-2 rounded-lg shadow border border-gray-200 dark:border-gray-600">
                                <div class="w-7 h-7 bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg flex items-center justify-center mb-1">🔒</div>
                                <p class="font-bold text-gray-900 dark:text-white text-[9px] leading-tight">📝 Judul 2</p>
                                <p class="text-gray-600 dark:text-gray-400 text-[8px] leading-tight">📝 Subjudul 2</p>
                            </div>
                            <div class="bg-white dark:bg-gray-700 p-2 rounded-lg shadow border border-gray-200 dark:border-gray-600">
                                <div class="w-7 h-7 bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center mb-1">🌳</div>
                                <p class="font-bold text-gray-900 dark:text-white text-[9px] leading-tight">📝 Judul 3</p>
                                <p class="text-gray-600 dark:text-gray-400 text-[8px] leading-tight">📝 Subjudul 3</p>
                            </div>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="space-y-3">
                            <p class="text-xs font-semibold text-purple-600 dark:text-purple-400 uppercase">Feature 1</p>
                            <?php 
                                $feature1Keys = ['feature1_title', 'feature1_subtitle'];
                                $feature1Settings = $generalSettings->filter(fn($s) => str_starts_with($s->key, 'feature1_'))
                                    ->sortBy(function($setting) use ($feature1Keys) {
                                        return array_search($setting->key, $feature1Keys);
                                    });
                            ?>
                            <?php $__currentLoopData = $feature1Settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="space-y-3">
                            <p class="text-xs font-semibold text-purple-600 dark:text-purple-400 uppercase">Feature 2</p>
                            <?php 
                                $feature2Keys = ['feature2_title', 'feature2_subtitle'];
                                $feature2Settings = $generalSettings->filter(fn($s) => str_starts_with($s->key, 'feature2_'))
                                    ->sortBy(function($setting) use ($feature2Keys) {
                                        return array_search($setting->key, $feature2Keys);
                                    });
                            ?>
                            <?php $__currentLoopData = $feature2Settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="space-y-3">
                            <p class="text-xs font-semibold text-purple-600 dark:text-purple-400 uppercase">Feature 3</p>
                            <?php 
                                $feature3Keys = ['feature3_title', 'feature3_subtitle'];
                                $feature3Settings = $generalSettings->filter(fn($s) => str_starts_with($s->key, 'feature3_'))
                                    ->sortBy(function($setting) use ($feature3Keys) {
                                        return array_search($setting->key, $feature3Keys);
                                    });
                            ?>
                            <?php $__currentLoopData = $feature3Settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>

                
                <div id="subtab-community" class="subtab-content hidden border-l-4 border-teal-500 bg-teal-50 dark:bg-teal-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-teal-700 dark:text-teal-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Community Card (Homepage)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-community')" class="text-xs text-teal-600 dark:text-teal-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-community" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-teal-200 dark:border-teal-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📍 Homepage - Card komunitas di tengah halaman</p>
                        <div class="bg-gradient-to-br from-teal-50 to-emerald-50 dark:from-gray-700 dark:to-gray-800 p-3 rounded-lg">
                            <div class="flex items-center gap-2 mb-2">
                                <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900/50 rounded-full flex items-center justify-center text-lg">👥</div>
                                <div>
                                    <p class="font-bold text-gray-900 dark:text-white text-sm">📝 [Judul Card]</p>
                                    <p class="text-[10px] text-gray-600 dark:text-gray-300">📝 [Deskripsi]</p>
                                </div>
                            </div>
                            <div class="bg-white dark:bg-gray-700 rounded p-2 text-center">
                                <p class="text-2xl font-bold text-teal-600 dark:text-teal-400">📝 [500+]</p>
                                <p class="text-[9px] text-gray-600 dark:text-gray-400">Keluarga</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $communitySettings = $generalSettings->whereIn('key', $communityCard)
                                ->sortBy(function($setting) use ($communityCard) {
                                    return array_search($setting->key, $communityCard);
                                }); 
                        ?>
                        <?php if($communitySettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $communitySettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-featured" class="subtab-content hidden border-l-4 border-indigo-500 bg-indigo-50 dark:bg-indigo-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-indigo-700 dark:text-indigo-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                            Featured Units Section (Homepage)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-featured')" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-featured" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-indigo-200 dark:border-indigo-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📍 Homepage - Section unit unggulan</p>
                        <div class="space-y-2">
                            <p class="text-sm font-bold text-gray-900 dark:text-white">📝 [Judul Section]</p>
                            <p class="text-[10px] text-gray-600 dark:text-gray-400">📝 [Subjudul/Deskripsi]</p>
                            <div class="grid grid-cols-3 gap-2 pt-2">
                                <div class="bg-gray-100 dark:bg-gray-700 rounded aspect-video"></div>
                                <div class="bg-gray-100 dark:bg-gray-700 rounded aspect-video"></div>
                                <div class="bg-gray-100 dark:bg-gray-700 rounded aspect-video"></div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $featuredSettings = $generalSettings->whereIn('key', $featuredUnits)
                                ->sortBy(function($setting) use ($featuredUnits) {
                                    return array_search($setting->key, $featuredUnits);
                                }); 
                        ?>
                        <?php if($featuredSettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $featuredSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-units" class="subtab-content hidden border-l-4 border-orange-500 bg-orange-50 dark:bg-orange-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-orange-700 dark:text-orange-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            Units Page (Halaman Daftar Unit)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-units')" class="text-xs text-orange-600 dark:text-orange-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-units" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-orange-200 dark:border-orange-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📍 Units Page - Hero subtitle dan 3 statistik card</p>
                        <div class="space-y-2">
                            <p class="text-[10px] text-gray-600 dark:text-gray-400 mb-2">📝 [Hero Subtitle]</p>
                            <div class="grid grid-cols-3 gap-2">
                                <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-gray-700 dark:to-gray-800 p-2 rounded text-center">
                                    <p class="text-lg font-bold text-emerald-600 dark:text-emerald-400">📝 [50+]</p>
                                    <p class="text-[8px] text-gray-600 dark:text-gray-400">📝 [Label 1]</p>
                                </div>
                                <div class="bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-gray-700 dark:to-gray-800 p-2 rounded text-center">
                                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400">📝 [200m²]</p>
                                    <p class="text-[8px] text-gray-600 dark:text-gray-400">📝 [Label 2]</p>
                                </div>
                                <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-gray-700 dark:to-gray-800 p-2 rounded text-center">
                                    <p class="text-lg font-bold text-purple-600 dark:text-purple-400">📝 [5km]</p>
                                    <p class="text-[8px] text-gray-600 dark:text-gray-400">📝 [Label 3]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $unitsSettings = $generalSettings->whereIn('key', $unitsPage)
                                ->sortBy(function($setting) use ($unitsPage) {
                                    return array_search($setting->key, $unitsPage);
                                }); 
                        ?>
                        <?php if($unitsSettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $unitsSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-gallery" class="subtab-content hidden border-l-4 border-pink-500 bg-pink-50 dark:bg-pink-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-pink-700 dark:text-pink-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Gallery Page (Halaman Galeri)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-gallery')" class="text-xs text-pink-600 dark:text-pink-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-gallery" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-pink-200 dark:border-pink-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📍 Gallery Page - Hero subtitle di bawah judul</p>
                        <div class="space-y-1">
                            <p class="text-base font-bold text-gray-900 dark:text-white">Galeri</p>
                            <p class="text-[10px] text-gray-600 dark:text-gray-400">📝 [Hero Subtitle]</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $gallerySettings = $generalSettings->whereIn('key', $galleryPage)
                                ->sortBy(function($setting) use ($galleryPage) {
                                    return array_search($setting->key, $galleryPage);
                                }); 
                        ?>
                        <?php if($gallerySettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $gallerySettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-facilities" class="subtab-content hidden border-l-4 border-green-500 bg-green-50 dark:bg-green-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-green-700 dark:text-green-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            Facilities Section + CTA (Homepage & Facilities Page)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-facilities')" class="text-xs text-green-600 dark:text-green-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-facilities" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-green-200 dark:border-green-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📍 Homepage & Facilities Page - Judul, subtitle, dan CTA card</p>
                        <div class="space-y-2">
                            <div>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">📝 [Judul Facilities]</p>
                                <p class="text-[10px] text-gray-600 dark:text-gray-400">📝 [Subtitle]</p>
                            </div>
                            <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-gray-700 dark:to-gray-800 p-3 rounded-lg border-2 border-green-200 dark:border-green-700">
                                <span class="text-[8px] bg-green-600 text-white px-2 py-0.5 rounded-full">📝 [Badge]</span>
                                <p class="text-xs font-bold text-gray-900 dark:text-white mt-1">📝 [CTA Title]</p>
                                <p class="text-[9px] text-gray-600 dark:text-gray-400">📝 [CTA Subtitle]</p>
                                <div class="flex gap-1 mt-2">
                                    <span class="text-[7px] px-2 py-1 bg-green-600 text-white rounded">📝 [Button 1]</span>
                                    <span class="text-[7px] px-2 py-1 border border-green-600 text-green-600 rounded">📝 [Button 2]</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $facilitiesSettings = $generalSettings->whereIn('key', $facilitiesPage)
                                ->sortBy(function($setting) use ($facilitiesPage) {
                                    return array_search($setting->key, $facilitiesPage);
                                }); 
                        ?>
                        <?php if($facilitiesSettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $facilitiesSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-about" class="subtab-content hidden border-l-4 border-cyan-500 bg-cyan-50 dark:bg-cyan-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-cyan-700 dark:text-cyan-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            About Page (Halaman Tentang Kami)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-about')" class="text-xs text-cyan-600 dark:text-cyan-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-about" class="hidden mb-4 p-4 bg-white dark:bg-gray-800 rounded-lg border border-cyan-200 dark:border-cyan-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-3">📍 About Page - Halaman Tentang Kami</p>
                        
                        <div class="grid grid-cols-2 gap-3">
                            
                            <div class="space-y-2">
                                <div class="p-2 bg-cyan-50 dark:bg-cyan-900/30 rounded">
                                    <p class="text-[9px] font-bold text-cyan-700 dark:text-cyan-300 mb-1">Hero & Content</p>
                                    <p class="text-[8px] text-gray-600 dark:text-gray-400">📝 [About Title] - Judul halaman</p>
                                    <p class="text-[8px] text-gray-600 dark:text-gray-400">📝 [About Content] - Deskripsi perusahaan</p>
                                </div>
                                
                                <div class="p-2 bg-cyan-50 dark:bg-cyan-900/30 rounded">
                                    <p class="text-[9px] font-bold text-cyan-700 dark:text-cyan-300 mb-1">Statistics (3 Stats)</p>
                                    <div class="grid grid-cols-3 gap-1">
                                        <div class="text-center">
                                            <p class="text-[8px] font-bold text-cyan-600">�</p>
                                            <p class="text-[7px] text-gray-500">[Stat1]</p>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-[8px] font-bold text-cyan-600">📊</p>
                                            <p class="text-[7px] text-gray-500">[Stat2]</p>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-[8px] font-bold text-cyan-600">📊</p>
                                            <p class="text-[7px] text-gray-500">[Stat3]</p>
                                        </div>
                                    </div>
                                    <p class="text-[7px] text-gray-500 mt-1">Format: "100+|Unit Terjual"</p>
                                </div>
                            </div>
                            
                            
                            <div class="space-y-2">
                                <div class="w-full h-24 bg-gray-200 dark:bg-gray-700 rounded flex items-center justify-center">
                                    <p class="text-[9px] text-gray-500">🖼️ [About Image]</p>
                                </div>
                                <p class="text-[7px] text-gray-500 text-center">Gambar tentang perusahaan</p>
                            </div>
                        </div>
                        
                        <p class="text-[7px] text-gray-500 mt-2 pt-2 border-t border-cyan-200 dark:border-cyan-700">
                            � Total: 6 fields (Title, Content, Image, 3 Statistics)
                        </p>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $aboutSettings = $generalSettings->whereIn('key', $aboutPage)
                                ->sortBy(function($setting) use ($aboutPage) {
                                    return array_search($setting->key, $aboutPage);
                                }); 
                        ?>
                        <?php if($aboutSettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $aboutSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-cta" class="subtab-content hidden border-l-4 border-red-500 bg-red-50 dark:bg-red-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-red-700 dark:text-red-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                            Bagian Call to Action (Homepage)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-cta')" class="text-xs text-red-600 dark:text-red-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-cta" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-red-200 dark:border-red-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📍 Homepage - CTA section di bagian bawah</p>
                        <div class="bg-gradient-to-r from-red-50 to-orange-50 dark:from-gray-700 dark:to-gray-800 p-3 rounded-lg text-center">
                            <p class="text-sm font-bold text-gray-900 dark:text-white">📝 [CTA Title]</p>
                            <p class="text-[10px] text-gray-600 dark:text-gray-400 mb-2">📝 [CTA Subtitle]</p>
                            <span class="inline-block text-[8px] px-3 py-1.5 bg-red-600 text-white rounded-lg font-semibold">📝 [Button Text]</span>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $ctaSettings = $generalSettings->whereIn('key', $ctaSection)
                                ->sortBy(function($setting) use ($ctaSection) {
                                    return array_search($setting->key, $ctaSection);
                                }); 
                        ?>
                        <?php if($ctaSettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $ctaSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-contact" class="subtab-content hidden border-l-4 border-yellow-500 bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-yellow-700 dark:text-yellow-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            Contact Page (Header)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-contact')" class="text-xs text-yellow-600 dark:text-yellow-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-contact" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-yellow-200 dark:border-yellow-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-2">📍 Halaman Kontak - Header bagian atas</p>
                        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-gray-700 dark:to-gray-800 p-4 rounded-lg text-center">
                            <div class="inline-block px-3 py-1 bg-emerald-100 dark:bg-emerald-900/50 text-emerald-700 dark:text-emerald-300 text-[9px] font-semibold rounded-full mb-2">
                                📝 [Badge Text]
                            </div>
                            <p class="text-base font-bold text-gray-900 dark:text-white mb-1">Mari <span class="text-emerald-600">📝 [Title]</span></p>
                            <p class="text-[10px] text-gray-600 dark:text-gray-400">📝 [Subtitle - Deskripsi singkat]</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $contactSettings = $generalSettings->whereIn('key', $contactPage)
                                ->sortBy(function($setting) use ($contactPage) {
                                    return array_search($setting->key, $contactPage);
                                }); 
                        ?>
                        <?php if($contactSettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $contactSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-buttons" class="subtab-content hidden border-l-4 border-gray-500 bg-gray-50 dark:bg-gray-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-gray-700 dark:text-gray-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"/></svg>
                            Button Texts (Global)
                        </h3>
                        <button type="button" onclick="togglePreview('preview-buttons')" class="text-xs text-gray-600 dark:text-gray-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-buttons" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-3">📍 Digunakan di berbagai halaman (Homepage, Units, Facilities, Unit Detail, dll)</p>
                        <div class="grid grid-cols-2 gap-2">
                            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 dark:from-gray-700 dark:to-gray-800 p-2 rounded-lg">
                                <p class="text-[9px] text-gray-600 dark:text-gray-400 mb-1">Homepage Hero:</p>
                                <div class="flex gap-1">
                                    <span class="inline-block text-[7px] px-2 py-1 bg-emerald-600 text-white rounded">📝 [Btn View Units]</span>
                                    <span class="inline-block text-[7px] px-2 py-1 border border-emerald-600 text-emerald-600 rounded">📝 [Btn Contact]</span>
                                </div>
                            </div>
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-700 dark:to-gray-800 p-2 rounded-lg">
                                <p class="text-[9px] text-gray-600 dark:text-gray-400 mb-1">Unit Detail:</p>
                                <span class="inline-block text-[7px] px-2 py-1 bg-green-600 text-white rounded">📝 [WhatsApp]</span>
                            </div>
                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 dark:from-gray-700 dark:to-gray-800 p-2 rounded-lg col-span-2">
                                <p class="text-[9px] text-gray-600 dark:text-gray-400 mb-1">CTA Sections:</p>
                                <span class="inline-block text-[7px] px-2 py-1 bg-blue-600 text-white rounded">📝 [View Other Units]</span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $buttonSettings = $generalSettings->whereIn('key', $buttonTexts)
                                ->sortBy(function($setting) use ($buttonTexts) {
                                    return array_search($setting->key, $buttonTexts);
                                }); 
                        ?>
                        <?php if($buttonSettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $buttonSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-badges" class="subtab-content hidden border-l-4 border-violet-500 bg-violet-50 dark:bg-violet-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-violet-700 dark:text-violet-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            Page Badges
                        </h3>
                        <button type="button" onclick="togglePreview('preview-badges')" class="text-xs text-violet-600 dark:text-violet-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-badges" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-violet-200 dark:border-violet-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-3">📍 Badge kecil di atas judul halaman</p>
                        <div class="space-y-2">
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-700 dark:to-gray-800 p-2 rounded-lg">
                                <p class="text-[9px] text-gray-600 dark:text-gray-400 mb-1">Facilities Page:</p>
                                <span class="inline-block text-[8px] px-2 py-0.5 bg-green-600/10 text-green-700 dark:text-green-400 rounded-full border border-green-600/20 font-medium">📝 [Badge Facilities]</span>
                            </div>
                            <div class="bg-gradient-to-r from-pink-50 to-rose-50 dark:from-gray-700 dark:to-gray-800 p-2 rounded-lg">
                                <p class="text-[9px] text-gray-600 dark:text-gray-400 mb-1">Gallery Page:</p>
                                <span class="inline-block text-[8px] px-2 py-0.5 bg-pink-600/10 text-pink-700 dark:text-pink-400 rounded-full border border-pink-600/20 font-medium">📝 [Badge Gallery]</span>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $badgeSettings = $generalSettings->whereIn('key', $badgeTexts)
                                ->sortBy(function($setting) use ($badgeTexts) {
                                    return array_search($setting->key, $badgeTexts);
                                }); 
                        ?>
                        <?php if($badgeSettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $badgeSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-unitscta" class="subtab-content hidden border-l-4 border-amber-500 bg-amber-50 dark:bg-amber-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-amber-700 dark:text-amber-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                            Units Page CTA Section
                        </h3>
                        <button type="button" onclick="togglePreview('preview-unitscta')" class="text-xs text-amber-600 dark:text-amber-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-unitscta" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-amber-200 dark:border-amber-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-3">📍 Muncul di bagian bawah halaman Units</p>
                        <div class="bg-gradient-to-r from-orange-50 to-amber-50 dark:from-gray-700 dark:to-gray-800 p-4 rounded-lg">
                            <div class="text-center">
                                <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-2">📝 [Units CTA Title]</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">📝 [Units CTA Subtitle]</p>
                                <button class="px-4 py-2 bg-emerald-600 text-white text-xs rounded-lg">📝 [Btn Contact Us]</button>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $unitsCTASettings = $generalSettings->whereIn('key', $unitsCTA)
                                ->sortBy(function($setting) use ($unitsCTA) {
                                    return array_search($setting->key, $unitsCTA);
                                }); 
                        ?>
                        <?php if($unitsCTASettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $unitsCTASettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-emptystates" class="subtab-content hidden border-l-4 border-slate-500 bg-slate-50 dark:bg-slate-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-slate-700 dark:text-slate-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                            Pesan Status Kosong
                        </h3>
                        <button type="button" onclick="togglePreview('preview-emptystates')" class="text-xs text-slate-600 dark:text-slate-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-emptystates" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-slate-200 dark:border-slate-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-3">📍 Muncul ketika data kosong (tidak ada unit/fasilitas)</p>
                        <div class="space-y-3">
                            <div class="bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-gray-800 p-3 rounded-lg">
                                <p class="text-[9px] text-gray-600 dark:text-gray-400 mb-2">Units Page (no units available):</p>
                                <div class="text-center py-4 bg-white dark:bg-gray-900 rounded border border-dashed border-gray-300 dark:border-gray-600">
                                    <p class="text-xs font-medium text-gray-600 dark:text-gray-400">📝 [Empty Units]</p>
                                    <p class="text-[10px] text-gray-500 dark:text-gray-500 mt-1">📝 [Empty Units Desc]</p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 dark:from-gray-700 dark:to-gray-800 p-3 rounded-lg">
                                <p class="text-[9px] text-gray-600 dark:text-gray-400 mb-2">Homepage (no facilities):</p>
                                <div class="text-center py-4 bg-white dark:bg-gray-900 rounded border border-dashed border-gray-300 dark:border-gray-600">
                                    <p class="text-xs text-gray-600 dark:text-gray-400">📝 [Empty Facilities]</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $emptySettings = $generalSettings->whereIn('key', $emptyStates)
                                ->sortBy(function($setting) use ($emptyStates) {
                                    return array_search($setting->key, $emptyStates);
                                }); 
                        ?>
                        <?php if($emptySettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $emptySettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div id="subtab-unitdetail" class="subtab-content hidden border-l-4 border-sky-500 bg-sky-50 dark:bg-sky-900/20 p-4 rounded-r-lg">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <h3 class="text-base md:text-lg font-bold text-sky-700 dark:text-sky-300 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Unit Detail Page Content
                        </h3>
                        <button type="button" onclick="togglePreview('preview-unitdetail')" class="text-xs text-sky-600 dark:text-sky-400 hover:underline flex items-center gap-1 flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            Contoh
                        </button>
                    </div>
                    <div id="preview-unitdetail" class="hidden mb-4 p-3 bg-white dark:bg-gray-800 rounded-lg border border-sky-200 dark:border-sky-700 text-xs">
                        <p class="font-semibold text-gray-700 dark:text-gray-300 mb-3">📍 Digunakan di halaman Unit Detail</p>
                        <div class="space-y-3">
                            <div class="bg-gradient-to-r from-sky-50 to-blue-50 dark:from-gray-700 dark:to-gray-800 p-3 rounded-lg">
                                <p class="text-[9px] text-gray-600 dark:text-gray-400 mb-2">Deskripsi Default (jika unit tidak punya deskripsi):</p>
                                <div class="bg-white dark:bg-gray-900 p-3 rounded border border-dashed border-gray-300 dark:border-gray-600">
                                    <p class="text-[10px] text-gray-600 dark:text-gray-400">📝 [Default Description]</p>
                                </div>
                            </div>
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-700 dark:to-gray-800 p-3 rounded-lg">
                                <p class="text-[9px] text-gray-600 dark:text-gray-400 mb-2">Fitur & Keunggulan (6 item):</p>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="bg-white dark:bg-gray-900 p-2 rounded text-center">
                                        <p class="text-[9px] text-gray-600 dark:text-gray-400">✓ 📝 [Feature 1]</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-900 p-2 rounded text-center">
                                        <p class="text-[9px] text-gray-600 dark:text-gray-400">✓ 📝 [Feature 2]</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-900 p-2 rounded text-center">
                                        <p class="text-[9px] text-gray-600 dark:text-gray-400">✓ 📝 [Feature 3]</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-900 p-2 rounded text-center">
                                        <p class="text-[9px] text-gray-600 dark:text-gray-400">✓ 📝 [Feature 4]</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-900 p-2 rounded text-center">
                                        <p class="text-[9px] text-gray-600 dark:text-gray-400">✓ 📝 [Feature 5]</p>
                                    </div>
                                    <div class="bg-white dark:bg-gray-900 p-2 rounded text-center">
                                        <p class="text-[9px] text-gray-600 dark:text-gray-400">✓ 📝 [Feature 6]</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <?php 
                            $unitDetailSettings = $generalSettings->whereIn('key', $unitDetail)
                                ->sortBy(function($setting) use ($unitDetail) {
                                    return array_search($setting->key, $unitDetail);
                                }); 
                        ?>
                        <?php if($unitDetailSettings->isEmpty()): ?>
                            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    <div>
                                        <p class="font-semibold text-yellow-800 dark:text-yellow-300 mb-1">Setting belum tersedia</p>
                                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol <strong>"Seed Default Settings"</strong> di atas untuk membuat pengaturan default.</p>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $unitDetailSettings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('admin.settings._field', ['setting' => $setting], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="p-8 text-center">
                <p class="text-gray-500 dark:text-gray-400">
                    Tidak ada pengaturan General. Klik tombol "Seed Default Settings" untuk membuat pengaturan default.
                </p>
            </div>
        <?php endif; ?>
        </div>
        
        <div id="tab-seo" class="settings-tab-content hidden bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg border border-blue-100 dark:border-gray-700 overflow-hidden">
        <?php if($settings->has('seo') && $settings->get('seo')->isNotEmpty()): ?>
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-700 dark:to-teal-700 px-4 md:px-6 py-3 md:py-4 flex items-center justify-between">
                <h2 class="text-lg md:text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    SEO & Meta Tag
                </h2>
                <a href="<?php echo e(route('landing.index')); ?>" target="_blank" class="inline-flex items-center gap-1 md:gap-2 px-3 py-1.5 md:px-4 md:py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all text-xs md:text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    <span class="hidden sm:inline">Lihat di Browser</span>
                    <span class="sm:hidden">Preview</span>
                </a>
            </div>
            <div class="p-4 md:p-6 space-y-4 md:space-y-5">
                <?php
                    $seoSettings = collect($settings['seo'] ?? [])->keyBy('key');
                ?>
                
                <div>
                    <label for="meta_title" class="block text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Meta Title
                    </label>
                    <input 
                        type="text" 
                        name="settings[meta_title]" 
                        id="meta_title"
                        value="<?php echo e(old('settings.meta_title', $seoSettings['meta_title']->value ?? '')); ?>"
                        placeholder="Bumi Asri Parahyangan - Property Terbaik di Bandung"
                        class="w-full px-3 md:px-4 py-2 md:py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 transition-all text-sm md:text-base"
                    >
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maks. 60 karakter untuk hasil optimal di Google</p>
                </div>

                <div>
                    <label for="meta_description" class="block text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Meta Description
                    </label>
                    <textarea 
                        name="settings[meta_description]" 
                        id="meta_description"
                        rows="3"
                        placeholder="Deskripsi singkat tentang website Anda untuk search engine"
                        class="w-full px-3 md:px-4 py-2 md:py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 transition-all text-sm md:text-base"
                    ><?php echo e(old('settings.meta_description', $seoSettings['meta_description']->value ?? '')); ?></textarea>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maks. 160 karakter untuk hasil optimal di Google</p>
                </div>

                <div>
                    <label for="meta_keywords" class="block text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Meta Keywords
                    </label>
                    <input 
                        type="text" 
                        name="settings[meta_keywords]" 
                        id="meta_keywords"
                        value="<?php echo e(old('settings.meta_keywords', $seoSettings['meta_keywords']->value ?? '')); ?>"
                        placeholder="property, rumah, bandung, jual rumah"
                        class="w-full px-3 md:px-4 py-2 md:py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 transition-all text-sm md:text-base"
                    >
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Pisahkan dengan koma</p>
                </div>

                <div>
                    <label for="favicon" class="block text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Favicon (Icon Browser)
                    </label>
                    <div class="space-y-3">
                        <?php
                            $faviconValue = old('settings.favicon', $seoSettings['favicon']->value ?? '/images/favicon.ico');
                            $faviconUrl = asset($faviconValue);
                        ?>
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 flex items-center justify-center p-2">
                                <img id="favicon-preview" src="<?php echo e($faviconUrl); ?>" alt="Favicon Preview" class="max-w-full max-h-full object-contain" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke=%22%23999%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%222%22 d=%22M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z%22/%3E%3C/svg%3E'">
                            </div>
                            <div class="flex-1">
                                <input 
                                    type="file" 
                                    name="favicon_upload" 
                                    id="favicon-upload"
                                    accept=".ico,.png,.svg"
                                    onchange="previewImage(this, 'favicon-preview', 'favicon')"
                                    class="block w-full text-sm text-gray-500 dark:text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-lg file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-emerald-50 file:text-emerald-700
                                        hover:file:bg-emerald-100
                                        dark:file:bg-emerald-900/30 dark:file:text-emerald-400
                                        cursor-pointer"
                                >
                                <input type="hidden" name="settings[favicon]" id="favicon" value="<?php echo e($faviconValue); ?>">
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format .ico, .png, atau .svg (ukuran 16x16, 32x32, 64x64 px)</p>
                </div>

                <div>
                    <label for="theme_color" class="block text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Theme Color (Browser Mobile)
                    </label>
                    <div class="flex gap-2 items-center">
                        <input 
                            type="color" 
                            name="settings[theme_color]" 
                            id="theme_color"
                            value="<?php echo e(old('settings.theme_color', $seoSettings['theme_color']->value ?? '#10b981')); ?>"
                            class="h-12 w-16 border border-gray-200 dark:border-gray-600 rounded-xl cursor-pointer"
                        >
                        <input 
                            type="text" 
                            value="<?php echo e(old('settings.theme_color', $seoSettings['theme_color']->value ?? '#10b981')); ?>"
                            readonly
                            class="flex-1 px-3 md:px-4 py-2 md:py-3 border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50 text-gray-900 dark:text-white rounded-xl text-sm md:text-base font-mono"
                        >
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Warna toolbar browser di perangkat mobile</p>
                </div>

                <div>
                    <label for="og_image" class="block text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Open Graph Image (Gambar Preview Saat Share)
                    </label>
                    <div class="space-y-3">
                        <?php
                            $ogImageValue = old('settings.og_image', $seoSettings['og_image']->value ?? '');
                            $ogImageUrl = !empty($ogImageValue) ? asset($ogImageValue) : 'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke=%22%23999%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%222%22 d=%22M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z%22/%3E%3C/svg%3E';
                        ?>
                        <div class="flex items-start gap-4">
                            <div class="w-32 h-20 border-2 border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-700 flex items-center justify-center p-2">
                                <img id="og-image-preview" src="<?php echo e($ogImageUrl); ?>" alt="OG Image Preview" class="max-w-full max-h-full object-contain" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 fill=%22none%22 viewBox=%220 0 24 24%22 stroke=%22%23999%22%3E%3Cpath stroke-linecap=%22round%22 stroke-linejoin=%22round%22 stroke-width=%222%22 d=%22M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z%22/%3E%3C/svg%3E'">
                            </div>
                            <div class="flex-1">
                                <input 
                                    type="file" 
                                    name="og_image_upload" 
                                    id="og-image-upload"
                                    accept="image/jpeg,image/jpg,image/png,image/webp"
                                    onchange="previewImage(this, 'og-image-preview', 'og_image')"
                                    class="block w-full text-sm text-gray-500 dark:text-gray-400
                                        file:mr-4 file:py-2 file:px-4
                                        file:rounded-lg file:border-0
                                        file:text-sm file:font-semibold
                                        file:bg-emerald-50 file:text-emerald-700
                                        hover:file:bg-emerald-100
                                        dark:file:bg-emerald-900/30 dark:file:text-emerald-400
                                        cursor-pointer"
                                >
                                <input type="hidden" name="settings[og_image]" id="og_image" value="<?php echo e($ogImageValue); ?>">
                            </div>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Ukuran ideal: 1200x630 px untuk Facebook & WhatsApp</p>
                </div>
            </div>
        <?php else: ?>
            <div class="p-8 text-center">
                <p class="text-gray-500 dark:text-gray-400">Tidak ada pengaturan SEO. Klik tombol "Seed Default Settings" untuk membuat pengaturan default.</p>
            </div>
        <?php endif; ?>
        </div>

        
        <div id="tab-contact" class="settings-tab-content hidden bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg border border-blue-100 dark:border-gray-700 overflow-hidden">
        <?php if($settings->has('contact') && $settings->get('contact')->isNotEmpty()): ?>
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-700 dark:to-teal-700 px-4 md:px-6 py-3 md:py-4 flex items-center justify-between">
                <h2 class="text-lg md:text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Informasi Kontak
                </h2>
                <a href="<?php echo e(route('landing.contact')); ?>" target="_blank" class="inline-flex items-center gap-1 md:gap-2 px-3 py-1.5 md:px-4 md:py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all text-xs md:text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span class="hidden sm:inline">Lihat di Halaman Kontak</span>
                    <span class="sm:hidden">Preview</span>
                </a>
            </div>
            <div class="p-4 md:p-6 space-y-4 md:space-y-5">
                <?php $__currentLoopData = $settings['contact']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <label for="<?php echo e($setting->key); ?>" class="block text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <?php
                                $contactLabels = [
                                    'contact_address' => 'Alamat',
                                    'contact_phone' => 'Telepon',
                                    'contact_whatsapp' => 'WhatsApp',
                                    'contact_email' => 'Email',
                                    'contact_maps_embed' => 'Kode Embed Peta',
                                    'operating_hours_weekday' => 'Jam Operasional Senin-Jumat',
                                    'operating_hours_saturday' => 'Jam Operasional Sabtu',
                                    'operating_hours_sunday' => 'Jam Operasional Minggu',
                                ];
                                echo $contactLabels[$setting->key] ?? ucwords(str_replace('_', ' ', $setting->key));
                            ?>
                        </label>
                        <?php if($setting->type === 'textarea'): ?>
                            <textarea 
                                name="settings[<?php echo e($setting->key); ?>]" 
                                id="<?php echo e($setting->key); ?>"
                                rows="2"
                                class="w-full px-3 md:px-4 py-2 md:py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 transition-all text-sm md:text-base"
                            ><?php echo e(old('settings.'.$setting->key, $setting->value)); ?></textarea>
                        <?php else: ?>
                            <input 
                                type="<?php echo e($setting->type); ?>" 
                                name="settings[<?php echo e($setting->key); ?>]" 
                                id="<?php echo e($setting->key); ?>"
                                value="<?php echo e(old('settings.'.$setting->key, $setting->value)); ?>"
                                class="w-full px-3 md:px-4 py-2 md:py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 transition-all text-sm md:text-base"
                            >
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="p-8 text-center">
                <p class="text-gray-500 dark:text-gray-400">
                    Tidak ada pengaturan Contact. Klik tombol "Seed Default Settings" untuk membuat pengaturan default.
                </p>
            </div>
        <?php endif; ?>
        </div>

        
        <div id="tab-social" class="settings-tab-content hidden bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg border border-purple-100 dark:border-gray-700 overflow-hidden">
        <?php if($settings->has('social') && $settings->get('social')->isNotEmpty()): ?>
            <div class="bg-gradient-to-r from-emerald-600 to-teal-600 dark:from-emerald-700 dark:to-teal-700 px-4 md:px-6 py-3 md:py-4 flex items-center justify-between">
                <h2 class="text-lg md:text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Media Sosial
                </h2>
                <a href="<?php echo e(route('landing.index')); ?>#footer" target="_blank" class="inline-flex items-center gap-1 md:gap-2 px-3 py-1.5 md:px-4 md:py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all text-xs md:text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span class="hidden sm:inline">Lihat di Footer</span>
                    <span class="sm:hidden">Preview</span>
                </a>
            </div>
            <div class="p-4 md:p-6 space-y-4 md:space-y-5">
                <?php $__currentLoopData = $settings['social']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <label for="<?php echo e($setting->key); ?>" class="flex items-center gap-2 text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <?php
                                $platform = str_replace('social_', '', $setting->key);
                            ?>
                            <?php if($platform === 'facebook'): ?>
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            <?php elseif($platform === 'instagram'): ?>
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-pink-600 dark:text-pink-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                            <?php elseif($platform === 'whatsapp'): ?>
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                            <?php elseif($platform === 'twitter'): ?>
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            <?php endif; ?>
                            <?php echo e(ucwords($platform)); ?>

                        </label>
                        <input 
                            type="<?php echo e($setting->type); ?>" 
                            name="settings[<?php echo e($setting->key); ?>]" 
                            id="<?php echo e($setting->key); ?>"
                            value="<?php echo e(old('settings.'.$setting->key, $setting->value)); ?>"
                            placeholder="https://..."
                            class="w-full px-3 md:px-4 py-2 md:py-3 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-xl focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 transition-all text-sm md:text-base"
                        >
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="p-8 text-center">
                <p class="text-gray-500 dark:text-gray-400">
                    Tidak ada pengaturan Social Media. Klik tombol "Seed Default Settings" untuk membuat pengaturan default.
                </p>
            </div>
        <?php endif; ?>
        </div>

        
        <div id="tab-theme" class="settings-tab-content hidden bg-white dark:bg-gray-800 rounded-xl md:rounded-2xl shadow-lg border border-purple-100 dark:border-gray-700 overflow-hidden">
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 dark:from-purple-700 dark:to-pink-700 px-4 md:px-6 py-3 md:py-4 flex items-center justify-between">
                <h2 class="text-lg md:text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    Tema & Warna
                </h2>
                <a href="<?php echo e(route('landing.index')); ?>" target="_blank" class="inline-flex items-center gap-1 md:gap-2 px-3 py-1.5 md:px-4 md:py-2 bg-white/20 hover:bg-white/30 text-white rounded-lg transition-all text-xs md:text-sm font-semibold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    <span class="hidden sm:inline">Lihat Website</span>
                    <span class="sm:hidden">Preview</span>
                </a>
            </div>
            
            <div class="p-4 md:p-6 space-y-6">
                
                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6 border-2 border-dashed border-gray-300 dark:border-gray-600">
                    <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Live Preview
                    </h3>
                    <div id="theme-preview" class="space-y-3">
                        <div id="preview-primary" class="px-4 py-3 rounded-lg text-white font-semibold shadow-md" style="background-color: <?php echo e(old('settings.theme_primary_color', theme('primary'))); ?>">
                            Primary Color
                        </div>
                        <div id="preview-secondary" class="px-4 py-3 rounded-lg text-white font-semibold shadow-md" style="background-color: <?php echo e(old('settings.theme_secondary_color', theme('secondary'))); ?>">
                            Secondary Color
                        </div>
                        <div id="preview-accent" class="px-4 py-3 rounded-lg text-white font-semibold shadow-md" style="background-color: <?php echo e(old('settings.theme_accent_color', theme('accent'))); ?>">
                            Accent Color
                        </div>
                        <div class="flex gap-2">
                            <div id="preview-success" class="flex-1 px-3 py-2 rounded-lg text-white text-sm font-semibold" style="background-color: <?php echo e(old('settings.theme_success_color', theme('success'))); ?>">Success</div>
                            <div id="preview-warning" class="flex-1 px-3 py-2 rounded-lg text-white text-sm font-semibold" style="background-color: <?php echo e(old('settings.theme_warning_color', theme('warning'))); ?>">Warning</div>
                            <div id="preview-danger" class="flex-1 px-3 py-2 rounded-lg text-white text-sm font-semibold" style="background-color: <?php echo e(old('settings.theme_danger_color', theme('danger'))); ?>">Danger</div>
                        </div>
                    </div>
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div>
                        <label for="theme_primary_color" class="flex items-center justify-between text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full" style="background-color: <?php echo e(old('settings.theme_primary_color', $settings->get('theme')->firstWhere('key', 'theme_primary_color')->value ?? '#059669')); ?>"></div>
                                Primary Color
                            </span>
                            <button type="button" onclick="copyColor('theme_primary_color')" class="text-xs text-gray-500 hover:text-emerald-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </label>
                        <input type="color" name="settings[theme_primary_color]" id="theme_primary_color"
                            value="<?php echo e(old('settings.theme_primary_color', $settings->get('theme')->firstWhere('key', 'theme_primary_color')->value ?? '#059669')); ?>"
                            onchange="updateThemePreview('primary', this.value)"
                            class="w-full h-12 rounded-lg cursor-pointer border-2 border-gray-300 dark:border-gray-600">
                    </div>

                    
                    <div>
                        <label for="theme_secondary_color" class="flex items-center justify-between text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full" style="background-color: <?php echo e(old('settings.theme_secondary_color', $settings->get('theme')->firstWhere('key', 'theme_secondary_color')->value ?? '#0d9488')); ?>"></div>
                                Secondary Color
                            </span>
                            <button type="button" onclick="copyColor('theme_secondary_color')" class="text-xs text-gray-500 hover:text-emerald-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </label>
                        <input type="color" name="settings[theme_secondary_color]" id="theme_secondary_color"
                            value="<?php echo e(old('settings.theme_secondary_color', $settings->get('theme')->firstWhere('key', 'theme_secondary_color')->value ?? '#0d9488')); ?>"
                            onchange="updateThemePreview('secondary', this.value)"
                            class="w-full h-12 rounded-lg cursor-pointer border-2 border-gray-300 dark:border-gray-600">
                    </div>

                    
                    <div>
                        <label for="theme_accent_color" class="flex items-center justify-between text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full" style="background-color: <?php echo e(old('settings.theme_accent_color', $settings->get('theme')->firstWhere('key', 'theme_accent_color')->value ?? '#3b82f6')); ?>"></div>
                                Accent Color
                            </span>
                            <button type="button" onclick="copyColor('theme_accent_color')" class="text-xs text-gray-500 hover:text-emerald-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </label>
                        <input type="color" name="settings[theme_accent_color]" id="theme_accent_color"
                            value="<?php echo e(old('settings.theme_accent_color', $settings->get('theme')->firstWhere('key', 'theme_accent_color')->value ?? '#3b82f6')); ?>"
                            onchange="updateThemePreview('accent', this.value)"
                            class="w-full h-12 rounded-lg cursor-pointer border-2 border-gray-300 dark:border-gray-600">
                    </div>

                    
                    <div>
                        <label for="theme_success_color" class="flex items-center justify-between text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full" style="background-color: <?php echo e(old('settings.theme_success_color', $settings->get('theme')->firstWhere('key', 'theme_success_color')->value ?? '#10b981')); ?>"></div>
                                Success Color
                            </span>
                            <button type="button" onclick="copyColor('theme_success_color')" class="text-xs text-gray-500 hover:text-emerald-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </label>
                        <input type="color" name="settings[theme_success_color]" id="theme_success_color"
                            value="<?php echo e(old('settings.theme_success_color', $settings->get('theme')->firstWhere('key', 'theme_success_color')->value ?? '#10b981')); ?>"
                            onchange="updateThemePreview('success', this.value)"
                            class="w-full h-12 rounded-lg cursor-pointer border-2 border-gray-300 dark:border-gray-600">
                    </div>

                    
                    <div>
                        <label for="theme_warning_color" class="flex items-center justify-between text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full" style="background-color: <?php echo e(old('settings.theme_warning_color', $settings->get('theme')->firstWhere('key', 'theme_warning_color')->value ?? '#f59e0b')); ?>"></div>
                                Warning Color
                            </span>
                            <button type="button" onclick="copyColor('theme_warning_color')" class="text-xs text-gray-500 hover:text-emerald-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </label>
                        <input type="color" name="settings[theme_warning_color]" id="theme_warning_color"
                            value="<?php echo e(old('settings.theme_warning_color', $settings->get('theme')->firstWhere('key', 'theme_warning_color')->value ?? '#f59e0b')); ?>"
                            onchange="updateThemePreview('warning', this.value)"
                            class="w-full h-12 rounded-lg cursor-pointer border-2 border-gray-300 dark:border-gray-600">
                    </div>

                    
                    <div>
                        <label for="theme_danger_color" class="flex items-center justify-between text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full" style="background-color: <?php echo e(old('settings.theme_danger_color', $settings->get('theme')->firstWhere('key', 'theme_danger_color')->value ?? '#ef4444')); ?>"></div>
                                Danger Color
                            </span>
                            <button type="button" onclick="copyColor('theme_danger_color')" class="text-xs text-gray-500 hover:text-emerald-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </label>
                        <input type="color" name="settings[theme_danger_color]" id="theme_danger_color"
                            value="<?php echo e(old('settings.theme_danger_color', $settings->get('theme')->firstWhere('key', 'theme_danger_color')->value ?? '#ef4444')); ?>"
                            onchange="updateThemePreview('danger', this.value)"
                            class="w-full h-12 rounded-lg cursor-pointer border-2 border-gray-300 dark:border-gray-600">
                    </div>

                    
                    <div>
                        <label for="theme_text_color" class="flex items-center justify-between text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full border border-gray-300" style="background-color: <?php echo e(old('settings.theme_text_color', $settings->get('theme')->firstWhere('key', 'theme_text_color')->value ?? '#1f2937')); ?>"></div>
                                Text Color
                            </span>
                            <button type="button" onclick="copyColor('theme_text_color')" class="text-xs text-gray-500 hover:text-emerald-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </label>
                        <input type="color" name="settings[theme_text_color]" id="theme_text_color"
                            value="<?php echo e(old('settings.theme_text_color', $settings->get('theme')->firstWhere('key', 'theme_text_color')->value ?? '#1f2937')); ?>"
                            class="w-full h-12 rounded-lg cursor-pointer border-2 border-gray-300 dark:border-gray-600">
                    </div>

                    
                    <div>
                        <label for="theme_background_color" class="flex items-center justify-between text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            <span class="flex items-center gap-2">
                                <div class="w-4 h-4 rounded-full border border-gray-300" style="background-color: <?php echo e(old('settings.theme_background_color', $settings->get('theme')->firstWhere('key', 'theme_background_color')->value ?? '#ffffff')); ?>"></div>
                                Background Color
                            </span>
                            <button type="button" onclick="copyColor('theme_background_color')" class="text-xs text-gray-500 hover:text-emerald-600 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            </button>
                        </label>
                        <input type="color" name="settings[theme_background_color]" id="theme_background_color"
                            value="<?php echo e(old('settings.theme_background_color', $settings->get('theme')->firstWhere('key', 'theme_background_color')->value ?? '#ffffff')); ?>"
                            class="w-full h-12 rounded-lg cursor-pointer border-2 border-gray-300 dark:border-gray-600">
                    </div>
                </div>

                
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-4 border border-blue-200 dark:border-gray-600">
                    <label for="theme_border_radius" class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 block">
                        Border Radius: <span id="radius-value" class="text-blue-600 dark:text-blue-400 font-bold"><?php echo e(old('settings.theme_border_radius', $settings->get('theme')->firstWhere('key', 'theme_border_radius')->value ?? '16')); ?>px</span>
                    </label>
                    <input type="range" name="settings[theme_border_radius]" id="theme_border_radius"
                        min="0" max="32" step="2"
                        value="<?php echo e(old('settings.theme_border_radius', $settings->get('theme')->firstWhere('key', 'theme_border_radius')->value ?? '16')); ?>"
                        oninput="updateRadiusPreview(this.value)"
                        class="w-full h-2 bg-blue-200 rounded-lg appearance-none cursor-pointer accent-blue-600">
                    <div class="flex justify-between mt-4 gap-2">
                        <div id="radius-demo-1" class="flex-1 h-12 bg-gradient-to-r from-emerald-500 to-teal-500 shadow-md transition-all duration-300" style="border-radius: <?php echo e(old('settings.theme_border_radius', $settings->get('theme')->firstWhere('key', 'theme_border_radius')->value ?? '16')); ?>px"></div>
                        <div id="radius-demo-2" class="flex-1 h-12 bg-gradient-to-r from-blue-500 to-purple-500 shadow-md transition-all duration-300" style="border-radius: <?php echo e(old('settings.theme_border_radius', $settings->get('theme')->firstWhere('key', 'theme_border_radius')->value ?? '16')); ?>px"></div>
                        <div id="radius-demo-3" class="flex-1 h-12 bg-gradient-to-r from-pink-500 to-rose-500 shadow-md transition-all duration-300" style="border-radius: <?php echo e(old('settings.theme_border_radius', $settings->get('theme')->firstWhere('key', 'theme_border_radius')->value ?? '16')); ?>px"></div>
                    </div>
                </div>

                
                <div class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-800 dark:to-gray-700 rounded-xl p-4 border border-indigo-200 dark:border-gray-600">
                    <h3 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                        Preset Tema
                    </h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <button type="button" onclick="applyPreset('emerald')" class="p-3 rounded-lg border-2 border-emerald-300 dark:border-emerald-600 hover:border-emerald-500 transition-all hover:shadow-lg group">
                            <div class="flex gap-1 mb-2">
                                <div class="w-6 h-6 rounded-full bg-emerald-600"></div>
                                <div class="w-6 h-6 rounded-full bg-teal-600"></div>
                                <div class="w-6 h-6 rounded-full bg-blue-500"></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 group-hover:text-emerald-700 dark:group-hover:text-emerald-400">Emerald (Default)</span>
                        </button>
                        <button type="button" onclick="applyPreset('blue')" class="p-3 rounded-lg border-2 border-blue-300 dark:border-blue-600 hover:border-blue-500 transition-all hover:shadow-lg group">
                            <div class="flex gap-1 mb-2">
                                <div class="w-6 h-6 rounded-full bg-blue-600"></div>
                                <div class="w-6 h-6 rounded-full bg-sky-600"></div>
                                <div class="w-6 h-6 rounded-full bg-indigo-500"></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 group-hover:text-blue-700 dark:group-hover:text-blue-400">Blue Ocean</span>
                        </button>
                        <button type="button" onclick="applyPreset('purple')" class="p-3 rounded-lg border-2 border-purple-300 dark:border-purple-600 hover:border-purple-500 transition-all hover:shadow-lg group">
                            <div class="flex gap-1 mb-2">
                                <div class="w-6 h-6 rounded-full bg-purple-600"></div>
                                <div class="w-6 h-6 rounded-full bg-violet-600"></div>
                                <div class="w-6 h-6 rounded-full bg-fuchsia-500"></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 group-hover:text-purple-700 dark:group-hover:text-purple-400">Purple Majesty</span>
                        </button>
                        <button type="button" onclick="applyPreset('orange')" class="p-3 rounded-lg border-2 border-orange-300 dark:border-orange-600 hover:border-orange-500 transition-all hover:shadow-lg group">
                            <div class="flex gap-1 mb-2">
                                <div class="w-6 h-6 rounded-full bg-orange-600"></div>
                                <div class="w-6 h-6 rounded-full bg-amber-600"></div>
                                <div class="w-6 h-6 rounded-full bg-red-500"></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 group-hover:text-orange-700 dark:group-hover:text-orange-400">Orange Sunset</span>
                        </button>
                        <button type="button" onclick="applyPreset('calm')" class="p-3 rounded-lg border-2 border-cyan-300 dark:border-cyan-600 hover:border-cyan-500 transition-all hover:shadow-lg group">
                            <div class="flex gap-1 mb-2">
                                <div class="w-6 h-6 rounded-full bg-cyan-500"></div>
                                <div class="w-6 h-6 rounded-full bg-sky-400"></div>
                                <div class="w-6 h-6 rounded-full bg-teal-400"></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 group-hover:text-cyan-700 dark:group-hover:text-cyan-400">Calm Breeze</span>
                        </button>
                        <button type="button" onclick="applyPreset('elegant')" class="p-3 rounded-lg border-2 border-slate-400 dark:border-slate-600 hover:border-slate-600 transition-all hover:shadow-lg group">
                            <div class="flex gap-1 mb-2">
                                <div class="w-6 h-6 rounded-full bg-slate-700"></div>
                                <div class="w-6 h-6 rounded-full bg-slate-600"></div>
                                <div class="w-6 h-6 rounded-full bg-amber-600"></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 group-hover:text-slate-700 dark:group-hover:text-slate-400">Elegant Dark</span>
                        </button>
                        <button type="button" onclick="applyPreset('minimalist')" class="p-3 rounded-lg border-2 border-gray-400 dark:border-gray-600 hover:border-gray-600 transition-all hover:shadow-lg group">
                            <div class="flex gap-1 mb-2">
                                <div class="w-6 h-6 rounded-full bg-gray-800"></div>
                                <div class="w-6 h-6 rounded-full bg-gray-600"></div>
                                <div class="w-6 h-6 rounded-full bg-gray-900"></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 group-hover:text-gray-700 dark:group-hover:text-gray-400">Minimalist</span>
                        </button>
                        <button type="button" onclick="applyPreset('nature')" class="p-3 rounded-lg border-2 border-lime-300 dark:border-lime-600 hover:border-lime-500 transition-all hover:shadow-lg group">
                            <div class="flex gap-1 mb-2">
                                <div class="w-6 h-6 rounded-full bg-green-600"></div>
                                <div class="w-6 h-6 rounded-full bg-lime-500"></div>
                                <div class="w-6 h-6 rounded-full bg-emerald-500"></div>
                            </div>
                            <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 group-hover:text-lime-700 dark:group-hover:text-lime-400">Nature Green</span>
                        </button>
                    </div>
                </div>

                
                <div class="flex justify-end">
                    <button type="button" onclick="resetTheme()" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-lg font-semibold transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Reset ke Default
                    </button>
                </div>
            </div>
        </div>

        
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3 md:gap-4 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-100 dark:border-gray-700 p-4 md:p-6">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="px-4 md:px-6 py-2.5 md:py-3 text-center text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-xl font-semibold transition-all text-sm md:text-base">
                Batal
            </a>
            <button type="submit" id="submit-settings-btn" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 dark:hover:from-emerald-600 dark:hover:to-teal-600 text-white px-6 md:px-8 py-2.5 md:py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-0.5 text-sm md:text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span id="submit-btn-text">Simpan Pengaturan</span>
            </button>
        </div>
    </form>

<?php $__env->startPush('scripts'); ?>
<script>
// Tab switching functionality with localStorage persistence
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.settings-tab-btn');
    const tabContents = document.querySelectorAll('.settings-tab-content');
    
    // Form submit handling
    const settingsForm = document.getElementById('settings-form');
    const submitBtn = document.getElementById('submit-settings-btn');
    const submitBtnText = document.getElementById('submit-btn-text');
    
    if (settingsForm) {
        settingsForm.addEventListener('submit', function(e) {
            
            // Show loading state
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
            }
            if (submitBtnText) {
                submitBtnText.textContent = 'Menyimpan...';
            }
            
            // Form will submit normally
        });
    }
    
    // Load saved tab from localStorage
    const savedTab = localStorage.getItem('activeSettingsTab');
    if (savedTab && document.getElementById('tab-' + savedTab)) {
        switchTab(savedTab);
    }
    
    // Load saved sub-tab from localStorage
    const savedSubTab = localStorage.getItem('activeSettingsSubTab');
    if (savedSubTab && document.getElementById('subtab-' + savedSubTab)) {
        switchSubTab(savedSubTab);
    }
    
    // Function to switch main tabs
    function switchTab(tabName) {
        
        // Hide all tab contents
        tabContents.forEach(content => {
            content.classList.add('hidden');
        });
        
        // Reset all tab buttons
        tabButtons.forEach(btn => {
            btn.classList.remove('bg-gradient-to-r', 'from-emerald-600', 'to-teal-600', 'dark:from-emerald-500', 'dark:to-teal-500', 'text-white', 'border-emerald-600', 'dark:border-emerald-500');
            btn.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:text-emerald-600', 'dark:hover:text-emerald-400', 'border-transparent', 'hover:border-emerald-300', 'dark:hover:border-emerald-700');
        });
        
        // Show active tab content
        const activeContent = document.getElementById('tab-' + tabName);
        
        if (activeContent) {
            activeContent.classList.remove('hidden');
        }
        
        // Highlight active tab button
        const activeButton = document.querySelector(`[data-tab="${tabName}"]`);
        if (activeButton) {
            activeButton.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:text-emerald-600', 'dark:hover:text-emerald-400', 'border-transparent', 'hover:border-emerald-300', 'dark:hover:border-emerald-700');
            activeButton.classList.add('bg-gradient-to-r', 'from-emerald-600', 'to-teal-600', 'dark:from-emerald-500', 'dark:to-teal-500', 'text-white', 'border-emerald-600', 'dark:border-emerald-500');
        }
        
        // Save to localStorage
        localStorage.setItem('activeSettingsTab', tabName);
        
        // Update URL hash
        window.location.hash = tabName;
    }
    
    // Add click event to all tab buttons
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            switchTab(tabName);
        });
    });
    
    // Check for hash in URL on page load
    const hash = window.location.hash.substring(1);
    if (hash && document.getElementById('tab-' + hash)) {
        switchTab(hash);
    }
    
    // Sync theme color input with text display
    const themeColorInput = document.getElementById('theme_color');
    if (themeColorInput) {
        const themeColorText = themeColorInput.nextElementSibling;
        themeColorInput.addEventListener('input', function() {
            if (themeColorText) {
                themeColorText.value = this.value;
            }
        });
    }
});

function openImagesFolder() {
    window.location.href = '<?php echo e(route("admin.settings.openFolder", ["folder" => "images"])); ?>';
}

function togglePreview(id) {
    const preview = document.getElementById(id);
    if (preview) {
        preview.classList.toggle('hidden');
    }
}

function switchSubTab(tabIdOrEvent, eventParam = null) {
    // Handle both cases: switchSubTab('company') or switchSubTab('company', event)
    let tabId, clickedBtn;
    
    if (typeof tabIdOrEvent === 'string') {
        // Called from inline onclick: switchSubTab('company')
        tabId = tabIdOrEvent;
        // Find button by data-tab-id or data-subtab
        clickedBtn = document.querySelector(`[data-tab-id="${tabId}"]`) || document.querySelector(`[data-subtab="${tabId}"]`);
    } else {
        // Called with event object
        const event = tabIdOrEvent;
        clickedBtn = event.target.closest('.sub-tab-btn');
        tabId = clickedBtn ? (clickedBtn.getAttribute('data-tab-id') || clickedBtn.getAttribute('data-subtab')) : null;
    }
    
    if (!tabId) return;
    
    // Fade out current content
    document.querySelectorAll('.subtab-content').forEach(content => {
        if (!content.classList.contains('hidden')) {
            content.classList.add('opacity-0');
            setTimeout(() => {
                content.classList.add('hidden');
                content.classList.remove('opacity-0');
            }, 150);
        }
    });
    
    // Remove active state from all buttons
    document.querySelectorAll('.sub-tab-btn').forEach(btn => {
        const badge = btn.querySelector('span');
        btn.classList.remove('bg-emerald-100', 'dark:bg-emerald-900/30', 'text-emerald-700', 'dark:text-emerald-300',
                              'bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-700', 'dark:text-blue-300',
                              'bg-purple-100', 'dark:bg-purple-900/30', 'text-purple-700', 'dark:text-purple-300',
                              'bg-teal-100', 'dark:bg-teal-900/30', 'text-teal-700', 'dark:text-teal-300',
                              'bg-indigo-100', 'dark:bg-indigo-900/30', 'text-indigo-700', 'dark:text-indigo-300',
                              'bg-orange-100', 'dark:bg-orange-900/30', 'text-orange-700', 'dark:text-orange-300',
                              'bg-pink-100', 'dark:bg-pink-900/30', 'text-pink-700', 'dark:text-pink-300',
                              'bg-green-100', 'dark:bg-green-900/30', 'text-green-700', 'dark:text-green-300',
                              'bg-cyan-100', 'dark:bg-cyan-900/30', 'text-cyan-700', 'dark:text-cyan-300',
                              'bg-red-100', 'dark:bg-red-900/30', 'text-red-700', 'dark:text-red-300');
        btn.classList.add('text-gray-600', 'dark:text-gray-400');
        if (badge) {
            badge.classList.remove('bg-emerald-200', 'dark:bg-emerald-800', 'bg-blue-200', 'dark:bg-blue-800',
                                   'bg-purple-200', 'dark:bg-purple-800', 'bg-teal-200', 'dark:bg-teal-800',
                                   'bg-indigo-200', 'dark:bg-indigo-800', 'bg-orange-200', 'dark:bg-orange-800',
                                   'bg-pink-200', 'dark:bg-pink-800', 'bg-green-200', 'dark:bg-green-800',
                                   'bg-cyan-200', 'dark:bg-cyan-800', 'bg-red-200', 'dark:bg-red-800');
            badge.classList.add('bg-gray-200', 'dark:bg-gray-700');
        }
    });
    
    // Fade in selected content
    setTimeout(() => {
        const selectedContent = document.getElementById('subtab-' + tabId);
        if (selectedContent) {
            selectedContent.classList.remove('hidden');
            setTimeout(() => {
                selectedContent.classList.add('opacity-100');
            }, 10);
        }
    }, 150);
    
    // Add active state to clicked button
    if (clickedBtn) {
        const badge = clickedBtn.querySelector('span');
        clickedBtn.classList.remove('text-gray-600', 'dark:text-gray-400');
        
        // Map tab colors
        const colorMap = {
            'company': { btn: ['bg-emerald-100', 'dark:bg-emerald-900/30', 'text-emerald-700', 'dark:text-emerald-300'], badge: ['bg-emerald-200', 'dark:bg-emerald-800'] },
            'hero': { btn: ['bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-700', 'dark:text-blue-300'], badge: ['bg-blue-200', 'dark:bg-blue-800'] },
            'features': { btn: ['bg-purple-100', 'dark:bg-purple-900/30', 'text-purple-700', 'dark:text-purple-300'], badge: ['bg-purple-200', 'dark:bg-purple-800'] },
            'community': { btn: ['bg-teal-100', 'dark:bg-teal-900/30', 'text-teal-700', 'dark:text-teal-300'], badge: ['bg-teal-200', 'dark:bg-teal-800'] },
            'featured': { btn: ['bg-indigo-100', 'dark:bg-indigo-900/30', 'text-indigo-700', 'dark:text-indigo-300'], badge: ['bg-indigo-200', 'dark:bg-indigo-800'] },
            'units': { btn: ['bg-orange-100', 'dark:bg-orange-900/30', 'text-orange-700', 'dark:text-orange-300'], badge: ['bg-orange-200', 'dark:bg-orange-800'] },
            'gallery': { btn: ['bg-pink-100', 'dark:bg-pink-900/30', 'text-pink-700', 'dark:text-pink-300'], badge: ['bg-pink-200', 'dark:bg-pink-800'] },
            'facilities': { btn: ['bg-green-100', 'dark:bg-green-900/30', 'text-green-700', 'dark:text-green-300'], badge: ['bg-green-200', 'dark:bg-green-800'] },
            'about': { btn: ['bg-cyan-100', 'dark:bg-cyan-900/30', 'text-cyan-700', 'dark:text-cyan-300'], badge: ['bg-cyan-200', 'dark:bg-cyan-800'] },
            'cta': { btn: ['bg-red-100', 'dark:bg-red-900/30', 'text-red-700', 'dark:text-red-300'], badge: ['bg-red-200', 'dark:bg-red-800'] }
        };
        
        if (colorMap[tabId]) {
            clickedBtn.classList.add(...colorMap[tabId].btn);
            if (badge) {
                badge.classList.remove('bg-gray-200', 'dark:bg-gray-700');
                badge.classList.add(...colorMap[tabId].badge);
            }
        }
        
        // Auto-scroll to active tab button jika diperlukan (responsive)
        const container = document.getElementById('sub-tabs-container');
        if (container && clickedBtn) {
            // Scroll ke button yang aktif jika tidak terlihat
            clickedBtn.scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
        }
    }
    
    // Save to localStorage
    localStorage.setItem('activeSettingsSubTab', tabId);
}

// Filter settings function
let allSettings = [];
function filterSettings(query) {
    const searchInfo = document.getElementById('search-result-info');
    query = query.toLowerCase().trim();
    
    if (query === '') {
        // Show all, reset filters
        document.querySelectorAll('.subtab-content').forEach(content => {
            content.querySelectorAll('[data-setting-key]').forEach(field => {
                field.classList.remove('hidden');
            });
        });
        searchInfo.classList.add('hidden');
        return;
    }
    
    let matchCount = 0;
    let matchedTabs = new Set();
    
    // Search through all settings
    document.querySelectorAll('.subtab-content').forEach(content => {
        const fields = content.querySelectorAll('[data-setting-key], label, input, textarea');
        let tabHasMatch = false;
        
        fields.forEach(field => {
            const text = field.textContent || field.placeholder || field.value || '';
            const key = field.getAttribute('data-setting-key') || field.getAttribute('name') || '';
            
            if (text.toLowerCase().includes(query) || key.toLowerCase().includes(query)) {
                const settingWrapper = field.closest('.space-y-4 > div') || field.closest('[data-setting-key]');
                if (settingWrapper) {
                    settingWrapper.classList.remove('hidden');
                    tabHasMatch = true;
                    matchCount++;
                    matchedTabs.add(content.id.replace('subtab-', ''));
                }
            } else {
                const settingWrapper = field.closest('.space-y-4 > div') || field.closest('[data-setting-key]');
                if (settingWrapper && !settingWrapper.textContent.toLowerCase().includes(query)) {
                    settingWrapper.classList.add('hidden');
                }
            }
        });
    });
    
    // Show search results info
    if (matchCount > 0) {
        searchInfo.textContent = `✓ Ditemukan ${matchCount} pengaturan yang cocok`;
        searchInfo.classList.remove('hidden', 'text-red-500');
        searchInfo.classList.add('text-emerald-600', 'dark:text-emerald-400');
        
        // Auto switch to first matched tab
        if (matchedTabs.size > 0) {
            const firstMatch = Array.from(matchedTabs)[0];
            const firstBtn = document.querySelector(`[data-tab-id="${firstMatch}"]`);
            if (firstBtn) firstBtn.click();
        }
    } else {
        searchInfo.textContent = '✗ Tidak ada pengaturan yang cocok dengan pencarian';
        searchInfo.classList.remove('hidden', 'text-emerald-600', 'dark:text-emerald-400');
        searchInfo.classList.add('text-red-500', 'dark:text-red-400');
    }
}

// Upload image function
async function uploadImage(input, fieldId) {
    const file = input.files[0];
    if (!file) return;
    
    // Validate file type
    if (!file.type.startsWith('image/')) {
        showAlert('File harus berupa gambar (JPG, PNG, GIF, dll)', 'error');
        input.value = '';
        return;
    }
    
    // Validate file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
        showAlert('Ukuran file maksimal 5MB', 'error');
        input.value = '';
        return;
    }
    
    // Create form data
    const formData = new FormData();
    formData.append('image', file);
    formData.append('_token', '<?php echo e(csrf_token()); ?>');
    
    // Show loading state
    const inputField = document.getElementById(fieldId);
    const originalValue = inputField.value;
    inputField.value = 'Uploading...';
    inputField.disabled = true;
    
    try {
        const response = await fetch('<?php echo e(route("admin.settings.upload-image")); ?>', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            inputField.value = data.path;
            inputField.disabled = false;
            
            // Show success message
            const successMsg = document.createElement('div');
            successMsg.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
            successMsg.textContent = '✓ Gambar berhasil diupload!';
            document.body.appendChild(successMsg);
            setTimeout(() => successMsg.remove(), 3000);
        } else {
            throw new Error(data.message || 'Upload gagal');
        }
    } catch (error) {
        
        inputField.value = originalValue;
        inputField.disabled = false;
        
        // Show error message
        const errorMsg = document.createElement('div');
        errorMsg.className = 'fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
        errorMsg.textContent = '✗ ' + (error.message || 'Upload gagal');
        document.body.appendChild(errorMsg);
        setTimeout(() => errorMsg.remove(), 3000);
    }
    
    // Reset file input
    input.value = '';
}

// Preview image before upload
async function previewImage(input, previewId, fieldId) {
    const file = input.files[0];
    if (!file) return;
    
    // Validate file type
    const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/svg+xml', 'image/x-icon', 'image/webp'];
    if (!validTypes.includes(file.type)) {
        showAlert('Format file tidak valid. Gunakan JPG, PNG, SVG, ICO, atau WebP.', 'error');
        input.value = '';
        return;
    }
    
    // Validate file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
        showAlert('Ukuran file maksimal 5MB', 'error');
        input.value = '';
        return;
    }
    
    // Show preview immediately
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById(previewId).src = e.target.result;
    };
    reader.readAsDataURL(file);
    
    // Upload file
    const formData = new FormData();
    formData.append('image', file);
    formData.append('_token', '<?php echo e(csrf_token()); ?>');
    
    // Show loading notification
    const loadingMsg = document.createElement('div');
    loadingMsg.className = 'fixed top-4 right-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
    loadingMsg.textContent = '⏳ Mengupload gambar...';
    loadingMsg.id = 'upload-loading-msg';
    document.body.appendChild(loadingMsg);
    
    try {
        const response = await fetch('<?php echo e(route("admin.settings.upload-image")); ?>', {
            method: 'POST',
            body: formData
        });
        
        const data = await response.json();
        
        // Remove loading message
        document.getElementById('upload-loading-msg')?.remove();
        
        if (data.success) {
            // Update hidden field with new path
            document.getElementById(fieldId).value = data.path;
            
            // Update preview with uploaded image
            document.getElementById(previewId).src = '<?php echo e(asset("")); ?>' + data.path.replace(/^\//, '');
            
            // Show success message
            const successMsg = document.createElement('div');
            successMsg.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
            successMsg.textContent = '✓ Gambar berhasil diupload!';
            document.body.appendChild(successMsg);
            setTimeout(() => successMsg.remove(), 3000);
        } else {
            throw new Error(data.message || 'Upload gagal');
        }
    } catch (error) {
        
        
        // Remove loading message
        document.getElementById('upload-loading-msg')?.remove();
        
        // Restore original preview
        const originalValue = document.getElementById(fieldId).value;
        if (originalValue) {
            document.getElementById(previewId).src = '<?php echo e(asset("")); ?>' + originalValue.replace(/^\//, '');
        }
        
        // Show error message
        const errorMsg = document.createElement('div');
        errorMsg.className = 'fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
        errorMsg.textContent = '✗ ' + (error.message || 'Upload gagal');
        document.body.appendChild(errorMsg);
        setTimeout(() => errorMsg.remove(), 3000);
    }
    
    // Reset file input
    input.value = '';
}

// Theme customization functions
function updateThemePreview(type, color) {
    const preview = document.getElementById('preview-' + type);
    if (preview) {
        preview.style.backgroundColor = color;
    }
}

function updateRadiusPreview(value) {
    document.getElementById('radius-value').textContent = value + 'px';
    document.getElementById('radius-demo-1').style.borderRadius = value + 'px';
    document.getElementById('radius-demo-2').style.borderRadius = value + 'px';
    document.getElementById('radius-demo-3').style.borderRadius = value + 'px';
}

function copyColor(inputId) {
    const input = document.getElementById(inputId);
    const color = input.value;
    
    navigator.clipboard.writeText(color).then(() => {
        // Show success notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-emerald-500 text-white px-4 py-2 rounded-lg shadow-lg z-50 flex items-center gap-2';
        notification.innerHTML = `
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>Warna ${color} disalin!</span>
        `;
        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 2000);
    });
}

function applyPreset(preset) {
    const presets = {
        emerald: {
            primary: '#059669',
            secondary: '#0d9488',
            accent: '#3b82f6',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            text: '#1f2937',
            background: '#ffffff'
        },
        blue: {
            primary: '#2563eb',
            secondary: '#0284c7',
            accent: '#6366f1',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            text: '#1e3a8a',
            background: '#f0f9ff'
        },
        purple: {
            primary: '#9333ea',
            secondary: '#7c3aed',
            accent: '#ec4899',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            text: '#581c87',
            background: '#faf5ff'
        },
        orange: {
            primary: '#ea580c',
            secondary: '#f59e0b',
            accent: '#dc2626',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            text: '#7c2d12',
            background: '#fff7ed'
        },
        calm: {
            primary: '#06b6d4',
            secondary: '#0ea5e9',
            accent: '#14b8a6',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            text: '#155e75',
            background: '#ecfeff'
        },
        elegant: {
            primary: '#475569',
            secondary: '#64748b',
            accent: '#f59e0b',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            text: '#1e293b',
            background: '#f8fafc'
        },
        minimalist: {
            primary: '#1f2937',
            secondary: '#4b5563',
            accent: '#111827',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            text: '#111827',
            background: '#ffffff'
        },
        nature: {
            primary: '#16a34a',
            secondary: '#84cc16',
            accent: '#059669',
            success: '#10b981',
            warning: '#f59e0b',
            danger: '#ef4444',
            text: '#14532d',
            background: '#f7fee7'
        }
    };
    
    const colors = presets[preset];
    if (!colors) return;
    
    // Apply colors to inputs
    document.getElementById('theme_primary_color').value = colors.primary;
    document.getElementById('theme_secondary_color').value = colors.secondary;
    document.getElementById('theme_accent_color').value = colors.accent;
    document.getElementById('theme_success_color').value = colors.success;
    document.getElementById('theme_warning_color').value = colors.warning;
    document.getElementById('theme_danger_color').value = colors.danger;
    document.getElementById('theme_text_color').value = colors.text;
    document.getElementById('theme_background_color').value = colors.background;
    
    // Update previews
    updateThemePreview('primary', colors.primary);
    updateThemePreview('secondary', colors.secondary);
    updateThemePreview('accent', colors.accent);
    updateThemePreview('success', colors.success);
    updateThemePreview('warning', colors.warning);
    updateThemePreview('danger', colors.danger);
    
    // Show success notification
    const notification = document.createElement('div');
    notification.className = 'fixed top-4 right-4 bg-purple-500 text-white px-4 py-3 rounded-lg shadow-lg z-50 flex items-center gap-2';
    notification.innerHTML = `
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
        <span>Preset ${preset.charAt(0).toUpperCase() + preset.slice(1)} diterapkan!</span>
    `;
    document.body.appendChild(notification);
    setTimeout(() => notification.remove(), 2000);
}

async function resetTheme() {
    const confirmed = await showConfirm('Reset semua warna ke tema default Emerald?');
    if (!confirmed) return;
    
    applyPreset('emerald');
    
    // Reset border radius
    document.getElementById('theme_border_radius').value = 16;
    updateRadiusPreview(16);
}
</script>
<?php $__env->stopPush(); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Project\BumiAsriParahyangan\resources\views/admin/settings.blade.php ENDPATH**/ ?>