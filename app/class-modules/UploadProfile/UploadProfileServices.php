<?php


namespace Module\UploadProfile;


class UploadProfileServices
{

    protected static function UploadProfile_profileFinder()
    {
        $appDir = \Kamille\Architecture\ApplicationParameters\ApplicationParameters::get("app_dir");
        $finder = \Module\UploadProfile\ProfileFinder\ProfileFinder::create()->setProfilesDir($appDir . "/config/upload-profiles");
        return $finder;
    }
}


