<?php


$conf = [
    'layout' => [
        'template' => 'modules/My/page1/layout.default',
        'conf' => [
            "name" => 'Pierre',
        ],
    ],
    'widgets' => [
        'top.meteo' => [
            'template' => 'templateName',
            'class' => 'nameOfTheClass',
            'loader' => null,
            'renderer' => null,
            'conf' => [ // widget related conf
                'someVar' => 'someValue',
            ],
        ],
    ],
    'positions' => [
        'positionName' => [
            'template' => 'templateName',
            'class' => 'nameOfTheClass',
            'conf' => [ // widget related conf
                'someVar' => 'someValue',
            ],
        ],
    ],
];