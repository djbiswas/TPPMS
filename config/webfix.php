<?php

return [
    'api' => env('WEBFIX_LICENSE_API', 'https://webfixteam.com/v1'),
    'secret' => env('WEBFIX_LICENSE_SECRET', ''),
    'key' => env('WEBFIX_LICENSE_KEY', ''),
    'item' => env('WEBFIX_LICENSE_ITEM', 'tppms'),
    'version' => env('WEBFIX_LICENSE_VERSION', '1.0.0'),
    'bypass' => env('WEBFIX_LICENSE_BYPASS', false),
    'cache_ttl' => 3600,
    'grace_hours' => 24,
];
