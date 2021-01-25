<?php

return [
    'roles_structure'   => [
        'super_admin' => [
            'appointments'      => 'c,r,u,d',
            'patients'          => 'c,r,u,d',
            'services'          => 'c,r,u,d',
            'invoices'          => 'c,r,u,d',
            'notifications'     => 'c,r,u,d',
            'contacts'          => 'c,r,u,d',
            'countries'         => 'c,r,u,d',
            'cities'            => 'c,r,u,d',
            'states'            => 'c,r,u,d',
            'payments'          => 'c,r,u,d',
            'receipts'          => 'c,r,u,d',
            'transactions'      => 'c,r,u,d',
            'users'             => 'c,r,u,d',
            'roles'             => 'c,r,u,d',
            'reports'           => 'c,r,u,d',
            'settings'          => 'c,r,u,d',
        ],
        'admin'       => [
            'roles'         => 'r',
            'users'         => 'r',
        ],
        'doctor'       => [
            'users'             => 'c,r,u,d',
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
