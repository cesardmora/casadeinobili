<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the main landing page with all properties.
     */
    public function index(): View
    {
        $properties = cache()->remember('properties_home_collection', 3600, function () {
            return Property::published()->orderBy('sort_order')->get();
        });

        $stats = [
            'properties' => $properties->count(),
            'centuries'  => 'V',
            'island'     => 1,
        ];

        return view('pages.home', compact('properties', 'stats'));
    }
}
