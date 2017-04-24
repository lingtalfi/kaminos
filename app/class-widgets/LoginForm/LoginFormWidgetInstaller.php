<?php


namespace Widget\LoginForm;


use Kamille\Mvc\WidgetInstaller\KamilleWidgetInstaller;


class LoginFormWidgetInstaller extends KamilleWidgetInstaller
{
    protected function getPlanets()
    {
        return [
            "ling.FormRenderer",
        ];
    }

}



