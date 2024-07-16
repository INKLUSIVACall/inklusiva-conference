<?php

return [
    'mainMenu' => [ // Menu instance
        'Verwaltung' => [
            'attributes' => ['route' => 'useradmin.user.index'],
            'active' => ['admin/user/*'],
            'data' => [
            ],
        ],
        'Mein Profil' => [
            'attributes' => ['route' => 'useradmin.profile.index'],
            'active' => ['/profile/*'],

            'children' => [
                'Persönliche Daten' => [
                    'attributes' => ['route' => 'useradmin.profile.index'],
                    'active' => ['/profile/maindata/*'],
                    'data' => [

                    ],
                ],
                'Zugangsdaten' => [
                    'attributes' => ['route' => 'useradmin.profile.accessDataIndex'],
                    'active' => ['/profile/accessdata/*'],
                    'data' => [

                    ],
                ],
                'Meeting-Einstellungen' => [
                    'attributes' => ['route' => 'lag.wizard.intro'],
                    'active' => [''],
                    'data' => [
                        'target' => '_blank',
                    ],
                ],
                // Since Logout is a POST-Request, we need to add a form to the menu item via 'method' => 'post'
                'Ausloggen' => [
                    'attributes' => [
                        'route' => 'logout',
                        'method' => 'post',
                    ],
                    'active' => [],
                    'data' => [
                        'icon' => 'fa-solid fa-lock',
                        'aclass' => 'as-navigation',
                        'aliclass' => '  d-none d-lg-block'
                    ],
                ],
            ]
        ],
        // Since Logout is a POST-Request, we need to add a form to the menu item via 'method' => 'post'
        'Ausloggen' => [
            'attributes' => [
                'route' => 'logout',
                'method' => 'post',
            ],
            'active' => [],
            'data' => [
                'icon' => 'fa-solid fa-lock',
                'aclass' => 'as-navigation ',
                'aliclass' => ' d-lg-none'
            ],
        ],
    ],
];
