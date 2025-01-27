<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcast Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the default broadcast driver that will be used by
    | your application. The supported drivers are "pusher", "redis", and
    | "log". You may also use "null" if you don't want broadcasting.
    |
    */

    'default' => env('BROADCAST_DRIVER', 'pusher'),

    /*
    |--------------------------------------------------------------------------
    | Broadcast Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure all of the connections that should be used when
    | broadcasting events. You can configure multiple broadcast drivers
    | to your application and assign them to different events.
    |
    */
    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            // 'key' => env('PUSHER_APP_KEY'),
            // 'secret' => env('PUSHER_APP_SECRET'),
            // 'app_id' => env('PUSHER_APP_ID'),
            'key' => config('settings.pusher_key'),  // Dynamically pulled from settings
            'secret' => config('settings.pusher_secret'),
            'app_id' => config('settings.pusher_app_id'),
            'options' => [
                // 'cluster' => env('PUSHER_APP_CLUSTER'),
                'cluster' => config('settings.pusher_cluster'),
                'useTLS' => true,
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
