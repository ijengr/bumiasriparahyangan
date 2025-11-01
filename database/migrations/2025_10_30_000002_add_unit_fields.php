<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Add columns only if they do not already exist (safe migration for existing environments)
        if (!Schema::hasColumn('units', 'floor_area') || !Schema::hasColumn('units', 'bedrooms') || !Schema::hasColumn('units', 'bathrooms') || !Schema::hasColumn('units', 'parking') || !Schema::hasColumn('units', 'built_year')) {
            Schema::table('units', function (Blueprint $table) {
                if (!Schema::hasColumn('units', 'floor_area')) {
                    $table->integer('floor_area')->nullable()->after('land_area');
                }
                if (!Schema::hasColumn('units', 'bedrooms')) {
                    $table->integer('bedrooms')->nullable()->after('floor_area');
                }
                if (!Schema::hasColumn('units', 'bathrooms')) {
                    $table->integer('bathrooms')->nullable()->after('bedrooms');
                }
                if (!Schema::hasColumn('units', 'parking')) {
                    $table->integer('parking')->nullable()->after('bathrooms');
                }
                if (!Schema::hasColumn('units', 'built_year')) {
                    $table->integer('built_year')->nullable()->after('parking');
                }
            });
        }
    }

    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn(['floor_area','bedrooms','bathrooms','parking','built_year']);
        });
    }
};
