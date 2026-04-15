<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $properties = [
            [
                'name'             => 'Casa Gótica',
                'slug'             => 'casa-gotica',
                'century'          => 'Siglo XV',
                'tagline'          => 'El origen de la colección',
                'description'      => 'La joya de la corona medieval de Korčula. Arcos góticos originales, patios de piedra caliza y vistas al campanario de la catedral.',
                'long_description' => 'Casa Gótica representa el corazón mismo de la colección. Construida en el siglo XV, sus arcos apuntados y ventanas bíforas han contemplado el devenir de cinco siglos de historia dálmata. Cada piedra ha sido restaurada con reverencia, preservando la autenticidad mientras se incorpora el confort contemporáneo con sutileza. El patio interior, sombreado por una higuera centenaria, es el alma de la casa.',
                'guests'           => 6,
                'bedrooms'         => 3,
                'bathrooms'        => 2,
                'image_url'        => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1200&q=80',
                ],
                'amenities'        => ['Patio privado', 'Wi-Fi alta velocidad', 'Cocina equipada', 'Vistas a la catedral', 'Aire acondicionado', 'Chimenea'],
                'location'         => 'Casco histórico, Korčula',
                'is_published'     => true,
                'is_coming_soon'   => false,
                'sort_order'       => 1,
            ],
            [
                'name'             => 'Palacio Arneri',
                'slug'             => 'palacio-arneri',
                'century'          => 'Siglo XVII',
                'tagline'          => 'Grandeza barroca al borde del Adriático',
                'description'      => 'Un testimonio de la opulencia veneciana en Dalmacia. Salones de doble altura, frescos originales y una terraza sobre el Adriático.',
                'long_description' => 'El Palacio Arneri encarna el esplendor del siglo XVII cuando las grandes familias nobles de Korčula competían en magnificencia arquitectónica. Sus salones de doble altura conservan fragmentos de frescos originales, y la terraza principal ofrece una de las vistas más impresionantes del canal de Korčula. Este espacio ha albergado a dignatarios, artistas y viajeros ilustres a lo largo de los siglos.',
                'guests'           => 10,
                'bedrooms'         => 5,
                'bathrooms'        => 4,
                'image_url'        => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=800&q=80',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&q=80',
                ],
                'amenities'        => ['Terraza sobre el Adriático', 'Salón de eventos', 'Frescos originales', 'Wi-Fi', 'Cocina de chef', 'Servicio de conserjería'],
                'location'         => 'Frente marítimo, Korčula',
                'is_published'     => true,
                'is_coming_soon'   => false,
                'sort_order'       => 2,
            ],
            [
                'name'             => 'Casa Renacentista',
                'slug'             => 'casa-renacentista',
                'century'          => 'Siglo XVI',
                'tagline'          => 'Elegancia renacentista con vistas al canal',
                'description'      => 'Elegancia renacentista con vistas al canal de Korčula. Proporciones perfectas, jardín privado y la luz única del Adriático.',
                'long_description' => 'Casa Renacentista es un ejercicio en proporción y belleza medida. Construida durante el florecimiento cultural del siglo XVI, refleja la influencia del Renacimiento italiano que llegó a Dalmacia a través de las rutas comerciales venecianas. Sus ventanas de arco de medio punto enmarcan vistas al canal de Korčula, y el jardín privado es un retiro de piedra y lavanda que invita a la contemplación.',
                'guests'           => 8,
                'bedrooms'         => 4,
                'bathrooms'        => 3,
                'image_url'        => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800&q=80',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1200&q=80',
                ],
                'amenities'        => ['Jardín privado', 'Vistas al canal', 'Wi-Fi', 'Cocina equipada', 'Aire acondicionado', 'Parking privado'],
                'location'         => 'Ciudad vieja, Korčula',
                'is_published'     => true,
                'is_coming_soon'   => false,
                'sort_order'       => 3,
            ],
            [
                'name'             => 'KPK House',
                'slug'             => 'kpk-house',
                'century'          => 'Siglo XVIII',
                'tagline'          => 'Una nueva joya se suma a la colección',
                'description'      => 'La más reciente incorporación a la colección. Una nueva joya se suma. Revelación en 2025.',
                'long_description' => 'KPK House está siendo restaurada con el mismo rigor y respeto que caracteriza toda la colección. Una nueva joya que pronto abrirá sus puertas para revelar cinco siglos de historia en cada rincón.',
                'guests'           => 0,
                'bedrooms'         => 0,
                'bathrooms'        => 0,
                'image_url'        => null,
                'gallery_images'   => [],
                'amenities'        => [],
                'location'         => 'Korčula',
                'is_published'     => true,
                'is_coming_soon'   => true,
                'sort_order'       => 4,
            ],
        ];

        foreach ($properties as $data) {
            Property::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
