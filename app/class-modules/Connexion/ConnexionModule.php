<?php


namespace Connexion;


use Kamille\Module\Exception\ModuleException;
use Kamille\Module\ModuleInterface;

class ConnexionModule implements ModuleInterface
{


    public function install()
    {
        a("connexion module install");
    }

    public function uninstall()
    {
        a("connexion module uninstall");
    }


}


