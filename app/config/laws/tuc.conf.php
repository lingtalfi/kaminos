<?php


$conf = [
    "layout" => [
        "name" => "splash/default",
    ],
    "widgets" => [
        "main.htmlCode1" => [
            "name" => "htmlCode/test",
            "conf" => [
                "html" => <<<EEE
some html code here
EEE
                ,
            ],
        ],
        "main.htmlCode2" => [
            "name" => "htmlCode/test",
            "conf" => [
                "html" => <<<EEE
some other html code here
EEE
                ,
            ],
        ],
    ],
];