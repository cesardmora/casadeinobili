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
                'name'             => 'Ca Serenissima',
                'slug'             => 'ca-serenissima',
                'century'          => '15th Century',
                'tagline'          => 'The origin of the collection',
                'description'      => 'The crown jewel of medieval Korčula. Original Gothic arches, limestone courtyards, and views of the cathedral bell tower.',
                'long_description' => 'Ca Serenissima represents the very heart of the collection. Built in the 15th century, its pointed arches and bifora windows have witnessed five centuries of Dalmatian history. Every stone has been restored with reverence, preserving authenticity while subtly incorporating contemporary comfort. The inner courtyard, shaded by a century-old fig tree, is the soul of the house.',
                'guests'           => 6,
                'bedrooms'         => 3,
                'bathrooms'        => 2,
                'image_url'        => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1200&q=80',
                ],
                'amenities'        => ['Private courtyard', 'High-speed Wi-Fi', 'Fully equipped kitchen', 'Cathedral views', 'Air conditioning', 'Fireplace'],
                'location'         => 'Historic center, Korčula',
                'is_published'     => true,
                'is_coming_soon'   => false,
                'sort_order'       => 1,
            ],
            [
                'name'             => 'Arneri Palace',
                'slug'             => 'palacio-arneri',
                'century'          => '17th Century',
                'tagline'          => 'Baroque grandeur on the edge of the Adriatic',
                'description'      => 'A testament to Venetian opulence in Dalmatia. Double-height ceilings, original frescoes, and a terrace overlooking the Adriatic.',
                'long_description' => 'Arneri Palace embodies the 17th-century splendor when the great noble families of Korčula competed in architectural magnificence. Its double-height halls preserve original fresco fragments, and the main terrace offers one of the most stunning views of the Korčula channel. This space has hosted dignitaries, artists, and illustrious travelers throughout the centuries.',
                'guests'           => 10,
                'bedrooms'         => 5,
                'bathrooms'        => 4,
                'image_url'        => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=800&q=80',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&q=80',
                ],
                'amenities'        => ['Adriatic-front terrace', 'Event hall', 'Original frescoes', 'Wi-Fi', "Chef's kitchen", 'Concierge service'],
                'location'         => 'Seafront, Korčula',
                'is_published'     => true,
                'is_coming_soon'   => false,
                'sort_order'       => 2,
            ],
            [
                'name'             => 'Renaissance House',
                'slug'             => 'casa-renacentista',
                'century'          => '16th Century',
                'tagline'          => 'Renaissance elegance with channel views',
                'description'      => 'Renaissance elegance overlooking the Korčula channel. Perfect proportions, a private garden, and the unique light of the Adriatic.',
                'long_description' => 'Renaissance House is an exercise in proportion and measured beauty. Built during the cultural flourish of the 16th century, it reflects the Italian Renaissance influence that reached Dalmatia through Venetian trade routes. Its semi-circular arch windows frame views of the Korčula channel, and the private garden is a stone and lavender retreat that invites contemplation.',
                'guests'           => 8,
                'bedrooms'         => 4,
                'bathrooms'        => 3,
                'image_url'        => 'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=800&q=80',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1200&q=80',
                ],
                'amenities'        => ['Private garden', 'Channel views', 'Wi-Fi', 'Fully equipped kitchen', 'Air conditioning', 'Private parking'],
                'location'         => 'Old Town, Korčula',
                'is_published'     => true,
                'is_coming_soon'   => false,
                'sort_order'       => 3,
            ],
            [
                'name'             => 'KPK House',
                'slug'             => 'kpk-house',
                'century'          => '18th Century',
                'tagline'          => 'A new jewel joins the collection',
                'description'      => 'The latest addition to the collection. A new jewel is being added. Reveal in 2025.',
                'long_description' => 'KPK House is being restored with the same rigor and respect that characterizes the entire collection. A new jewel that will soon open its doors to reveal five centuries of history in every corner.',
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