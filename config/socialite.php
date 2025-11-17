<?php

return [
    'orcid' => [
        'client_id'     => env('ORCID_CLIENT_ID'),
        'client_secret' => env('ORCID_CLIENT_SECRET'),
        'redirect'      => env('ORCID_REDIRECT_URI'),

        // FORCE PRODUCTION
        'base_url'      => 'https://orcid.org/',
        'authorize_url' => 'https://orcid.org/oauth/authorize',
        'token_url'     => 'https://orcid.org/oauth/token',
    ],
];
