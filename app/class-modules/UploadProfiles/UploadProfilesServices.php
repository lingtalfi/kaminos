<?php


namespace Module\UploadProfiles;


class UploadProfilesServices
{

    protected static function UploadProfilesServices_profileCollection()
    {
        $c = \Module\UploadProfiles\ProfileCollection\ProfileCollection::create();
        $profiles = [];
        $appDir = \Kamille\Architecture\ApplicationParameters\ApplicationParameters::get("app_dir");
        $colFile = $appDir . "/config/upload-profiles/conf.php";
        if (file_exists($colFile)) {
            include $colFile;
        }
        $c->setProfiles($profiles);
        return $c;
    }
}


