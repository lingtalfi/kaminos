<?php


use QuickPdo\QuickPdo;

$suggestions = QuickPdo::fetchAll('select id as `data`, reference_lf as `value` from zilu.article');
$out = [
    'suggestions' => $suggestions,
];


