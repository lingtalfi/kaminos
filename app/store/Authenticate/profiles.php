<?php

$store = [
    'profiles' => [
        'admin' => [
            'groups' => [
                'AutoAdmin-admin',
                'group3',
            ],
            'abadge1',
            'abadge2',
        ],
        'root' => [
            'groups' => [
                'group3',
            ],
            'badge1',
            'badge2',
        ],
    ],
    'groups' => [
        'AutoAdmin' => [
        ],
        'AutoAdmin-admin' => [
            'groups' => [
            ],
            'useGenerator',
        ],
        'group1' => [
            'groups' => [
            ],
            'badge3',
            'badge4',
        ],
        'group2' => [
            'groups' => [
            ],
            'badge5',
            'badge6',
        ],
        'group3' => [
            'groups' => [
                'group1',
            ],
            'badge7',
            'badge8',
        ],
    ],
];

