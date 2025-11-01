<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->integer('bedrooms')->nullable()->after('description');
            $table->integer('bathrooms')->nullable()->after('bedrooms');
            $table->integer('floor_area')->nullable()->after('bathrooms');
            $table->integer('parking')->nullable()->after('floor_area');
            $table->integer('built_year')->nullable()->after('parking');
        });
    }

    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn(['bedrooms','bathrooms','floor_area','parking','built_year']);
        });
    }
};
