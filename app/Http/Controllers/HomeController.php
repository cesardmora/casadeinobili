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
        $properties = Property::published()
            ->orderBy('sort_order')
            ->get();

        $stats = [
            'properties' => Property::published()->count(),
            'centuries'  => 'V',
            'island'     => 1,
        ];

        return view('pages.home', compact('properties', 'stats'));
    }
}
