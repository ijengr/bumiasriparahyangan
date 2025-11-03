<div>
    <label for="<?php echo e($setting->key); ?>" class="block text-xs md:text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
        <?php
            $labels = [
                'company_name' => 'Nama Perusahaan',
                'company_tagline' => 'Tagline Perusahaan',
                'company_description' => 'Deskripsi Perusahaan',
                'company_logo' => 'Logo Perusahaan (URL)',
                'hero_title' => 'Judul Hero',
                'hero_subtitle' => 'Subjudul Hero',
                'hero_image' => 'Background Image Hero (URL)',
                'feature1_title' => 'Judul',
                'feature1_subtitle' => 'Subjudul',
                'feature2_title' => 'Judul',
                'feature2_subtitle' => 'Subjudul',
                'feature3_title' => 'Judul',
                'feature3_subtitle' => 'Subjudul',
                'community_card_title' => 'Judul Card',
                'community_card_description' => 'Deskripsi Card',
                'community_card_stat' => 'Statistik (contoh: 100+ keluarga bahagia)',
                'featured_title' => 'Judul Featured Units',
                'featured_subtitle' => 'Subjudul Featured Units',
                'units_title' => 'Judul Halaman Units',
                'units_subtitle' => 'Subjudul Halaman Units',
                'units_stat1' => 'Statistik 1 (format: angka|label, contoh: 100+|Unit Tersedia)',
                'units_stat2' => 'Statistik 2 (format: angka|label)',
                'units_stat3' => 'Statistik 3 (format: angka|label)',
                'gallery_title' => 'Judul Halaman Gallery',
                'gallery_subtitle' => 'Subjudul Halaman Gallery',
                'facilities_title' => 'Judul Halaman Fasilitas',
                'facilities_subtitle' => 'Subjudul Halaman Fasilitas',
                'facilities_cta_title' => 'Judul CTA',
                'facilities_cta_subtitle' => 'Subjudul CTA',
                'about_title' => 'Judul Halaman About',
                'about_content' => 'Konten About',
                'about_image' => 'Gambar About (URL)',
                'about_stat1' => 'Statistik 1 (format: angka|label, contoh: 500+|Keluarga Bahagia)',
                'about_stat2' => 'Statistik 2 (format: angka|label)',
                'about_stat3' => 'Statistik 3 (format: angka|label)',
                'cta_title' => 'Judul CTA',
                'cta_subtitle' => 'Subjudul CTA',
                'cta_button' => 'Text Button CTA',
                'contact_badge' => 'Badge Header (contoh: HUBUNGI KAMI)',
                'contact_title' => 'Judul Halaman Contact',
                'contact_subtitle' => 'Subjudul/Deskripsi Contact',
                'btn_view_units' => 'Button: Lihat Unit',
                'btn_contact_us' => 'Button: Hubungi Kami',
                'btn_view_other_units' => 'Button: Lihat Unit Lainnya',
                'btn_whatsapp' => 'Button: WhatsApp',
                'btn_schedule_visit' => 'Button: Jadwalkan Kunjungan',
                'badge_facilities' => 'Badge Halaman Facilities',
                'badge_gallery' => 'Badge Halaman Gallery',
                'units_cta_title' => 'Judul CTA Section (Units Page)',
                'units_cta_subtitle' => 'Subjudul CTA (Units Page)',
                'empty_units' => 'Pesan: Tidak Ada Unit',
                'empty_units_desc' => 'Deskripsi: Tidak Ada Unit',
                'empty_facilities' => 'Pesan: Tidak Ada Fasilitas',
            ];
            $label = $labels[$setting->key] ?? ucwords(str_replace(['_', 'company'], [' ', 'Perusahaan'], $setting->key));
        ?>
        <?php echo e($label); ?>

    </label>
    <?php if($setting->type === 'textarea'): ?>
        <textarea 
            name="settings[<?php echo e($setting->key); ?>]" 
            id="<?php echo e($setting->key); ?>"
            rows="<?php echo e(in_array($setting->key, ['company_description', 'about_content']) ? '4' : '2'); ?>"
            class="w-full px-3 md:px-4 py-2 md:py-2.5 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 transition-all text-sm"
        ><?php echo e(old('settings.'.$setting->key, $setting->value)); ?></textarea>
    <?php else: ?>
        <div class="flex gap-2">
            <?php
                // Change 'url' type to 'text' to avoid HTML5 validation issues
                // Use placeholder and helper text to guide users instead
                $inputType = $setting->type === 'url' ? 'text' : $setting->type;
                $isUrlField = $setting->type === 'url';
            ?>
            <input 
                type="<?php echo e($inputType); ?>" 
                name="settings[<?php echo e($setting->key); ?>]" 
                id="<?php echo e($setting->key); ?>"
                value="<?php echo e(old('settings.'.$setting->key, $setting->value)); ?>"
                placeholder="<?php echo e($isUrlField ? 'https://...' : ''); ?>"
                class="flex-1 px-3 md:px-4 py-2 md:py-2.5 border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg focus:border-emerald-500 dark:focus:border-emerald-400 focus:ring-2 focus:ring-emerald-100 dark:focus:ring-emerald-900/50 transition-all text-sm"
            >
            <?php if(in_array($setting->key, ['company_logo', 'hero_image', 'about_image'])): ?>
            <input type="file" id="file_<?php echo e($setting->key); ?>" accept="image/*" class="hidden" onchange="uploadImage(this, '<?php echo e($setting->key); ?>')">
            <button type="button" onclick="document.getElementById('file_<?php echo e($setting->key); ?>').click()" class="px-3 py-2 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 dark:from-emerald-500 dark:to-teal-500 text-white rounded-lg transition-all flex items-center gap-1.5 text-sm" title="Upload gambar">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span class="hidden sm:inline">Upload</span>
            </button>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH D:\Project\BumiAsriParahyangan\resources\views/admin/settings/_field.blade.php ENDPATH**/ ?>