<?php




$prc = "NullosAdmin.User";
require_once __DIR__ . "/inc/common.php";


$profile = array_replace_recursive($profile, [
    "model" => [
        'headers' => [
            "id",
            "name",
            "pass",
            "profile",
            "action",
        ],
        'hidden' => ['pass'],
        'ric' => ['id'],
        'actionButtons' => [
            'addItem' => [
                'label' => "Add User",
            ],
        ],
    ],
]);
