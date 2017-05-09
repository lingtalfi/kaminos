<?php

$conf = [
    "layout" => [
        "tpl" => "ajax/default",
    ],
    "widgets" => [
        'main.form' => [
            'grid' => "1",
//            'tpl' => "NullosAdmin/Main/Form/prototype",
            'tpl' => "NullosAdmin/Main/Form/default",
            'conf' => [
                "wrap" => false,
                "formModel" => null, // override me
                "showSubmitButtonsGroup" => false,
            ],
        ],
    ],
    "grid" => ['maincontent'],
];