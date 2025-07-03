<?php

return [
    'menu' => array(
        'order' => 6,
        'group' => 'settings',
        'title' => ___('System Management'),
        'icon' => 'las la-cog',
        'url' => '',
        'list' => array(
            array(
                'title' => ___('Ayarlar'),
                'url' => 'config.index',
            ),
            array(
                'title' => ___('Tanımlar'),
                'url' => 'definitions.index',
            ),
            array(
                'title' => ___('Yetkiler'),
                'url' => 'roles.index',
            )
        )
    )
];
