<?php

return [
    'menu' => array(
        'order' => 3,
        'group' => 'uyeler',
        'title' => ___('Üyeler'),
        'icon' => 'ri-group-fill',
        'url' => '',
        'list' => array(
            array(
                'title' => ___('Üye İşlemleri'),
                'url' => 'project.index',
            ),
            array(
                'title' => ___('Üye Test Sonuçları'),
                'url' => 'project.index',
            ),
            array(
                'title' => ___('Üye Görüşmeleri'),
                'url' => 'project.index',
            ),
        )
    )
];
