<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Helpers\ThemeHelper;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => 'required|array',
        ]);

        foreach ($request->input('settings', []) as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                $setting->update(['value' => $value]);
            }
        }

        // Clear theme cache if theme settings were updated
        ThemeHelper::clearCache();
        
        // Clear view cache to force reload settings
        \Artisan::call('view:clear');
        \Artisan::call('cache:clear');

        return redirect()->route('admin.settings.index')->with('status', 'Pengaturan berhasil diperbarui!');
    }

    public function seed()
    {
        // Seed default settings if they don't exist
        $defaults = [
            // ===== COMPANY INFO =====
            ['key' => 'company_name', 'value' => 'Bumi Asri Parahyangan', 'type' => 'text', 'group' => 'general'],
            ['key' => 'company_tagline', 'value' => 'Hunian Nyaman & Asri untuk Keluarga', 'type' => 'text', 'group' => 'general'],
            ['key' => 'company_description', 'value' => 'Bumi Asri Parahyangan menghadirkan hunian dengan lingkungan hijau, fasilitas modern, dan suasana komunitas yang ramah untuk keluarga Indonesia.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'company_logo', 'value' => '/images/logo.png', 'type' => 'text', 'group' => 'general'],
            
            // ===== HERO SECTION (Homepage) =====
            ['key' => 'hero_title', 'value' => 'Temukan Hunian Impian Anda', 'type' => 'text', 'group' => 'general'],
            ['key' => 'hero_subtitle', 'value' => 'Perumahan modern dengan lingkungan asri dan fasilitas lengkap', 'type' => 'text', 'group' => 'general'],
            ['key' => 'hero_image', 'value' => '/images/hero-bg.jpg', 'type' => 'text', 'group' => 'general'],
            
            // ===== FEATURE PILLS (Homepage) =====
            ['key' => 'feature1_title', 'value' => 'Lokasi Strategis', 'type' => 'text', 'group' => 'general'],
            ['key' => 'feature1_subtitle', 'value' => 'Akses mudah ke fasilitas publik', 'type' => 'text', 'group' => 'general'],
            ['key' => 'feature2_title', 'value' => 'Keamanan 24/7', 'type' => 'text', 'group' => 'general'],
            ['key' => 'feature2_subtitle', 'value' => 'Area aman & terpantau', 'type' => 'text', 'group' => 'general'],
            ['key' => 'feature3_title', 'value' => 'Ruang Hijau', 'type' => 'text', 'group' => 'general'],
            ['key' => 'feature3_subtitle', 'value' => 'Taman & jalur pejalan kaki', 'type' => 'text', 'group' => 'general'],
            
            // ===== COMMUNITY CARD (Homepage) =====
            ['key' => 'community_card_title', 'value' => 'Komunitas yang Asri', 'type' => 'text', 'group' => 'general'],
            ['key' => 'community_card_description', 'value' => 'Lingkungan dirancang untuk kehidupan keluarga — nyaman, aman, dan terhubung dengan alam.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'community_card_stat', 'value' => '100+ keluarga bahagia', 'type' => 'text', 'group' => 'general'],
            
            // ===== FEATURED UNITS (Homepage) =====
            ['key' => 'featured_title', 'value' => 'Unit Unggulan', 'type' => 'text', 'group' => 'general'],
            ['key' => 'featured_subtitle', 'value' => 'Pilihan unit terbaik kami — dipilih berdasarkan lokasi dan desain.', 'type' => 'text', 'group' => 'general'],
            
            // ===== UNITS PAGE =====
            ['key' => 'units_title', 'value' => 'Temukan Hunian Impian Anda', 'type' => 'text', 'group' => 'general'],
            ['key' => 'units_subtitle', 'value' => 'Berbagai pilihan unit dengan desain modern, lokasi strategis, dan harga kompetitif untuk keluarga Indonesia.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'units_stat1', 'value' => '100+|Keluarga Bahagia', 'type' => 'text', 'group' => 'general'],
            ['key' => 'units_stat2', 'value' => '24/7|Keamanan', 'type' => 'text', 'group' => 'general'],
            ['key' => 'units_stat3', 'value' => '10+|Fasilitas Lengkap', 'type' => 'text', 'group' => 'general'],
            
            // ===== GALLERY PAGE =====
            ['key' => 'gallery_title', 'value' => 'Lihat Keindahan Lingkungan Kami', 'type' => 'text', 'group' => 'general'],
            ['key' => 'gallery_subtitle', 'value' => 'Jelajahi foto-foto lingkungan, fasilitas, dan suasana komunitas di Bumi Asri Parahyangan.', 'type' => 'text', 'group' => 'general'],
            
            // ===== FACILITIES PAGE =====
            ['key' => 'facilities_title', 'value' => 'Nikmati Fasilitas Premium', 'type' => 'text', 'group' => 'general'],
            ['key' => 'facilities_subtitle', 'value' => 'Berbagai fasilitas modern dan lengkap untuk mendukung gaya hidup aktif dan sehat bagi seluruh keluarga.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'facilities_cta_title', 'value' => 'Ingin Tahu Lebih Banyak?', 'type' => 'text', 'group' => 'general'],
            ['key' => 'facilities_cta_subtitle', 'value' => 'Kunjungi lokasi kami dan rasakan langsung kenyamanan fasilitas yang tersedia.', 'type' => 'text', 'group' => 'general'],
            
            // ===== ABOUT PAGE =====
            ['key' => 'about_title', 'value' => 'Tentang Kami', 'type' => 'text', 'group' => 'general'],
            ['key' => 'about_content', 'value' => 'Bumi Asri Parahyangan adalah pengembang properti terpercaya yang fokus menghadirkan hunian berkualitas dengan konsep modern dan lingkungan yang asri.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'about_image', 'value' => '/images/about.jpg', 'type' => 'text', 'group' => 'general'],
            ['key' => 'about_stat1', 'value' => '100+|Unit Terjual', 'type' => 'text', 'group' => 'general'],
            ['key' => 'about_stat2', 'value' => '5+|Tahun Pengalaman', 'type' => 'text', 'group' => 'general'],
            ['key' => 'about_stat3', 'value' => '98%|Kepuasan Klien', 'type' => 'text', 'group' => 'general'],
            
            // ===== CTA SECTION (Homepage & Other Pages) =====
            ['key' => 'cta_title', 'value' => 'Siap Memiliki Hunian Impian?', 'type' => 'text', 'group' => 'general'],
            ['key' => 'cta_subtitle', 'value' => 'Hubungi kami sekarang untuk informasi lebih lanjut dan penawaran menarik', 'type' => 'text', 'group' => 'general'],
            ['key' => 'cta_button', 'value' => 'Hubungi Kami', 'type' => 'text', 'group' => 'general'],
            
            // ===== CONTACT PAGE =====
            ['key' => 'contact_badge', 'value' => 'HUBUNGI KAMI', 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_title', 'value' => 'Mari Berbincang', 'type' => 'text', 'group' => 'general'],
            ['key' => 'contact_subtitle', 'value' => 'Kami siap membantu Anda menemukan hunian impian. Kirimkan pesan atau hubungi kami langsung.', 'type' => 'text', 'group' => 'general'],
            
            // ===== BUTTON TEXTS (Global) =====
            ['key' => 'btn_view_units', 'value' => 'Lihat Unit', 'type' => 'text', 'group' => 'general'],
            ['key' => 'btn_contact_us', 'value' => 'Hubungi Kami', 'type' => 'text', 'group' => 'general'],
            ['key' => 'btn_view_other_units', 'value' => 'Lihat Unit Lainnya', 'type' => 'text', 'group' => 'general'],
            ['key' => 'btn_whatsapp', 'value' => 'WhatsApp', 'type' => 'text', 'group' => 'general'],
            ['key' => 'btn_schedule_visit', 'value' => 'Jadwalkan Kunjungan', 'type' => 'text', 'group' => 'general'],
            
            // ===== BADGE TEXTS (Page Headers) =====
            ['key' => 'badge_facilities', 'value' => 'FASILITAS LENGKAP', 'type' => 'text', 'group' => 'general'],
            ['key' => 'badge_gallery', 'value' => 'GALERI KAMI', 'type' => 'text', 'group' => 'general'],
            
            // ===== UNITS PAGE CTA =====
            ['key' => 'units_cta_title', 'value' => 'Butuh Bantuan Memilih Unit?', 'type' => 'text', 'group' => 'general'],
            ['key' => 'units_cta_subtitle', 'value' => 'Tim kami siap membantu Anda menemukan hunian yang sempurna sesuai kebutuhan dan budget.', 'type' => 'text', 'group' => 'general'],
            
            // ===== EMPTY STATE MESSAGES =====
            ['key' => 'empty_units', 'value' => 'Belum Ada Unit', 'type' => 'text', 'group' => 'general'],
            ['key' => 'empty_units_desc', 'value' => 'Belum ada unit yang tersedia saat ini. Silakan cek kembali nanti.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'empty_facilities', 'value' => 'Belum ada fasilitas terdaftar.', 'type' => 'text', 'group' => 'general'],
            
            // ===== UNIT DETAIL PAGE =====
            ['key' => 'unit_detail_default_description', 'value' => 'Unit properti berkualitas dengan lokasi strategis di kawasan Bumi Asri Parahyangan. Lingkungan asri, aman, dan nyaman untuk keluarga.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'unit_detail_feature_1', 'value' => 'Lokasi Strategis', 'type' => 'text', 'group' => 'general'],
            ['key' => 'unit_detail_feature_2', 'value' => 'Keamanan 24 Jam', 'type' => 'text', 'group' => 'general'],
            ['key' => 'unit_detail_feature_3', 'value' => 'Lingkungan Asri', 'type' => 'text', 'group' => 'general'],
            ['key' => 'unit_detail_feature_4', 'value' => 'Akses Mudah', 'type' => 'text', 'group' => 'general'],
            ['key' => 'unit_detail_feature_5', 'value' => 'Fasilitas Lengkap', 'type' => 'text', 'group' => 'general'],
            ['key' => 'unit_detail_feature_6', 'value' => 'SHM & IMB Lengkap', 'type' => 'text', 'group' => 'general'],
            
            // Contact
            ['key' => 'contact_address', 'value' => 'Jl. Parahyangan No. 123, Bandung, Jawa Barat 40164', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '+62 22 1234 5678', 'type' => 'tel', 'group' => 'contact'],
            ['key' => 'contact_whatsapp', 'value' => '+62 812 3456 7890', 'type' => 'tel', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'info@bumiasriparahyangan.com', 'type' => 'email', 'group' => 'contact'],
            ['key' => 'contact_maps_embed', 'value' => '', 'type' => 'textarea', 'group' => 'contact'],
            
            // Operating Hours
            ['key' => 'operating_hours_weekday', 'value' => '08:00 - 17:00', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'operating_hours_saturday', 'value' => '08:00 - 14:00', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'operating_hours_sunday', 'value' => 'Tutup', 'type' => 'text', 'group' => 'contact'],
            
            // Social Media
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/bumiasriparahyangan', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/bumiasriparahyangan', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_whatsapp', 'value' => 'https://wa.me/6281234567890', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/bumiasri', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => '', 'type' => 'url', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => '', 'type' => 'url', 'group' => 'social'],
            
            // SEO & Analytics
            ['key' => 'meta_title', 'value' => 'Bumi Asri Parahyangan - Hunian Impian untuk Keluarga', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'meta_description', 'value' => 'Temukan hunian impian di Bumi Asri Parahyangan. Perumahan modern dengan lingkungan asri, fasilitas lengkap, dan lokasi strategis di Bandung.', 'type' => 'textarea', 'group' => 'seo'],
            ['key' => 'meta_keywords', 'value' => 'properti bandung, rumah bandung, perumahan bandung, hunian keluarga, property murah bandung', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'favicon', 'value' => '/images/favicon.ico', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'theme_color', 'value' => '#10b981', 'type' => 'color', 'group' => 'seo'],
            ['key' => 'og_image', 'value' => '/images/og-image.jpg', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'google_analytics_id', 'value' => '', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'google_maps_api_key', 'value' => '', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'facebook_pixel_id', 'value' => '', 'type' => 'text', 'group' => 'seo'],
        ];

        foreach ($defaults as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }

        return redirect()->route('admin.settings.index')->with('status', 'Pengaturan default berhasil dibuat!');
    }

    /**
     * Open folder in Windows Explorer
     */
    public function openFolder($folder)
    {
        $allowedFolders = [
            'images' => public_path('images'),
            'storage' => storage_path('app/public'),
        ];

        if (!isset($allowedFolders[$folder])) {
            return back()->with('error', 'Folder tidak valid.');
        }

        $path = $allowedFolders[$folder];

        // Buat folder jika belum ada
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        // Buka folder di Windows Explorer
        $command = 'explorer "' . str_replace('/', '\\', $path) . '"';
        
        // Jalankan command di background (Windows)
        pclose(popen("start /B " . $command, "r"));

        return back()->with('status', 'Folder berhasil dibuka di Windows Explorer!');
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // max 5MB
        ]);

        try {
            $image = $request->file('image');
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Move to public/images directory
            $image->move(public_path('images'), $filename);
            
            // Return path relative to public
            $path = '/images/' . $filename;
            
            return response()->json([
                'success' => true,
                'path' => $path,
                'message' => 'Gambar berhasil diupload'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload gagal: ' . $e->getMessage()
            ], 500);
        }
    }
}
