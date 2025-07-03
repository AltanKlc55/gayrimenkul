<?php

return [
    'menu' => array(
        'order' => 2,
        'group' => 'category',
        'title' => ___('İlan Kategorileri'),
        'icon' => 'ri-archive-line',
        'url' => '',
        'list' => array(
            array(
                'title' => ___('Yapı Kategorisi'),
                'url' => 'category.index',
            ),
            array(
                'title' => ___('Özellik Kategorisi'),
                'url' => 'estateproperties.index',
            )
        )
    )
];