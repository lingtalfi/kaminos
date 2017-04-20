<?php


use Kamille\Architecture\Request\Web\HttpRequestInterface;


$routes['Test_ho'] = ["/uri", null, null, "MyTestController:method"];

$routes['Test_ho2'] = ["/uri", null, null, "MyTestController:method"];


$routes["Test_myRouteId5"] = ["/my/{dynamic}/uris", null, function (HttpRequestInterface $request) {
    $o = [];
    return true; // true if ok, false will make the match fails
}, "?Controller:method"];

$routes["Test_myRouteId6"] = ["/my/{dynamic}/uris", null, function (HttpRequestInterface $request) {
    $o = [];
    return true; // true if ok, false will make the match fails
}, "?Controller:method"];


$routes["Test_myRouteId7"] = ["/my/{dynamic}/uris", null, function (HttpRequestInterface $request) {
    $o = [];
    return true; // true if ok, false will make the match fails
}, "?Controller:method"];
