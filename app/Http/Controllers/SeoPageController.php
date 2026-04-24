<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SeoPageController extends Controller
{
    public function show(Request $request, string $slug): View
    {
        $pages = $this->pages();

        abort_unless(isset($pages[$slug]), 404);

        $page = $pages[$slug];
        $properties = cache()->remember('properties_seo_landing_collection', 3600, function () {
            return Property::available()->orderBy('sort_order')->get();
        });

        return view('pages.seo-landing', [
            'page' => $page,
            'properties' => $properties,
        ]);
    }

    public function sitemap(): Response
    {
        $properties = Property::published()->orderBy('sort_order')->get();
        $pages = $this->pages();

        $urls = [
            [
                'loc' => url('/'),
                'lastmod' => optional($properties->max('updated_at'))->toDateString() ?? now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '1.0',
            ],
            [
                'loc' => route('about'),
                'lastmod' => $this->viewLastModified('about'),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ],
            [
                'loc' => route('properties.index'),
                'lastmod' => optional($properties->max('updated_at'))->toDateString() ?? now()->toDateString(),
                'changefreq' => 'weekly',
                'priority' => '0.9',
            ],
        ];

        foreach ($properties as $property) {
            $urls[] = [
                'loc' => route('properties.show', $property),
                'lastmod' => optional($property->updated_at)->toDateString() ?? now()->toDateString(),
                'changefreq' => 'monthly',
                'priority' => $property->is_coming_soon ? '0.75' : '0.9',
            ];
        }

        foreach ($pages as $page) {
            $urls[] = [
                'loc' => route($page['route_name']),
                'lastmod' => $this->viewLastModified('seo-landing'),
                'changefreq' => 'monthly',
                'priority' => '0.8',
            ];
        }

        $urls[] = [
            'loc' => route('privacy'),
            'lastmod' => $this->viewLastModified('privacy'),
            'changefreq' => 'yearly',
            'priority' => '0.3',
        ];

        $urls[] = [
            'loc' => route('terms'),
            'lastmod' => $this->viewLastModified('terms'),
            'changefreq' => 'yearly',
            'priority' => '0.3',
        ];

        return response()
            ->view('sitemap.xml', ['urls' => $urls])
            ->header('Content-Type', 'application/xml');
    }

    protected function viewLastModified(string $view): string
    {
        $path = resource_path('views/pages/' . $view . '.blade.php');

        return file_exists($path)
            ? date('Y-m-d', filemtime($path))
            : now()->toDateString();
    }

    protected function pages(): array
    {
        return [
            'luxury-stays-korcula' => [
                'slug' => 'luxury-stays-korcula',
                'route_name' => 'seo.page.luxury',
                'title' => 'Luxury Stays in Korčula | Historic Residences by Case dei Nobili',
                'meta_description' => 'Discover luxury stays in Korčula with restored Gothic and Renaissance residences in the heart of the Old Town.',
                'eyebrow' => 'Korčula Stays',
                'headline' => 'Luxury stays in <em>Korčula</em>',
                'intro' => 'Historic texture, private-house privacy, and a more cultivated way to stay on one of the Adriatic’s most atmospheric islands.',
                'hero_image' => 'images/Korcula_birds_eye_2.webp',
                'hero_alt' => 'Luxury stays in Korčula overlooking the old town and Adriatic',
                'section_title' => 'A different kind of luxury',
                'body' => [
                    'Case dei Nobili offers something rarer than a conventional luxury hotel: restored private residences rooted in Korčula’s noble and mercantile history. Guests stay inside authentic stone houses where Gothic proportions, Renaissance details, antique furnishings and discreet modern comfort coexist naturally.',
                    'For travelers searching for luxury stays in Korčula, the appeal is not excess but depth. You are in the Old Town itself, steps from the Cathedral of St. Mark, the waterfront, wine bars, sailing departures and the evening rhythm of the island. The experience feels residential, not transactional.',
                    'Each residence is suited to guests who care about atmosphere, privacy, history and a sense of place. That makes the collection especially strong for couples, design-conscious travelers, cultural stays and multi-day escapes around the Dalmatian coast.',
                ],
                'highlights' => [
                    'Restored historic houses in Korčula Old Town',
                    'Private accommodation with curated interiors',
                    'Walkable access to the waterfront and cathedral quarter',
                    'Ideal for heritage travel, romantic stays and refined island escapes',
                ],
                'faq' => [
                    [
                        'q' => 'Why choose a historic residence instead of a hotel in Korčula?',
                        'a' => 'A historic residence offers more privacy, more atmosphere and a stronger sense of place. You stay inside the Old Town fabric rather than simply visiting it during the day.',
                    ],
                    [
                        'q' => 'Are these stays suitable for luxury travelers?',
                        'a' => 'Yes. The luxury lies in authenticity, location, restoration quality and discreet comfort rather than generic resort-style amenities.',
                    ],
                    [
                        'q' => 'Is Korčula a good base for a high-end Adriatic trip?',
                        'a' => 'Very much so. Korčula combines heritage, gastronomy, swimming, sailing and a calmer rhythm than larger destinations, making it ideal for a more cultivated itinerary.',
                    ],
                ],
            ],
            'historic-houses-korcula-old-town' => [
                'slug' => 'historic-houses-korcula-old-town',
                'route_name' => 'seo.page.historic',
                'title' => 'Historic Houses in Korčula Old Town | Case dei Nobili',
                'meta_description' => 'Stay in historic houses in Korčula Old Town, restored with respect for Gothic and Renaissance heritage and modern comfort.',
                'eyebrow' => 'Heritage Accommodation',
                'headline' => 'Historic houses in <em>Korčula Old Town</em>',
                'intro' => 'For guests who want to stay inside the stone fabric of Korčula, not just look at it from a hotel terrace.',
                'hero_image' => 'images/korcula_CityEntry.webp',
                'hero_alt' => 'Historic houses and stone streets in Korčula Old Town',
                'section_title' => 'Stay inside the old town itself',
                'body' => [
                    'Korčula Old Town is one of the Adriatic’s most elegant historic settlements, with limestone streets, defensive walls, ecclesiastical landmarks and Venetian layers visible in everyday life. Finding the right accommodation inside this environment matters because the atmosphere changes completely when you stay within the walls.',
                    'Case dei Nobili focuses on historic houses in Korčula Old Town that have been restored as livable residences, not stripped-back museum pieces. Original architectural character remains visible, but the houses are designed to be inhabited comfortably over several nights or longer stays.',
                    'This is particularly attractive for guests interested in heritage travel, architecture, cultural immersion and a quieter form of luxury. Instead of commuting into the center, you wake up within it.',
                ],
                'highlights' => [
                    'Accommodation inside the medieval core of Korčula',
                    'Gothic and Renaissance architectural character',
                    'Private homes rather than anonymous tourist units',
                    'Strong fit for heritage-led travel and cultural stays',
                ],
                'faq' => [
                    [
                        'q' => 'Is it better to stay inside Korčula Old Town?',
                        'a' => 'If your priority is atmosphere, walkability and historic character, yes. Staying inside the Old Town changes the experience of the island significantly.',
                    ],
                    [
                        'q' => 'Are the houses modernised?',
                        'a' => 'Yes. They are restored for contemporary comfort while preserving stonework, scale, plan and historic details wherever possible.',
                    ],
                    [
                        'q' => 'Who usually chooses this type of accommodation?',
                        'a' => 'Guests drawn to architecture, design, cultural travel, history and private-house stays tend to value this format most.',
                    ],
                ],
            ],
            'destination-weddings-korcula' => [
                'slug' => 'destination-weddings-korcula',
                'route_name' => 'seo.page.weddings',
                'title' => 'Destination Weddings in Korčula | Historic Accommodation & Celebrations',
                'meta_description' => 'Plan destination weddings in Korčula with historic accommodation, Old Town atmosphere and curated stays for intimate celebrations.',
                'eyebrow' => 'Korčula Weddings',
                'headline' => 'Destination weddings in <em>Korčula</em>',
                'intro' => 'Historic residences, Old Town atmosphere and a setting designed for intimate celebrations with character.',
                'hero_image' => 'images/Sant_Markus_Sq.webp',
                'hero_alt' => 'Destination wedding setting in Korčula near St Mark square',
                'section_title' => 'A wedding setting with real atmosphere',
                'body' => [
                    'Korčula is especially compelling for destination weddings because it combines ceremony atmosphere, Adriatic light, walkable beauty and a strong sense of occasion without the scale or noise of larger resort destinations. The Old Town feels cinematic yet intimate.',
                    'Case dei Nobili supports destination weddings in Korčula through accommodation-led hosting: historic residences for the couple, family or close guests, paired with the possibility of multi-property stays, nearby ceremony settings and curated local experiences.',
                    'This approach works especially well for smaller weddings, refined celebrations, rehearsal gatherings and guest groups who value design, privacy and place. The appeal is elegant, understated and deeply tied to Korčula itself.',
                ],
                'highlights' => [
                    'Historic accommodation for couples, family and select guests',
                    'Ideal setting for intimate destination weddings',
                    'Walkable connection to Old Town landmarks and waterfront',
                    'Strong fit for multi-day celebrations with character',
                ],
                'faq' => [
                    [
                        'q' => 'Is Korčula good for a destination wedding?',
                        'a' => 'Yes. It offers beauty, intimacy, heritage, sea access and a much more distinctive atmosphere than many standard wedding destinations.',
                    ],
                    [
                        'q' => 'Is Case dei Nobili a wedding venue?',
                        'a' => 'It is best understood as historic accommodation that can anchor a destination wedding stay, especially for intimate, design-led celebrations.',
                    ],
                    [
                        'q' => 'Who is this best suited for?',
                        'a' => 'Couples planning a smaller, more atmospheric celebration with guests who value heritage, privacy and a refined sense of place.',
                    ],
                ],
            ],
        ];
    }
}
