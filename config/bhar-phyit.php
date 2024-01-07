<?php

use Illuminate\Support\Str;

return [
    'enabled' => env('BHAR_PHYIT_ENABLED', true),

    'usuage_mode' => 'local',

    'hidden' => [
        'search',
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
