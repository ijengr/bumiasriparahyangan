<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Setting;

class SeedSettings extends Command
{
    protected $signature = 'settings:seed';
    protected $description = 'Seed all default settings';

    public function handle()
    {
        $defaults = [
            // General
            ['key' => 'company_name', 'value' => 'Bumi Asri Parahyangan', 'type' => 'text', 'group' => 'general'],
            ['key' => 'company_tagline', 'value' => 'Hunian Nyaman & Asri untuk Keluarga', 'type' => 'text', 'group' => 'general'],
            ['key' => 'company_description', 'value' => 'Bumi Asri Parahyangan menghadirkan hunian dengan lingkungan hijau, fasilitas modern, dan suasana komunitas yang ramah untuk keluarga Indonesia.', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'company_logo', 'value' => '/images/logo.png', 'type' => 'text', 'group' => 'general'],
            ['key' => 'meta_keywords', 'value' => 'properti, rumah, perumahan, bandung, hunian', 'type' => 'textarea', 'group' => 'general'],
            ['key' => 'meta_description', 'value' => 'Temukan hunian impian di Bumi Asri Parahyangan. Perumahan modern dengan fasilitas lengkap di Bandung.', 'type' => 'textarea', 'group' => 'general'],
            
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
            
            // Homepage Settings
            ['key' => 'hero_title', 'value' => 'Temukan Hunian Impian Anda', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'hero_subtitle', 'value' => 'Perumahan modern dengan lingkungan asri dan fasilitas lengkap', 'type' => 'textarea', 'group' => 'homepage'],
            ['key' => 'hero_image', 'value' => '/images/hero-bg.jpg', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'featured_units_title', 'value' => 'Unit Unggulan', 'type' => 'text', 'group' => 'homepage'],
            ['key' => 'featured_units_subtitle', 'value' => 'Pilihan unit terbaik dengan berbagai tipe dan ukuran', 'type' => 'text', 'group' => 'homepage'],
            
            // Features/Facilities
            ['key' => 'facilities_title', 'value' => 'Fasilitas Lengkap', 'type' => 'text', 'group' => 'features'],
            ['key' => 'facilities_subtitle', 'value' => 'Nikmati berbagai fasilitas modern untuk kenyamanan keluarga', 'type' => 'text', 'group' => 'features'],
            
            // About Section
            ['key' => 'about_title', 'value' => 'Tentang Kami', 'type' => 'text', 'group' => 'about'],
            ['key' => 'about_content', 'value' => 'Bumi Asri Parahyangan adalah pengembang properti terpercaya yang fokus menghadirkan hunian berkualitas dengan konsep modern dan lingkungan yang asri.', 'type' => 'textarea', 'group' => 'about'],
            ['key' => 'about_image', 'value' => '/images/about.jpg', 'type' => 'text', 'group' => 'about'],
            
            // Call to Action
            ['key' => 'cta_title', 'value' => 'Siap Memiliki Hunian Impian?', 'type' => 'text', 'group' => 'cta'],
            ['key' => 'cta_subtitle', 'value' => 'Hubungi kami sekarang untuk informasi lebih lanjut dan penawaran menarik', 'type' => 'text', 'group' => 'cta'],
            ['key' => 'cta_button_text', 'value' => 'Hubungi Kami', 'type' => 'text', 'group' => 'cta'],
            
            // SEO & Analytics
            ['key' => 'google_analytics_id', 'value' => '', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'google_maps_api_key', 'value' => '', 'type' => 'text', 'group' => 'seo'],
            ['key' => 'facebook_pixel_id', 'value' => '', 'type' => 'text', 'group' => 'seo'],
        ];

        $created = 0;
        $existing = 0;

        foreach ($defaults as $setting) {
            $result = Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );

            if ($result->wasRecentlyCreated) {
                $created++;
            } else {
                $existing++;
            }
        }

        $this->info("Settings seeded successfully!");
        $this->info("Created: $created new settings");
        $this->info("Existing: $existing settings");

        return 0;
    }
}
