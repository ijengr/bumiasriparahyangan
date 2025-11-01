<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add indexes to units table for better query performance
        if (Schema::hasTable('units')) {
            Schema::table('units', function (Blueprint $table) {
                $table->index('type', 'idx_units_type');
                $table->index('price', 'idx_units_price');
                $table->index('created_at', 'idx_units_created_at');
            });
        }

        // Add indexes to gallery_images table
        if (Schema::hasTable('gallery_images')) {
            Schema::table('gallery_images', function (Blueprint $table) {
                $table->index('created_at', 'idx_gallery_created_at');
            });
        }

        // Add indexes to facilities table
        if (Schema::hasTable('facilities')) {
            Schema::table('facilities', function (Blueprint $table) {
                $table->index('created_at', 'idx_facilities_created_at');
            });
        }

        // Add indexes to messages table
        if (Schema::hasTable('messages')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->index('is_read', 'idx_messages_is_read');
                $table->index('created_at', 'idx_messages_created_at');
                $table->index(['is_read', 'created_at'], 'idx_messages_read_created');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop indexes from units table
        if (Schema::hasTable('units')) {
            Schema::table('units', function (Blueprint $table) {
                $table->dropIndex('idx_units_type');
                $table->dropIndex('idx_units_price');
                $table->dropIndex('idx_units_created_at');
            });
        }

        // Drop indexes from gallery_images table
        if (Schema::hasTable('gallery_images')) {
            Schema::table('gallery_images', function (Blueprint $table) {
                $table->dropIndex('idx_gallery_created_at');
            });
        }

        // Drop indexes from facilities table
        if (Schema::hasTable('facilities')) {
            Schema::table('facilities', function (Blueprint $table) {
                $table->dropIndex('idx_facilities_created_at');
            });
        }

        // Drop indexes from messages table
        if (Schema::hasTable('messages')) {
            Schema::table('messages', function (Blueprint $table) {
                $table->dropIndex('idx_messages_is_read');
                $table->dropIndex('idx_messages_created_at');
                $table->dropIndex('idx_messages_read_created');
            });
        }
    }
};
