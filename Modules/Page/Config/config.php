<?php

  return [
   'menu' => array(
    'order' => 1,
    'group' => 'sayfalar',
    'title' => ___('Sayfalar'),
    'icon' => 'ri-pages-line',
    'url' => '',
    'list' => array(
      array(
       'title' => ___('Anasayfa Slider'),
       'url' => 'subeler.lists',
      ),
      array(
        'title' => ___('Anasayfa'),
        'url' => 'subeler.lists',
      ),
      array(
          'title' => ___('Sayfalar'),
          'url' => 'page.index',
      ),
    )
  )
  ];
