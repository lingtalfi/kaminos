<?php


namespace Module\Core;




use Kamille\Module\KamilleModule;

class CoreModule extends KamilleModule
{

    protected function getWidgets(){
        return [
            'KamilleWidgets.Exception',
            'KamilleWidgets.HttpError',
        ];
    }

}


