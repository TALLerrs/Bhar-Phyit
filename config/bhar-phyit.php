<?php

use Illuminate\Support\Str;

return [
    'url' => env('BHAR_PHYIT_URL', 'bhar-phyit'),

    'enabled' => env('BHAR_PHYIT_ENABLED', true),

    'usuage_mode' => 'local',

    'hidden' => [
        'search',
    ],

    'channels' => [
        'slack' => [
            'enabled' => env('BHAR_PHYIT_SLACK_ENABLED', true),
            'webhook_url' => env('ERROR_TRACKING_SLACK_WEBHOOK_URL',null),
        ],
        'telegram' => [
            'enabled' => env('BHAR_PHYIT_TELEGRAM_ENABLED', false),
            'webhook_url' => env('ERROR_TRACKING_TELEGRAM_WEBHOOK_URL',null),
        ],
        'mail' => [
            'enabled' => env('BHAR_PHYIT_MAIL_ENABLED', false),
            'webhook_url' => env('ERROR_TRACKING_MAIL_WEBHOOK_URL',null),
        ],
    ],
    
    /*
    |--------------------------------------------------------------------------
    | BharPhyit Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each BharPhyit route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => ['web'],
];
