<?php 

return [
    'defaults' => [
        'guard' => env('AUTH_GUARD', 'client'),
    ],
    'guards' => [
        'api' => ['driver' => 'api'],
        'client' => ['driver' => 'basic', 'provider' => 'client'],
        'attendee' => ['driver' => 'session', 'provider' => 'attendee']
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