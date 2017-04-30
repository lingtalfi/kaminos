<?php

use Kamille\Ling\Z;

$appDir = Z::appDir();


$profiles = [
    "default_image" => [
        "maxFileSize" => "10",
//        "acceptedFiles" => [
//            'application/pdf',
//        ],
        "targetDir" => $appDir . "/www/uploads/test",
    ],
];