<?php


namespace ApplicationItemManager\ItemList;


class KamilleModulesItemList extends AbstractItemList
{
    //--------------------------------------------
    // OVERRIDE THOSE METHODS
    //--------------------------------------------
    protected function createItemList()
    {
        return [
            'KamilleModules.Connexion' => [
                'deps' => [
                    '+KamilleModules.GentelellaWebDirectory',
                ],
                'description' => <<<EEE
This module allows the user to log into the application, via a login form.
It uses the Privilege framework under the hood.
Tags: kaminos; lingtalfi
EEE
                ,
            ],
            'KamilleModules.GentelellaWebDirectory' => [
                'deps' => [],
                'description' => <<<EEE
This module imports the gentelella admin theme into the web directory of your application.
Tags: theme; bootstrap
EEE
                ,
            ],
        ];
    }
}