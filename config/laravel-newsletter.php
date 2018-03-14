<?php

return [

        /*
         * The api key of a MailChimp account. You can find yours here:
         * https://us10.admin.mailchimp.com/account/api-key-popup/
         */
        'apiKey' => env('MAILCHIMP_APIKEY'),

        /*
         * When not specifying a listname in the various methods, use the list with this name
         */
        'defaultListName' => 'general',

        /*
         * Here you can define properties of the lists you want to
         * send campaigns.
         */
        'lists' => [

            /*
             * This key is used to identify this list. It can be used
             * in the various methods provided by this package.
             *
             * You can set it to any string you want and you can add
             * as many lists as you want.
             */
            'general' => [
                'id' => env('MAILCHIMP_LIST_ID_GENERAL'),
            ],
            'test' => [
                'id' => env('MAILCHIMP_LIST_ID_TEST'),
            ],
            'schakeltje' => [
                'id' => env('MAILCHIMP_LIST_ID_SCHAKELTJE'),
            ],
            'kapoenen' => [
                'id' => env('MAILCHIMP_LIST_ID_KAPOENEN'),
            ],
            'welpen' => [
                'id' => env('MAILCHIMP_LIST_ID_WELPEN'),
            ],
            'jojos' => [
                'id' => env('MAILCHIMP_LIST_ID_JOJOS'),
            ],
            'givers' => [
                'id' => env('MAILCHIMP_LIST_ID_GIVERS'),
            ],
        ],

        /*
         * If you're having trouble with https connections, set this to false.
         */
        'ssl' => true,
];
