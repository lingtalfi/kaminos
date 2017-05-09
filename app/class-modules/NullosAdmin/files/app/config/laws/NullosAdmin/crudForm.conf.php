<?php


$conf = [
    "widgets" => [
        'maincontent.crudForm' => [
            'grid' => "1",
            'tpl' => "NullosAdmin/Main/Form/default",
            'conf' => [
                "wrap" => true,
                "formModel" => "OVERRIDE_ME",
                "showSubmitButtonsGroup" => true,
            ],
        ],
    ],
    "grid" => ['maincontent'],
];