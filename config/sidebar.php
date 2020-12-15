<?php

return [
    'links'=>[
        // dashboard
        [
            'name'  =>'dashboard',
            'icon'  =>'mdi mdi-view-dashboard-outline',
            'active'=>false,
            'sub'   =>[
                [
                    'name'  =>'default',
                    'new'   =>false,
                    'color' =>'danger',
                    'route' =>'dashboard'
                ]
            ],
        ],
        //subscriptions
        [
            'name'  =>'all_subscription',
            'icon'  =>'mdi mdi-radar',
            'active'=>false,
            'sub'   =>[
                [
                    'name'  =>'all_subscription',
                    'new'   =>false,
                    'color' =>'danger',
                    'route' =>'Subscribe.index'
                ],
                [
                    'name'  =>'create_subscription',
                    'new'   =>false,
                    'color' =>'danger',
                    'route' =>'Subscribe.create'
                ],
                [
                    'name'  =>'subscription_history',
                    'new'   =>true,
                    'color' =>'danger',
                    'route' =>'Subscribe.show-old-records',
                ]
            ],
        ],
        // setting
        [
            'name'  =>'settings',
            'icon'  =>'mdi mdi-settings',
            'active'=>false,
            'sub'   =>[
                [
                    'name'  =>'system',
                    'new'   =>false,
                    'color' =>'secondary',
                    'route' =>'setting.index'
                ],
                [
                    'name'  =>'translations',
                    'new'   =>false,
                    'color' =>'warning',
                    'route' =>'translation.index'
                ]
            ]
        ]
    ]
];
