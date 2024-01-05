<?php

use craft\elements\Asset;
use craft\elements\Entry;
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
                    $storeCategories = [];
                    // Assuming 'storeCategories' is a Structure field
                    foreach ($entry->storeCategories->all() as $category) {
                        $storeCategories[] = [
                            'categoryTitle' => $category->title,
                            // Add other category fields if needed
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'price' => $entry->price,
                        'storeCategories' => $storeCategories,
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
                    $storeCategories = [];
                    // Assuming 'storeCategories' is a Structure field
                    foreach ($entry->storeCategories->all() as $category) {
                        $storeCategories[] = [
                            'categoryTitle' => $category->title,
                            // Add other category fields if needed
                        ];
                    }

                    return [
                        'id' => $entry->id,
                        'title' => $entry->title,
                        'price' => $entry->price,
                        'fullText' => $entry->fullText,
                        'storeCategories' => $storeCategories,
                        'assImg' => str_replace("https", "http", $entry->bannerImage->one()->getUrl('assortimentImage')),
                    ];
                },
            ];
        },
    ]
];
