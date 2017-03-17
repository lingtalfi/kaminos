<?php


use Kamille\Architecture\ApplicationParameters\Web\WebApplicationParameters;
use Kamille\Services\XModuleInstaller;

require_once __DIR__ . "/../init.php";



WebApplicationParameters::boot();
XModuleInstaller::inst()->install("Connexion");