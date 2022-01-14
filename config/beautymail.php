<?php

return [

    // These CSS rules will be applied after the regular template CSS


    'css' => [
        '.button-content .button { background: #97c382 }',
    ],


    'colors' => [

        'highlight' => '#97c382',
        'button' => '#6cac44',

    ],

    'view' => [
        'senderName' => config('app.name'),
        'reminder' => null,
        'unsubscribe' => null,
        'address' => null,

        'logo' => [
            'path' => '%PUBLIC%/img/logo.png',
            'width' => '200',
            'height' => '',
        ],

        'twitter' => null,
        'facebook' => null,
        'flickr' => null,
    ],

];
