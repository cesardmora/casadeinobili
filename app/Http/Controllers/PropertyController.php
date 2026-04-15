<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\View\View;
use Illuminate\Http\Response;

class PropertyController extends Controller
{
    /**
     * Display a listing of all published properties.
     */
    public function index(): View
    {
        $properties = Property::published()
            ->orderBy('sort_order')
            ->get();

        return view('pages.properties.index', compact('properties'));
    }

    /**
     * Display the specified property.
     */
    public function show(Property $property): View|Response
    {
        if (! $property->is_published) {
            abort(404);
        }

        return view('pages.properties.show', compact('property'));
    }
}
