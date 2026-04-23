<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $team = [
            [
                'name'  => 'Tatjana von Griesheim-Radović & Georg von Griesheim',
                'role'  => 'Founder & Director',
                'bio'   => 'Over 20 years restoring historical heritage on the Dalmatian coast. Passionate about medieval architecture and the soul of every stone.',
                'image' => '/images/about_us_01.jpg',
            ],
            // [
            //     'name'  => 'Ana Kovačević',
            //     'role'  => 'Directora de Restauración',
            //     'bio'   => 'Arquitecta especializada en patrimonio histórico. Lidera cada restauración con el rigor de la conservación y la sensibilidad del habitar.',
            //     'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&q=80',
            // ],
            // [
            //     'name'  => 'Marco Desantis',
            //     'role'  => 'Gestor de Experiencias',
            //     'bio'   => 'Cuida cada estancia como si fuera la suya propia. Conoce cada rincón de Korčula y cada historia que guardan sus muros.',
            //     'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=600&q=80',
            // ],
        ];

        $values = [
            [
                'title' => 'Reverence for the Past',
                'text' => 'Every restoration is an act of respect. We use centuries-old techniques and materials from the island to preserve the soul of each house.',
            ],
            [
                'title' => 'Exclusivity Without Ostentation',
                'text' => 'We dont create hotels. We create private homes where history coexists with contemporary comfort in perfect harmony.',
            ],
            [
                'title' => 'Commitment to the Island',
                'text' => 'We work exclusively with local artisans, suppliers, and collaborators from Korčula. The community is part of our collection.',
            ],
            [
                'title' => 'Unparalleled Service',
                'text' => 'Every guest receives personalized attention before, during, and after their stay. We are available at all times.',
            ],
        ];

        return view('pages.about', compact('team', 'values'));
    }
}
