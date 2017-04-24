<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;

$theme = ApplicationParameters::get("theme");

$conf = [
    "layout" => [
        "tpl" => "splash/default",
    ],
    "widgets" => [
        "main.maintenance" => [
            "tpl" => "maintenance/default",
            "conf" => [
                "logo_src" => "theme/$theme/widgets/maintenance/logo.png",
                "logo_alt" => "logo",
                "main_text" => "Our website is currently down for maintenance.",
                "aux_text" => "We expect to be back in a couple of hours. Thanks for your patience.",
                "image_src" => "theme/$theme/widgets/maintenance/maintenance.png",
                "image_alt" => "maintenance",
            ],
        ],
    ],
];