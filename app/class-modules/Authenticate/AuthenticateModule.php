<?php


namespace Module\Authenticate;


use Kamille\Module\KamilleModule;

class AuthenticateModule extends KamilleModule
{

    protected function getPlanets()
    {
        return [
            "ling.Authenticate",
        ];
    }
}


