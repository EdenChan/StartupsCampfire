<?php

return [
    'multi' => [
        'user' => [
            'driver' => 'eloquent',
            'model'  => StartupsCampfire\Models\User::class,
            'table'  => 'users'
        ],
        'admin' => [
            'driver' => 'eloquent',
            'model'  => StartupsCampfire\Models\Admin::class,
            'table'  => 'admins'
        ]
    ],

    'password' => [
        'email' => 'front.auth.email_content',
        'table' => 'password_resets',
        'expire' => 60,
    ],

];
