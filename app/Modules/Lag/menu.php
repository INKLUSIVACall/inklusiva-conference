<?php

use Illuminate\Support\Facades\Vite;

return [
    'mainMenu' => [ // Menu instance
        'Startseite' => [
            'attributes' => ['route' => 'base.home'],
            'active' => [],
            'data' => [
                'aliclass' => '',
            ],
        ],

        'Meetings' => [
            'attributes' => ['route' => 'lag.meeting.index'],
            'active' => ['admin/meeting/*'],
            'data' => [],
        ],
        'Aufzeichnungen' => [
            'attributes' => ['route' => 'lag.recording.index'],
            'active' => ['admin/recording/*'],
            'data' => [],
        ],
    ],


    'mainMenuFooter' => [ // Menu instance
        'Startseite' => [
            'attributes' => ['route' => 'base.home'],
            'active' => [],
            'data' => [
                'aclass' => 'component-textlink invert',
                'icon' => 'fa-solid fa-arrow-right'
            ],
        ],

        'Meetings' => [
            'attributes' => ['route' => 'lag.meeting.index'],
            'active' => ['admin/meeting/*'],
            'data' => [
                'aclass' => 'component-textlink invert',
                'icon' => 'fa-solid fa-arrow-right'
            ],
        ],
        'Aufzeichnungen' => [
            'attributes' => ['route' => 'lag.recording.index'],
            'active' => ['admin/recording/*'],
            'data' => [
                'aclass' => 'component-textlink invert',
                'icon' => 'fa-solid fa-arrow-right'
            ],
        ],
    ],

    'footerMenu' => [ // Menu instance
        'Erkärung zur Barrierefreiheit' => [
            'attributes' => ['link' => 'https://www.viermorgen.de'],
            'active' => [],
            'data' => [
                'aclass' => 'component-textlink invert',
                'icon' => 'fa-solid fa-arrow-right'
            ],
        ],
        'Produktwebseite' => [
            'attributes' => ['link' => 'https://www.viermorgen.de'],
            'active' => ['admin/meeting/*'],
            'data' => [
                'aclass' => 'component-textlink invert',
                'icon' => 'fa-solid fa-arrow-right'
            ],
        ],
        'AGB' => [
            'attributes' => ['route' => 'lag.wizard.intro'],
            'active' => [],
            'data' => [
                'onclick' => 'window.open(\'' . env('INKLUSIVA_WEBSITE').'/agb' . '\')',
                'aclass' => 'component-textlink invert',
                'icon' => 'fa-solid fa-arrow-right',
            ],
        ],
        'Datenschutz' => [
            'attributes' => ['route' => 'lag.wizard.intro'],
            'active' => [],
            'data' => [
                'onclick' => 'window.open(\'' . env('INKLUSIVA_WEBSITE').'/datenschutz' . '\')',
                'aclass' => 'component-textlink invert',
                'icon' => 'fa-solid fa-arrow-right',
            ],
        ],
        'Impressum' => [
            'attributes' => ['route' => 'lag.wizard.intro'],
            'active' => [],
            'data' => [
                'onclick' => 'window.open(\'' . env('INKLUSIVA_WEBSITE').'/inklusiva-call-impressum' . '\')',
                'aclass' => 'component-textlink invert',
                'icon' => 'fa-solid fa-arrow-right',
            ],
        ],
        'Sitemap' => [
            'attributes' => ['route' => 'lag.sitemap.index'],
            'active' => ['sitemap/*'],
            'data' => [
                'aclass' => 'component-textlink invert',
                'icon' => 'fa-solid fa-arrow-right'
            ],
        ],
    ],
    'helpMenu' => [
        'Barriere melden' => [
            'attributes' => ['route' => 'lag.wizard.intro'],
            'active' => [],
            'data' => [
                'aclass' => 'component-border-button invert',
                'icon' => 'fa-solid fa-road-barrier',
                'onclick' => 'htmx.ajax(\'GET\', \'' . route('barrier.index') . '\', {target:\'#modalcontainer\'})'
            ],
        ],
        'Hilfe' => [
            'attributes' => ['route' => 'lag.wizard.intro'],
            'active' => [],
            'data' => [
                'aclass' => 'component-border-button invert',
                'icon' => 'fa-solid fa-info',
                'demolink' => true
            ],
        ],
        'Anleitung Leichte Sprache' => [
            'attributes' => ['route' => 'lag.wizard.intro'],
            'active' => [],
            'data' => [
                'aclass' => 'component-border-button invert',
                'img' => Vite::asset('resources/images/icon-leichte-sprache.png'),
                'alt' => 'Icon für Leichte Sprache',
                'demolink' => true
            ],
        ],
    ],
];
