<?php


$conf = [
    "widgets" => [
        'maincontent.notifications' => [
            'grid' => "1",
            "tpl" => "Notification/default",
            "conf" => [
                "notifications" => [],
            ],
        ],
        'maincontent.crudForm' => [
            'grid' => "1",
            'tpl' => "NullosAdmin/Main/Form/default",
            'conf' => [
                "wrap" => true,
                "isAjax" => false,
                "formModel" => "OVERRIDE_ME",
                "onAjaxPostMode" => "reloadIfSuccess",
            ],
        ],
    ],
    "grid" => ['maincontent'],
];