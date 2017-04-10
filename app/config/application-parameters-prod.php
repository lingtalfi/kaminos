<?php


$params = [];
include __DIR__ . "/application-parameters-dev.php"; // change that when you actually go to prod...

$params = array_merge($params, [
    'debug' => false,
]);
