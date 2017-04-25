<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;

$prefixUri = "/theme/" . ApplicationParameters::get("theme");
$imgPrefix = $prefixUri . "/production";
$conf = [
    "layout" => [
        "tpl" => "admin/default",
    ],
    "widgets" => [
        "sidebar.navTitle" => [
            "tpl" => "NullosAdmin/NavTitle/default",
            "conf" => [
                "link" => "index.html",
                "iconClass" => "fa fa-paw",
                "title" => "NullosAdmin",
            ],
        ],
        "sidebar.menuProfileQuickInfo" => [
            "tpl" => "NullosAdmin/MenuProfileQuickInfo/default",
            "conf" => [
                "imgSrc" => $imgPrefix . '/images/ling.jpg',
                "imgAlt" => "...",
                "welcomeText" => "Welcome,",
                "userName" => "John Doe",
            ],
        ],
        "maincontent.a" => [
            "grid" => "1/3",
            "tpl" => "HtmlCode/default",
            "conf" => [
                "html" => "content A",
            ],
        ],
        "maincontent.b" => [
            "grid" => "1/3",
            "tpl" => "HtmlCode/default",
            "conf" => [
                "html" => "content B",
            ],
        ],
        "maincontent.c" => [
            "grid" => "1/3",
            "tpl" => "HtmlCode/default",
            "conf" => [
                "html" => "content C",
            ],
        ],
        "maincontent.d" => [
            "grid" => "1/3",
            "tpl" => "HtmlCode/default",
            "conf" => [
                "html" => "content D",
            ],
        ],
        "maincontent.e" => [
            "grid" => "2/3-1",
            "tpl" => "HtmlCode/default",
            "conf" => [
                "html" => "content E",
            ],
        ],
        "maincontent.f" => [
            "grid" => "1/2",
            "tpl" => "HtmlCode/default",
            "conf" => [
                "html" => "content F",
            ],
        ],
        "maincontent.g" => [
            "grid" => "1/2.",
            "tpl" => "HtmlCode/default",
            "conf" => [
                "html" => "content G",
            ],
        ],
    ],
    "grid" => ["maincontent"],
    "positions" => [
        "*" => function ($s) {
            return '<div style="color: red">' . $s . '</div>';
        },
    ],
];