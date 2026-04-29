<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            if (! Schema::hasColumn('properties', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('location');
            }

            if (! Schema::hasColumn('properties', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }
        });
    }

    public function down(): void
    {
        $columns = array_values(array_filter(
            ['latitude', 'longitude'],
            fn (string $column): bool => Schema::hasColumn('properties', $column)
        ));

        if ($columns === []) {
            return;
        }

        Schema::table('properties', function (Blueprint $table) use ($columns) {
            $table->dropColumn($columns);
        });
    }
};
