<?php

return [

	'processors_config' => [

        'stripe' => [
            'secret' => env('STRIPE_SECRET'),
            'public' => env('STRIPE_PUBLIC'),
            'base_url' => env('STRIPE_BASE_URL'),
            'webhook_url' => env('STRIPE_WEBHOOK_URL'),
            'webhook_secret' => env('STRIPE_WEBHOOK_SECRET'),
            'portal_return_uri' => env('STRIPE_PORTAL_RETURN_URI'),
        ],

        'paypal' => [
            'secret' => env('PAYPAL_SECRET'),
            'public' => env('PAYPAL_PUBLIC'),
            'base_url' => env('PAYPAL_BASE_URL'),
            'webhook_url' => env('PAYPAL_WEBHOOK_URL'),
        ],

        // For other processors, add their configuration here

    ],

    'redirects' => [
        'success' => env('OMNIBILLING_SUCCESS_REDIRECT', url('/success')),
        'cancel' => env('OMNIBILLING_CANCEL_REDIRECT', url('/cancel')),
        'error' => env('OMNIBILLING_ERROR_REDIRECT', url('/error')),
    ],
	
];