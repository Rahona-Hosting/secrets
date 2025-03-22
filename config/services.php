<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'local-auth' => [
        'enable' => env('LOCAL_AUTH_ENABLE', true),
    ],

    'sso-label' => [
        'name' => env('SSO_LABEL_NAME', 'Connexion SSO'),
        'icon' => env('SSO_LABEL_ICON', 'fas fa-building'),
        'classes' => env('SSO_LABEL_CLASSES', 'bg-white bg-opacity-5 hover:bg-opacity-10 text-white border border-blue-800'),
    ],

    'generic-sso' => [
        'client_id' => env('SSO_CLIENT_ID'),
        'client_secret' => env('SSO_CLIENT_SECRET'),
        'redirect' => env('SSO_REDIRECT_URI'),
        'auth_endpoint' => env('SSO_AUTH_ENDPOINT'),
        'token_endpoint' => env('SSO_TOKEN_ENDPOINT'),
        'userinfo_endpoint' => env('SSO_USERINFO_ENDPOINT'),
    ],

    'authentik' => [
        'base_url' => env('AUTHENTIK_BASE_URL'),
        'client_id' => env('AUTHENTIK_CLIENT_ID'),
        'client_secret' => env('AUTHENTIK_CLIENT_SECRET'),
        'redirect' => env('AUTHENTIK_REDIRECT_URI'),
    ],

    'discord' => [
        'client_id' => env('DISCORD_CLIENT_ID'),
        'client_secret' => env('DISCORD_CLIENT_SECRET'),
        'redirect' => env('DISCORD_REDIRECT_URI'),
    ],

    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => env('GITHUB_REDIRECT_URI'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],
];
