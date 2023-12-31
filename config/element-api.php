<?php

use craft\elements\Entry;
use craft\elements\Asset;
use craft\helpers\UrlHelper;

return [
    'endpoints' => [
        '/api/assortiment' => function() {
            return [
                'elementType' => Entry::class,
                'criteria' => ['section' => 'assortiment'],
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'price' => $entry->price,
                        'assImg' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('assortimentImage')),
                    ];
                },
            ];
        },
        '/api/assortiment/<entryId:\d+>' => function($entryId) {
            return [
                'elementType' => Entry::class,
                'criteria' => ['id' => $entryId],
                'one' => true,
                'cache' => false,
                'serializer' => 'jsonFeed',
                'transformer' => function(Entry $entry) {
                  return [
                      'id' => $entry->id,
                      'title' => $entry->title,
                      'price' => $entry->price,
                      'fullText' => $entry->fullText,
                      'assImg' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('assortimentImage')),
                  ];
              },
            ];
        },
    ]
];