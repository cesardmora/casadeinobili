<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

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
                'image_url'        => 'images/ca-serenissima-1.jpg',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1200&q=80',
                ],
                'amenities'        => [
                    'Private courtyard',
                    'High-speed Wi-Fi',
                    'Fully equipped kitchen',
                    'Cathedral views',
                    'Air conditioning',
                    'Fireplace',
                ],
                'location'         => 'Historic center, Korčula',
                'is_published'     => true,
                'is_coming_soon'   => false,
                'sort_order'       => 1,
                'airbnb_url'       => 'https://www.airbnb.de/calendar/ical/1138104029716036612.ics?t=d5d7372044c14c9cacf28cbc7f791d9f',
            ],
            [
                'name'             => 'Palazzo Veneto',
                'slug'             => 'palazzo-veneto',
                'century'          => 'Gothic Heritage Residence',
                'tagline'          => 'Baroque grandeur on the edge of the Adriatic',
                'description'      => '"Live inside history – discover the rare elegance of a Gothic palace in Korčula\'s Old Town."',
                'long_description' => 'In the heart of Korčula\'s medieval Old Town, hidden among cobblestone alleys and Renaissance palaces, stands a rare gem of Dalmatian heritage: a 16th-century Gothic residence, lovingly restored as part of the Case dei Nobili Collection. Once home to noble families of the Adriatic, the house now offers discerning travelers a private stay in one of the most exclusive historic settings of the island.' . "\r\n" .
                    'Every stone of this house tells a story – centuries of seafarers, merchants, and Venetian rule – while today\'s guests enjoy a seamless blend of authenticity and modern comfort.' . "\r\n" .
                    'Accommodation & Layout' . "\r\n" .
                    'Four floors with a total of 135 m² of living space, carefully restored to preserve original Gothic character while offering modern comfort.' . "\r\n" .
                    '- Master bedroom (top floor): With partial sea view and abundant natural light, this suite offers an elegant retreat in the heart of the Old Town.' . "\r\n" .
                    '- Two elegant bedrooms en-suite (second floor): Each with walk-in showers, premium fittings, and refined antique furnishings (*an interesting curiosity is a preserved medieval latrine – a rare historical detail for guests to see*).' . "\r\n" .
                    '- Living area with restored wooden beams, tastefully furnished with selected antiques to reflect both heritage and comfort, and offering unusually generous space for an Old Town residence.' . "\r\n" .
                    '- Fully equipped kitchen, ideal for private dining or in-house chef experiences (*unique historical feature: a preserved original millstone on the ground floor – a silent witness to centuries of life within the house*).' . "\r\n" .
                    'Highlights & Amenities' . "\r\n" .
                    '- Location: Steps from the Cathedral of St. Marko, surrounded by galleries, wine bars, and some of the finest restaurants in Korčula, as well as charming piazzas.' . "\r\n" .
                    '- Views: Rooftop windows open to sweeping views of terracotta rooftops and the Adriatic Sea.' . "\r\n" .
                    '- Comfort: Air conditioning, underfloor heating, Starlink Wi-Fi, 65" The Frame TV & Dolby Surround, high-quality linens, and discreetly integrated modern appliances.' . "\r\n" .
                    '- Atmosphere: Original Gothic arches and windows, stone walls, and historic timber, creating a timeless blend of medieval character and contemporary elegance.' . "\r\n" .
                    '- Extras: Concierge services upon request, private transfers, curated local experiences (wine tours, sailing excursions, private guides). Guests also have the exclusive possibility to charter the hosts\' private motor yacht with captain for unforgettable Adriatic excursions.' . "\r\n" .
                    'Guest Profile' . "\r\n" .
                    'This property is perfect for families seeking cultural immersion in a safe, intimate setting, couples looking for romance in a uniquely historic home; luxury travelers who value exclusivity and authenticity over conventional hotels or small groups of friends wanting to share a private residence with character.',
                'guests'           => 6,
                'bedrooms'         => 3,
                'bathrooms'        => 2,
                'image_url'        => 'images/palazzoVeneto_01.jpg',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=1200&q=80',
                ],
                'amenities'        => [
                    'Adriatic-front terrace',
                    'Event hall',
                    'Original frescoes',
                    'Wi-Fi',
                    'Chef\'s kitchen',
                    'Concierge service',
                ],
                'location'         => 'Old Town Korčula',
                'is_published'     => true,
                'is_coming_soon'   => false,
                'sort_order'       => 2,
                'airbnb_url'       => 'https://www.airbnb.de/calendar/ical/1436220790335004173.ics?t=4acebd0126ba43be8c01408d5ed2001c',
            ],
            [
                'name'             => 'Palazzino Nobile',
                'slug'             => 'palazzino-nobile',
                'century'          => 'Siglo XVI',
                'tagline'          => 'Noble Renaissance House',
                'description'      => '"Light, heritage & luxury – a noble residence in Korčula\'s Old Town."',
                'long_description' => 'This 15th C. renaissance residence has been recently renewed, preserving its historic soul while offering tasteful antique furnishings and modern comfort. Built contemporaneously with the Cathedral next door, the house shares its origins with Korčula\'s most important landmark.' . "\r\n\r\n" .
                    'After lying in disuse for centuries following the plague that struck Korčula in the 16th century, the property has now been brought back to life as one of the most distinctive private residences in the Old Town a part of the curated Case dei Nobili Collection.' . "\r\n" .
                    'Accommodation & Layout' . "\r\n" .
                    '- Four floors with a total of 125 m² of living space.' . "\r\n" .
                    '- Ground floor: Fully equipped kitchen with generous storage and workspace, enhanced by exposed antiques and tasteful décor.' . "\r\n" .
                    '- First floor: Elegant salon – a wonderfully cozy retreat to rest after days of exploring Korčula\'s medieval alleys.' . "\r\n" .
                    '- Second floor: Entirely dedicated to a spacious en-suite bedroom, with west-facing windows designed to be calm, airy, and elegant.' . "\r\n" .
                    '- Fourth floor: Another full-floor en-suite bedroom, equally luminous, with refined furnishings and premium fittings.' . "\r\n" .
                    'Highlights & Amenities' . "\r\n" .
                    '- Location: Steps from the Cathedral of St. Mark, galleries, markets, and some of the finest restaurants in Korčula.' . "\r\n" .
                    '- Historic features: Rare wine cellar on the ground level, once an early cistern, now preserved as a characterful heritage detail.' . "\r\n" .
                    '- Design: Refined Renaissance character, antique pieces, and tasteful interiors across four levels.' . "\r\n" .
                    '- Comfort: Air conditioning, underfloor heating, Starlink Wi-Fi, premium linens, and plush towels.' . "\r\n" .
                    '- Lifestyle & Services: Concierge services including wine tours, sailing excursions, restaurant bookings, and fine dining coordination. Guests may also charter the owner\'s motor yacht with captain for unforgettable Adriatic adventures.' . "\r\n" .
                    '- Culture: Korčula hosts the internationally renowned Korkyra Baroque Festival, held during the first two weeks of September. Guests staying in the Case dei Nobili Collection can enjoy world-class concerts and performances in historic venues just steps from their residence.' . "\r\n" .
                    'Guest Profile' . "\r\n" .
                    'Perfect for travelers who appreciate history and authenticity, yet expect comfort, space, and full services – from couples seeking romance to families or small groups looking for a distinguished Old Town stay.' . "\r\n" .
                    'Why Choose This House?' . "\r\n" .
                    'The Noble Renaissance House is among the very few historic residences in Korčula\'s Old Town offering both scale and comfort: four levels of living space, two full-floor bedrooms with beautiful west-facing light, a cozy salon, and a wine cellar rooted in the building\'s Renaissance origins. Recently renewed and tastefully appointed with antiques, it combines heritage, atmosphere, and modern amenities at the highest level.',
                'guests'           => 4,
                'bedrooms'         => 2,
                'bathrooms'        => 2,
                'image_url'        => 'images/palazzino_01.jpg',
                'gallery_images'   => [
                    'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?w=1200&q=80',
                    'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1200&q=80',
                ],
                'amenities'        => [
                    'Jardín privado',
                    'Vistas al canal',
                    'Wi-Fi',
                    'Cocina equipada',
                    'Aire acondicionado',
                    'Parking privado',
                ],
                'location'         => 'Old Town Korčula',
                'is_published'     => true,
                'is_coming_soon'   => false,
                'sort_order'       => 3,
                'airbnb_url'       => 'https://www.airbnb.de/calendar/ical/1525832143678447874.ics?t=46a2d4b6ffb5419c80c465751e4311e9',
            ],
            [
                'name'             => 'Dimora Marina',
                'slug'             => 'dimora-marina',
                'century'          => 'Siglo XVIII',
                'tagline'          => 'Seaside Residences',
                'description'      => '"Life on the Adriatic".',
                'long_description' => 'Located just behind the traditional Korčulanski Plivački (waterpolo) Klub and only a stone\'s throw from the beach, Dimora Marina introduces three elegant seaside apartments overlooking the Adriatic Sea.' . "\r\n" .
                    'Currently undergoing a complete renovation and scheduled for completion in October 2027, the residence will offer three spacious apartments of approximately 70 to 95 m², each with two bedrooms en-suite, thoughtfully designed in the spirit of the Case dei Nobili Collection.' . "\r\n\r\n" .
                    'Blending authentic Mediterranean architecture with refined interiors and modern comfort, Dimora Marina offers a relaxed coastal lifestyle just minutes from the historic Old Town of Korčula.' . "\r\n\r\n" .
                    'With the sea only steps away and open views across the Adriatic, the residence provides a rare opportunity to experience the island\'s waterfront life in an elegant yet understated setting.',
                'guests'           => 0,
                'bedrooms'         => 0,
                'bathrooms'        => 0,
                'image_url'        => 'images/ca-serenissima-1.jpg',
                'gallery_images'   => [],
                'amenities'        => [],
                'location'         => 'Seaside Residences in Korčula (coming soon)',
                'is_published'     => true,
                'is_coming_soon'   => false,
                'sort_order'       => 4,
                'airbnb_url'       => '0',
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
