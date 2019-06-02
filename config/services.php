<?php

return [
    'facebook' => [
        'client_id'     => env('FB_CLIENT_ID'),
        'client_secret' => env('FB_CLIENT_SECRET'),
        'redirect'      => env('FB_REDIRECT')
    ],
    'google' => [
        'client_id'     => env('GG_CLIENT_ID'),
        'client_secret' => env('GG_CLIENT_SECRET'),
        'redirect'      => env('GG_REDIRECT')
    ],
];
