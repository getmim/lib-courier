<?php

return [
    '__name' => 'lib-courier',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/lib-courier.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'http://iqbalfn.com/'
    ],
    '__files' => [
        'modules/lib-courier' => ['install','update','remove']
    ],
    '__dependencies' => [
        'required' => [],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'LibCourier\\Library' => [
                'type' => 'file',
                'base' => 'modules/lib-courier/library'
            ],
            'LibCourier\\Iface' => [
                'type' => 'file',
                'base' => 'modules/lib-courier/interface'
            ]
        ],
        'files' => []
    ],
    'libCourier' => [
        'handlers' => []
    ]
];
