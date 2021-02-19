<?php

return [
    'roles_structure'       => [
        'super_admin'   => [
            'appointments'      => 'c,r,u,d,p,ma',
            'patients'          => 'c,r,u,d,p,ma',
            'services'          => 'c,r,u,d,p,ma',
            'invoices'          => 'c,r,u,d,p,ma',
            // 'notifications'     => 'c,r,u,d,p,ma',
            'contacts'          => 'c,r,u,d,p,ma',
            'countries'         => 'c,r,u,d,p,ma',
            'cities'            => 'c,r,u,d,p,ma',
            'districts'         => 'c,r,u,d,p,ma',
            'locations'         => 'c,r,u,d,p,ma',
            'constants'         => 'c,r,u,d,p,ma',
            // 'payments'          => 'c,r,u,d,p,ma',
            'receipts'          => 'c,r,u,d,p,ma',
            'transactions'      => 'c,r,u,d,p,ma',
            'users'             => 'c,r,u,d,p,ma',
            'roles'             => 'c,r,u,d,p,ma',
            // 'reports'           => 'c,r,u,d,p,ma',
            'settings'          => 'c,r,u,d,p,ma',
        ],
        'doctor'       => [
            'services'          => 'r,u,d',
            'users'             => 'c,r,u,d,p,ma',
        ],
        'secretary'    => [
            'users'             => 'c,r,u,d,p,ma',
        ]
    ],

    'permissions_map'       => [
        'c'     => 'create',
        'r'     => 'read',
        'u'     => 'update',
        'd'     => 'delete',
        'p'     => 'print',
        'ma'    => 'multi_delete',
    ]
];
