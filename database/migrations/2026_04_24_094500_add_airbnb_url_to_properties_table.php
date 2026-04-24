<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('properties', 'airbnb_url')) {
            return;
        }

        Schema::table('properties', function (Blueprint $table) {
            $table->text('airbnb_url')->nullable()->after('image_url');
        });

        DB::table('properties')
            ->whereNull('airbnb_url')
            ->update(['airbnb_url' => '']);
    }

    public function down(): void
    {
        if (! Schema::hasColumn('properties', 'airbnb_url')) {
            return;
        }

        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('airbnb_url');
        });
    }
};
