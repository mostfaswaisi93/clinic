<?php

return [
    'roles_structure'   => [
        'super_admin' => [
            'notifications'     => 'c,r,u,d',
            'contacts'          => 'c,r,u,d',
            'countries'         => 'c,r,u,d',
            'cities'            => 'c,r,u,d',
            'states'            => 'c,r,u,d',
            'users'             => 'c,r,u,d',
            'roles'             => 'c,r,u,d',
            'settings'          => 'c,r,u,d',
        ],
        'admin'       => [
            'roles'         => 'r',
            'users'         => 'r',
        ]
    ],

    'permissions_map'   => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'p' => 'print'
    ]
];
