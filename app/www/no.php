<?php


use Kamille\Architecture\ApplicationParameters\Web\WebApplicationParameters;
use Services\X;
use Services\XConfig;


require_once __DIR__ . "/../init.php";





WebApplicationParameters::boot();
a(XConfig::get("Connexion.favoriteColor"));


//XModuleInstaller::inst()->install("Connexion");