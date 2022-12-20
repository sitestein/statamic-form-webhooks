<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Form webhooks
    |--------------------------------------------------------------------------
    |
    | Here you can specify the webhooks for the form submissions.
    | The key is the form handle.
    |
    */
    'webhooks' => [

        // form handle
        'contact' => [

            // webhook url
            'url' => 'https://hook.eu1.make.com/loremipsum',

            // which fields to send
            // or use 'fields' => '*' for all
            'fields' => [
                'name',
                'email',
            ],

            // conditions to send
            // 'if' => [
            //    'checkboxes_field.0' => 'subscribe',
            // ],
        ],
    ]
];
