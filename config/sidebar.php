<?php

return [
    'links'=>[
       'admin'=>[
           [
               'name'  =>'dashboard',
               'icon'  =>'mdi mdi-view-dashboard-outline',
               'active'=>false,
               'sub'   =>[
                   [
                       'name'  =>'default',
                       'new'   =>false,
                       'color' =>'danger',
                       'route' =>'home'
                   ]
               ],
           ],
           [
               'name'  =>'all',
               'icon'  =>'mdi mdi-alarm-light',
               'active'=>false,
               'sub'   =>[
                   [
                       'name'  =>'menah_requests',
                       'new'   =>false,
                       'color' =>'danger',
                       'route' =>'dashboard.menah'
                   ],
                   [
                       'name'  =>'mission_requests',
                       'new'   =>false,
                       'color' =>'danger',
                       'route' =>'dashboard.mission'
                   ]
               ],
           ],
           [
               'name'  =>'mission',
               'icon'  =>'mdi mdi-view-dashboard',
               'active'=>false,
               'sub'   =>[
                   [
                       'name'  =>'all_mission',
                       'new'   =>false,
                       'color' =>'danger',
                       'route' =>'mission.index'
                   ],
                   [
                       'name'  =>'mission_create',
                       'new'   =>false,
                       'color' =>'danger',
                       'route' =>'mission.create'
                   ]
               ],
           ]
       ],
        'student'=>[
            [
                'name'  =>'studies',
                'icon'  =>'mdi mdi-account-edit',
                'active'=>false,
                'route'=>'home',
                'sub'   =>[
                    [
                        'name'  =>'studies.index',
                        'new'   =>false,
                        'color' =>'danger',
                        'route' =>'studies.index'
                    ],
                    [
                        'name'  =>'studies.create',
                        'new'   =>false,
                        'color' =>'danger',
                        'route' =>'studies.create'
                    ]
                ],
            ],
            [
                'name'  =>'mission',
                'icon'  =>'mdi mdi-account-edit',
                'active'=>false,
                'route'=>'home',
                'sub'   =>[
                    [
                        'name'  =>'mission.index',
                        'new'   =>false,
                        'color' =>'danger',
                        'route' =>'StudyMission.index'
                    ],
                    [
                        'name'  =>'mission.create',
                        'new'   =>false,
                        'color' =>'danger',
                        'route' =>'StudyMission.create'
                    ]
                ],
            ]

    ]
]
    ];
