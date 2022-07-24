<?php
return [
    'pusher' => [
        'driver' => 'pusher',
        'key' => env('PUSHER_APP_KEY'),
        'secret' => env('PUSHER_APP_SECRET'),
        'app_id' => env('PUSHER_APP_ID'),
        'options' => [
            'cluster' => 'eu',
            'encrypted' => true,
            // 'host' => 'api-eu.pusher.com'
            // 'debug' => true,
        ],
    ],
];
