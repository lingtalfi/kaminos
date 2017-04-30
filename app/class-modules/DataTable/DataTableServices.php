<?php


namespace Module\DataTable;


class DataTableServices
{

    protected static function DataTable_profileFinder()
    {
        $appDir = \Kamille\Ling\Z::appDir();
        return \Module\DataTable\DataTableProfileFinder\DataTableProfileFinder::create()->setProfilesDir($appDir . "/config/datatable-profiles");
    }
}