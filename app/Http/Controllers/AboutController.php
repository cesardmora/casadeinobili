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
                'title' => 'Reverencia por el pasado',
                'text'  => 'Cada restauración es un acto de respeto. Usamos técnicas centenarias y materiales de la isla para preservar el alma de cada casa.',
            ],
            [
                'title' => 'Exclusividad sin ostentación',
                'text'  => 'No creamos hoteles. Creamos hogares privados donde la historia convive con el confort contemporáneo en perfecta armonía.',
            ],
            [
                'title' => 'Compromiso con la isla',
                'text'  => 'Trabajamos exclusivamente con artesanos, proveedores y colaboradores locales de Korčula. La comunidad es parte de nuestra colección.',
            ],
            [
                'title' => 'Atención sin igual',
                'text'  => 'Cada huésped recibe atención personalizada antes, durante y después de su estancia. Estamos disponibles en todo momento.',
            ],
        ];

        return view('pages.about', compact('team', 'values'));
    }
}