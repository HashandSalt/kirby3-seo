<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('hashsandsalt/kirby3-seo', [

    'snippets' => [
      'seo/meta'    => __DIR__ . '/snippets/meta.php',
      'seo/favicon' => __DIR__ . '/snippets/favicon.php'
    ],

    'blueprints' => [
      'tabs/seo/contact'    => __DIR__ . '/blueprints/tabs/contact.yml',
      'tabs/seo/meta'       => __DIR__ . '/blueprints/tabs/meta.yml',
      'fields/seo/meta'     => __DIR__ . '/blueprints/fields/meta.yml'
    ],

    'controllers' => [

        'seo' => function ($page, $kirby, $site) {
            return [

              // Meta
              'metatitle'         => $site->title(),
              'metadesc'          => $page->seometa(),
              'metakeywords'      => $page->seotags(),
              'metarobots'        => 'index, follow, noodp',
              'metaurl'           => $site->url(),
              'metaimage'         => $page->shareimage()->toFile() ? $page->shareimage()->toFile()->focusCrop(1280, 720)->url() : ' ',

              // Facebook Meta
              'metafbtype'         => 'website',
              'metafbsitename'     => $site->title(),

              // Twitter Meta
              'metatwcard'         => 'large_summary',
              'metatwsite'         => $site->socialtwitterurl()->isNotEmpty() ? $site->socialtwitterurl() : ' ',
              'metatwcreator'      => $site->socialtwitterhandle()->isNotEmpty() ? $site->socialtwitterhandle() : ' ',

            ];
        }
    ]
]);
