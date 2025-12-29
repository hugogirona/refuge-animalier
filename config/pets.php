<?php

return [
    // Extensions et compression
    'image_type' => 'webp',
    'compression' => 90,

    //Disques

    'original_disk' => env('FILESYSTEM_DISK', 'local'),
    'variant_disk' => env('FILESYSTEM_DISK') === 's3' ? 's3' : 'public',

    // Chemins
    'original_path' => 'images/pets/originals',
    'path_to_variant' => 'images/pets/%s',

    // Tailles des variants
    'sizes' => [
        [
            'name' => 'thumbnail',
            'width' => 200,
            'height' => 200,
        ],
        [
            'name' => 'medium',
            'width' => 600,
            'height' => 600,
        ],
        [
            'name' => 'large',
            'width' => 1200,
            'height' => 1200,
        ],
    ],
];
