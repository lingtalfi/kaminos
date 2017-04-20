<?php
use Kamille\Architecture\Request\Web\HttpRequestInterface;

//--------------------------------------------
// USER - BEFORE
//--------------------------------------------


//--------------------------------------------
// STATIC
//--------------------------------------------
$routes["Core_myRouteId1"] = ["/pou", null, null, "?Controller:method"];

$routes["Core_myRouteId2"] = ["/pou2", null, null, [
    "controller" => "?Controller:method",
    "myotherparamsIfNeeded" => "is it really needed? why not? from  a module perspective? maybe?",
]];



$routes["Core_myRouteId3"] = ["/po/{dynamic}/some", [
    // ints
    'dynamic' => ">6",
    'dynamic2' => ">=6",
    'dynamic3' => "<6",
    'dynamic4' => "<=6",
    'dynamic5' => "6", // =
    'dynamic6' => ">7<10",
    'dynamic9' => [78, 45], // alternatives
    // strings
    'dynamic7' => "kabo",
    'dynamic8' => ["kano", "kabo"], // alternatives


], null, "?Controller:method"];


//--------------------------------------------
// DYNAMIC
//--------------------------------------------
$routes["Core_myRouteId4"] = ["/my/{dynamic}/uri", ['dynamic' => ["64", "65", "66"]], [
    'https' => true,
    'inGet' => ["disconnect", "pou"],
    'inPost' => ["disconnect", "pou"],
    'getValues' => ["ee" => "45", "pou" => "pl"],
    'postValues' => ["ee" => "45", "pou" => "pl"],
], "?Controller:method"];
$routes["Core_myRouteId5"] = ["/my/{dynamic}/uris", null, function (HttpRequestInterface $request) {
    $o = [];
    return true; // true if ok, false will make the match fails
}, "?Controller:method"];


//--------------------------------------------
// USER - AFTER
//--------------------------------------------

