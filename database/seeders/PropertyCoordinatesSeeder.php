<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PropertyCoordinatesSeeder extends Seeder
{
    public function run(): void
    {
        if (
            ! Schema::hasColumn('properties', 'latitude')
            || ! Schema::hasColumn('properties', 'longitude')
        ) {
            return;
        }

        $coordinates = [
            'ca-serenissima' => [
                'latitude' => 42.9618500,
                'longitude' => 17.1350500,
            ],
            'palazzo-veneto' => [
                'latitude' => 42.9619800,
                'longitude' => 17.1353400,
            ],
            'palazzino-nobile' => [
                'latitude' => 42.9617300,
                'longitude' => 17.1356200,
            ],
            'dimora-marina' => [
                'latitude' => 42.9599000,
                'longitude' => 17.1402000,
            ],
        ];

        foreach ($coordinates as $slug => $coordinate) {
            DB::table('properties')
                ->where('slug', $slug)
                ->update($coordinate);
        }
    }
}
