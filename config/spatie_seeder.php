<?php

return [
    'roles_structure'       => [
        'super_admin'   => [
            'appointments'      => 'c,r,u,d,p,da',
            'patients'          => 'c,r,u,d,p,da',
            'services'          => 'c,r,u,d,p,da',
            'invoices'          => 'c,r,u,d,p,da',
            // 'notifications'     => 'c,r,u,d,p,da',
            'contacts'          => 'c,r,u,d,p,da',
            'countries'         => 'c,r,u,d,p,da',
            'cities'            => 'c,r,u,d,p,da',
            'states'            => 'c,r,u,d,p,da',
            'constants'         => 'c,r,u,d,p,da',
            // 'payments'          => 'c,r,u,d,p,da',
            'receipts'          => 'c,r,u,d,p,da',
            'transactions'      => 'c,r,u,d,p,da',
            'users'             => 'c,r,u,d,p,da',
            'roles'             => 'c,r,u,d,p,da',
            // 'reports'           => 'c,r,u,d,p,da',
            'settings'          => 'c,r,u,d,p,da',
        ],
        'doctor'       => [
            'services'          => 'r,u,d',
            'users'             => 'c,r,u,d,p,da',
        ],
        'secretary'    => [
            'users'             => 'c,r,u,d,p,da',
        ]
    ],

    'permissions_map'       => [
        'c'     => 'create',
        'r'     => 'read',
        'u'     => 'update',
        'd'     => 'delete',
        'p'     => 'print',
        'da'    => 'del_all',
    ]
];
