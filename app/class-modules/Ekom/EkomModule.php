<?php


namespace Module\Ekom;


use Core\Module\ApplicationModule;
use Kamille\Services\XConfig;

class EkomModule extends ApplicationModule
{

    protected function getInstallDbScripts()
    {

        $dbName = XConfig::get("Core.database");

        return [
            "ekom.database_structure" => str_replace("mydb", $dbName, file_get_contents(__DIR__ . "/assets/db/ekom.sql")),
        ];
    }
}


