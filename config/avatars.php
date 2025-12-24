<?php

return [
    // Extensions et compression
    'image_type' => 'webp',
    'compression' => 90,

    // Chemins
    'original_path' => 'images/avatars/originals',
    'path_to_variant' => 'images/avatars/%s',

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


    'original_disk' => 'local',
    'variant_disk' => 'public',
];
