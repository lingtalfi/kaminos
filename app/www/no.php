<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";




// the url is: http://kaminos/no.php?pou=6


a(Z::uri()); // same uri, no query string                                                   /no.php
a(Z::uri(null, [], false)); // same uri, with query string                      /no.php?pou=6
a(Z::uri(null, ["doo" => 7], false)); // same uri, merging params               /no.php?pou=6&doo=7
a(Z::uri(null, ["doo" => 7], true)); // same uri, replacing params              /no.php?doo=7
a(Z::uri(null, ["doo" => 7], true, true)); // prefix with host         http://kaminos/no.php?doo=7
a(Z::uri("/myown", ['foo'], true, true));  // own uri                  http://kaminos/myown?0=foo
