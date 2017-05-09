<?php


namespace Module\DataTable;



class DataTableServices
{

    protected static function DataTable_profileFinder()
    {
        $appDir = \Kamille\Ling\Z::appDir();
        $f = \Module\DataTable\DataTableProfileFinder\DataTableProfileFinder::create();
        $f->setProfilesDir($appDir . "/config/datatable-profiles");
        \Core\Services\Hooks::call("DataTable_configureProfileFinder", $f);
        return $f;
    }
}