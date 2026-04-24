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
                'name' => 'Ca Serenissima',
                'slug' => 'ca-serenissima',
                'century' => '15th Century',
                'tagline' => 'Historic Apartment in Old Town Korčula',
                'description' => '“Stone, style, and comfort – a unique apartment in the heart of Korčula’s Old Town.”',
                'long_description' => "Recently refurbished, this apartment preserves its original stone walls while introducing a refined interior design: A tasteful combination of stunning antiques and modern amenities creates a sense of timeless elegance, a rare opportunity to enjoy both authenticity and comfort in equal measure as part of the curated Case dei Nobili Collection.\n- Ideal for couples or families looking for an authentic Old Town stay with refined interiors, as well as luxury travelers seeking to enrich their experience with private yacht charters and curated services.",
                'guests' => 6,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'image_url' => 'images/ca-serenissima-1.webp',
                'airbnb_url' => 'https://www.airbnb.de/calendar/ical/1525832143678447874.ics?t=46a2d4b6ffb5419c80c465751e4311e9',
                'gallery_images' => [
                    'images/ca-serenissima-2.webp',
                    'images/ca-serenissima-3.webp',
                    'images/ca-serenissima-4.webp',
                    'images/ca-serenissima-5.webp',
                ],
                'amenities' => [
                    '90 m² on two floors',
                    '2 bedrooms en-suites',
                    'Spacious dining & fully equipped kitchen for six',
                    'Antique details & premium linens',
                    'Fireplace & air conditioning',
                    'Concierge & tailored experiences',
                    'High speed WiFi & Smart TV',
                ],
                'location' => 'Historic center, Korčula',
                'is_published' => true,
                'is_coming_soon' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Palazzo Veneto',
                'slug' => 'palazzo-veneto',
                'century' => 'Gothic Heritage',
                'tagline' => 'Gothic Heritage Residence, Old Town Korčula',
                'description' => '“Live inside history – discover the rare elegance of a Gothic palace in Korčula’s Old Town.”',
                'long_description' => "In the heart of Korčula’s medieval Old Town, hidden among cobblestone alleys and Renaissance palaces, stands a rare gem of Dalmatian heritage: a 16th-century Gothic residence, lovingly restored as part of the Case dei Nobili Collection.\n\n- Ideal for families or private groups seeking cultural immersion in a safe, intimate setting, luxury travelers who value exclusivity and authenticity over conventional hotels or small groups of friends wanting to share a private residence with character.",
                'guests' => 6,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'image_url' => 'images/palazzoVeneto_01.webp',
                'airbnb_url' => 'https://www.airbnb.de/calendar/ical/1436220790335004173.ics?t=4acebd0126ba43be8c01408d5ed2001c',
                'gallery_images' => [
                    'images/palazzoVeneto_02.webp',
                    'images/palazzoVeneto_03.webp',
                    'images/palazzoVeneto_04.webp',
                    'images/palazzoVeneto_05.webp',
                ],
                'amenities' => [
                    '135 m² across four floors',
                    '3 bedrooms / 3 ½ bathrooms',
                    ' Historic stone features',
                    'Sea glimpses from upper level',
                    'Steps from Cathedral & waterfront',
                    'Underfloor heating & air conditioning',
                    'Fine antiques & premium linens',
                    'High speed WiFi & Smart TV',
                ],
                'location' => 'Old Town Korčula',
                'is_published' => true,
                'is_coming_soon' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'Palazzino Nobile',
                'slug' => 'palazzino-nobile',
                'century' => 'Siglo XVI',
                'tagline' => 'Noble Renaissance House in Old Town Korčula',
                'description' => '“Light, heritage & luxury – a noble residence in Korčula’s Old Town.”',
                'long_description' => "This 15th C. renaissance residence has been recently renewed - after lying in disuse for centuries following the plague that struck Korčula in the 16th century - preserving its historic soul while offering tasteful antique furnishings and modern comfort. Built contemporaneously with the Cathedral next door, the house shares its origins with Korčula’s most important landmark.\n\n- The Noble Renaissance House is among the very few historic residences in Korčula’s Old Town offering both scale and comfort, perfect for couples or families. ",
                'guests' => 4,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'image_url' => 'images/palazzino_01.webp',
                'airbnb_url' => 'https://www.airbnb.de/calendar/ical/1138104029716036612.ics?t=d5d7372044c14c9cacf28cbc7f791d9f',
                'gallery_images' => [
                    'images/ca-serenissima-1.webp',
                    'images/ca-serenissima-1.webp',
                ],
                'amenities' => [
                    '125 m² across four floors',
                    '2 full-floor bedroom suites',
                    ' Cozy private salon',
                    'Historic wine cellar in fully equipped kitchen',
                    'Fine antiques & premium linens',
                    'Quiet and refined atmosphere',
                    'Underfloor heating & air conditioning',
                    'High speed WiFi & Smart TV',
                ],
                'location' => 'Old Town Korčula',
                'is_published' => true,
                'is_coming_soon' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'Dimora Marina',
                'slug' => 'dimora-marina',
                'century' => 'Siglo XVIII',
                'tagline' => 'Seaside Residences in Korčula (coming soon)',
                'description' => '“Life on the Adriatic”.',
                'long_description' => "Located just behind the traditional Korčulanski Plivački (waterpolo) Klub and only a stone’s throw from the beach, Dimora Marina introduces three elegant seaside apartments overlooking the Adriatic Sea.\n\nCurrently undergoing a complete renovation and scheduled for completion in October 2027, the residence will offer three spacious apartments of approximately 70 to 95 m², each with two bedrooms en-suite, thoughtfully designed in the spirit of the Case dei Nobili Collection.\n\nBlending authentic Mediterranean architecture with refined interiors and modern comfort, Dimora Marina offers a relaxed coastal lifestyle just minutes from the historic Old Town of Korčula. With the sea only steps away and open views across the Adriatic, the residence provides a rare opportunity to experience the island’s waterfront life in an elegant yet understated setting. ",
                'guests' => 0,
                'bedrooms' => 0,
                'bathrooms' => 0,
                'image_url' => 'images/ca-serenissima-1.webp',
                'airbnb_url' => 'https://www.airbnb.de/calendar/ical/1525832143678447874.ics?t=46a2d4b6ffb5419c80c465751e4311e9',
                'gallery_images' => [
                    'images/ca-serenissima-1.webp',
                    'images/ca-serenissima-1.webp',
                ],
                'amenities' => [
                    '3 spacious apartments of approximately 70 to 95 m²',
                    '2 bedrooms en-suite',
                ],
                'location' => 'Seaside Residences in Korčula (coming soon)',
                'is_published' => true,
                'is_coming_soon' => false,
                'sort_order' => 4,
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
