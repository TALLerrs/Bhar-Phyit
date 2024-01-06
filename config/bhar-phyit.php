<?php

return [
    'url' => env('BHAR_PHYIT_URL', 'bhar-phyit'),


    'enabled' => env('BHAR_PHYIT_ENABLED', true),

    'usuage_mode' => 'local',

    'hidden' => [
        'search',
    ],

    'slack' => [
        'enable_bhar_phyit_slack_log_enabled' => env('BHAR_PHYIT_SLACK_ENABLED', true),
        'webhook_url' => env('ERROR_TRACKING_SLACK_WEBHOOK_URL',null),
        'channel' => env('ERROR_TRACKING_SLACK_CHANNEl','#error'),
        'username' => env('ERROR_TRACKING_SLACK_WEBHOOK_USER_NAME','Error Bot'),
        'emoji' => env('ERROR_TRACKING_SLACK_WEBHOOK_EMOJI',':rotating_light:'),
        'level' => ['critical', 'error'],
    ],
];
