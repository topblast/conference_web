<?php 

return [
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'attendee'),
    ],
    'guards' => [
        'api' => ['driver' => 'api'],
        'attendee' => ['driver' => 'jwt-auth', 'provider' => 'attendee'],
        'client' => ['driver' => 'jwt-auth', 'provider' => 'client'],
        
    ],

    'providers' => [
        //
        'attendee' => ['driver' => 'eloquent', 'model' => App\Models\Attendee::class],
        'client' => ['driver' => 'eloquent', 'model' => App\Models\Client::class],
    ],

    'passwords' => [
        //
    ],
];